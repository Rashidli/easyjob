<?php

namespace App\Http\Controllers\Front;

use App\Enums\VacancyStatus;
use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Company;
use App\Models\Contact;
use App\Models\Notice;
use App\Models\Single;
use App\Models\Vacancy;
use App\Models\View;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function generateUniqueSlug($title)
    {
        $slug  = Str::slug($title);
        $count = Vacancy::query()->where('vacancy_name', $title)->count();

        if ($count > 0) {
            $slug .= '-' . $count;
        }

        return $slug;
    }

    public function welcome(Request $request)
    {
        //        \DB::enableQueryLog();
        $query = Vacancy::query()
            ->with('company')
            ->where('status', VacancyStatus::Published)
//            ->withCount('views')
            ->where('published_at', '>=', Carbon::now()->subDays(30))
            ->orderByDesc('is_premium')
            ->orderByDesc('published_at');

        if ($request->has('search') && ! empty($request->search)) {
            $query->where('vacancy_name', 'like', '%' . $request->search . '%');
        }

        if ($request->has('company_id') && ! empty($request->company_id)) {
            $query->where('company_id', $request->company_id);
        }

        if ($request->has('category_id') && ! empty($request->category_id)) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->has('date') && ! empty($request->date)) {
            $date = now();
            switch ($request->date) {
                case 'one_day':
                    $date->subDay();
                    break;
                case 'three_days':
                    $date->subDays(3);
                    break;
                case 'one_week':
                    $date->subWeek();
                    break;
                case 'ten_days':
                    $date->subDays(10);
                    break;
                case 'two_weeks':
                    $date->subWeeks(2);
                    break;
            }
            $query->where('published_at', '>=', $date);
        }

        if ($request->has('salary') && ! empty($request->salary)) {
            switch ($request->salary) {
                case 'all':
                    break;
                case '1':
                    $query->whereBetween('salary', [500, 1000]);
                    break;
                case '2':
                    $query->whereBetween('salary', [1000, 2000]);
                    break;
                case '3':
                    $query->whereBetween('salary', [2000, 5000]);
                    break;
                case '5':
                    $query->where('salary', '>', 5000);
                    break;
            }
        }

        $vacancies = $query->paginate(400)->withQueryString();
        //        dd(\DB::getQueryLog());
        $categories = Category::all();
        $companies  = Company::query()->where('is_active', true)->get();

        return view('front.welcome', compact('vacancies', 'categories', 'companies'));
    }

    public function dynamicPage($slug, Request $request)
    {
        $types = [
            'categories'   => 'front.categories',
            'companies'    => 'front.companies',
            'favorites'    => 'front.favorites',
            'blogs'        => 'front.blogs',
            'post_vacancy' => 'front.post_vacancy',
            'contact'      => 'front.contact',
            'about'        => 'front.about',
        ];

        foreach ($types as $type => $view) {
            $page = Single::query()->where('type', $type)->whereHas('translations', function ($query) use ($slug): void {
                $query->where('slug', $slug);
            })->first();
            if ($page) {
                $routes = collect($page->getTranslationsArray())->map(fn ($tr) => $tr['slug'])->toArray();
                $this->createTranslatedLinks($routes, 'dynamic.page');

                $data = [];
                switch ($type) {
                    case 'about':
                        $data['about'] = About::query()->first();
                        break;
                    case 'post_vacancy':
                        $data['categories'] = Category::all();
                        break;
                    case 'categories':
                        $data['categories'] = Category::query()
                            ->withCount('companies')
                            ->withCount(['vacancies' => function ($q): void {
                                $q->where('status', VacancyStatus::Published)
                                    ->whereDate('published_at', '>=', Carbon::now()->subMonth());
                            }])
                            ->paginate(150);

                        break;
                    case 'companies':
                        $data['companies'] = Company::query()
                            ->where('is_active', true)
                            ->withCount('categories')
                            ->withCount(['vacancies' => function ($q): void {
                                $q->where('status', VacancyStatus::Published)
                                    ->whereDate('published_at', '>=', Carbon::now()->subMonth());
                            }])
                            ->orderBy('vacancies_count', 'desc')
                            ->paginate(150);

                        break;
                    case 'favorites':
                        $bookmarkedVacancies = json_decode(request()->cookie('bookmarkedVacancies') ?? '[]', true);
                        $data['vacancies']   = Vacancy::whereIn('id', $bookmarkedVacancies)->paginate(10);
                        break;
                    case 'blogs':
                        $data['blogs'] = Blog::active()->orderByDesc('id')->get();
                        break;
                }

                return view($view, $data);
            }
        }

        $models = [
            'vacancy' => Vacancy::with('company', 'category'),
            'blog'    => Blog::with('translation'),
        ];

        foreach ($models as $key => $query) {
            if ('vacancy' === $key) {
                $item = $query->where('slug', $slug)->first();

                if ($item) {
                    $viewData = [$key => $item];
                    $item->increment('views_count');
                    //                    $vacancy_ip = View::query()
                    //                        ->where('vacancy_id', $item->id)
                    //                        ->where('ip', $request->ip())
                    //                        ->first();
                    //
                    //                    if(!$vacancy_ip) {
                    //                        View::create([
                    //                            'vacancy_id' => $item->id,
                    //                            'ip' => $request->ip(),
                    //                        ]);
                    //                        $item->increment('views_count');
                    //                    }

                    return view('front.vacancy_single', $viewData);
                }
            } else {
                $item = $query->whereHas('translations', function ($query) use ($slug): void {
                    $query->where('slug', $slug);
                })->first();
            }

            if ($item) {
                $routes = collect($item->getTranslationsArray())->map(fn ($tr) => $tr['slug'])->toArray();
                $this->createTranslatedLinks($routes, 'dynamic.page');

                $viewData = [$key => $item];
                if ('blog' === $key) {
                    return view('front.blog_single', $viewData);
                }
            }
        }

        abort(404);
    }

    public function showFavoriteVacancies(Request $request)
    {
        $bookmarkIds = $request->input('bookmarks', []);

        if (is_string($bookmarkIds)) {
            $bookmarkIds = explode(',', $bookmarkIds);
        }

        $vacancies = Vacancy::query()->with('company')
            ->withCount('views')
            ->whereIn('id', $bookmarkIds)->get();

        return response()->json($vacancies);
    }

    public function success()
    {
        return view('front.success');
    }

    public function vacancy_post_success()
    {
        return view('front.vacancy_post_success');
    }

    public function contact_post(Request $request)
    {
        Contact::create([
            'name'    => $request->name,
            'phone'   => $request->phone,
            'message' => $request->message,
            'email'   => $request->email,
        ]);

        return redirect()->route('success');
    }

    public function vacancy_post(Request $request)
    {
        $request->validate([
            'vacancy_name'         => 'required|string|max:255',
            'category_id'          => 'required|exists:categories,id',
            'job_responsibilities' => 'required',
            'requirements'         => 'required',
            'working_conditions'   => 'required',
            'application_method'   => 'required|string|max:255',
            'salary'               => 'nullable|numeric',
            'is_negotiable'        => 'sometimes|boolean',
        ]);

        Vacancy::create([
            'vacancy_name'         => $request->input('vacancy_name'),
            'slug'                 => $this->generateUniqueSlug($request->vacancy_name),
            'company_id'           => auth()->guard('company')->id(),
            'company_name'         => $request->input('company_name'),
            'category_id'          => $request->input('category_id'),
            'job_responsibilities' => $request->input('job_responsibilities'),
            'requirements'         => $request->input('requirements'),
            'working_conditions'   => $request->input('working_conditions'),
            'application_method'   => $request->input('application_method'),
            'salary'               => $request->input('salary'),
            'is_negotiable'        => $request->has('is_negotiable') ? $request->boolean('is_negotiable') : false,
            'is_site'              => true,
            'status'               => VacancyStatus::UnderReview,
        ]);

        Notice::create([
            'company_id' => Auth()->guard('company')->id(),
            'body'       => 'Müraciətiniz üçün təşəkkür edirik. Elanınız moderatorlar tərəfindən yoxlandıqdan sonra dərc ediləcək.',
        ]);

        return redirect()->route('vacancy_post_success');
    }
}
