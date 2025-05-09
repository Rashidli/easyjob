<?php

namespace App\Http\Controllers\Admin;

use App\Enums\VacancyStatus;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Notice;
use App\Models\Vacancy;
use App\Models\Category;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Mockery\Exception;

class VacancyController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:list-vacancies|create-vacancies|edit-vacancies|delete-vacancies', ['only' => ['index','show']]);
        $this->middleware('permission:create-vacancies', ['only' => ['create','store']]);
        $this->middleware('permission:edit-vacancies', ['only' => ['edit']]);
        $this->middleware('permission:delete-vacancies', ['only' => ['destroy']]);
    }
    function generateUniqueSlug($title) : string
    {
        $slug = Str::slug($title);
        $count = Vacancy::query()->where('vacancy_name', $title)->count();

        if ($count > 0) {
            $slug .= '-' . $count;
        }

        return $slug;
    }
    public function index(Request $request)
    {
        $vacancies = Vacancy::query();

        if ($request->filled('title')) {
            $vacancies->where('vacancy_name', 'like', '%' . $request->title . '%');
        }

        if ($request->filled('category_id')) {
            $vacancies->where('category_id', $request->category_id);
        }

        if ($request->filled('company_id')) {
            $vacancies->where('company_id', $request->company_id);
        }

        if ($request->filled('status')) {
            $vacancies->where('is_active', $request->status);
        }

        if ($request->filled('is_site')) {
            $vacancies->where('is_site', $request->is_site);
        }

        $vacancies = $vacancies->orderByDesc('id')->paginate(100)->withQueryString();

        $categories = Category::all();
        $companies = Company::all();

        return view('admin.vacancies.index', compact('vacancies', 'categories', 'companies'));
    }


    public function create()
    {
        $categories = Category::all();
        $companies = Company::all();
        return view('admin.vacancies.create', compact('categories', 'companies'));
    }

    public function store(Request $request)
    {

        // Create the vacancy
        try {
            $request->validate([
                'vacancy_name' => 'required|string|max:255',
                'category_id' => 'required',
                'job_responsibilities' => 'nullable',
                'requirements' => 'nullable',
                'working_conditions' => 'nullable',
                'application_method' => 'required|string|max:255',
                'salary' => 'nullable',
                'is_negotiable' => 'boolean',
                'is_active' => 'boolean',
                'is_premium' => 'boolean',
            ]);

            if($request->hasFile('company_logo')){
                $file = $request->file('company_logo');
                $filename = Str::uuid() . "." . $file->extension();
                $file->storeAs('public/',$filename);
            }

            Vacancy::create([
                'vacancy_name' => $request->input('vacancy_name'),
                'slug' => $this->generateUniqueSlug($request->vacancy_name),
                'company_id' => $request->input('company_id'),
                'company_name' => $request->input('company_name'),
                'company_logo' => $filename ?? null,
                'category_id' => $request->input('category_id'),
                'job_responsibilities' => $request->input('job_responsibilities'),
                'requirements' => $request->input('requirements'),
                'working_conditions' => $request->input('working_conditions'),
                'application_method' => $request->input('application_method'),
                'salary' => $request->input('salary'),
                'app_type' => $request->input('app_type'),
                'published_at' => $request->input('published_at'),
                'is_negotiable' => $request->boolean('is_negotiable', false),
                'is_active' => $request->boolean('is_active', true),
                'is_premium' => $request->boolean('is_premium', false),
            ]);

        }catch (Exception $exception){
            return $exception->getMessage();
        }

        return redirect()->route('vacancies.index')->with('message', 'Vacancy created successfully.');
    }


    public function edit($id)
    {
        $vacancy = Vacancy::findOrFail($id);
        $categories = Category::all();
        $companies = Company::all();
        return view('admin.vacancies.edit', compact('vacancy', 'categories', 'companies'));
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'vacancy_name' => 'required|string|max:255',
                'category_id' => 'required|exists:categories,id',
                'job_responsibilities' => 'nullable',
                'slug' => 'required',
                'requirements' => 'nullable',
                'working_conditions' => 'nullable',
                'application_method' => 'required|string|max:255',
                'salary' => 'nullable',
                'is_negotiable' => 'boolean',
                'is_active' => 'boolean',
                'is_premium' => 'boolean',
            ]);

            $vacancy = Vacancy::findOrFail($id);

            if ($request->hasFile('company_logo')) {
                if ($vacancy->company_logo) {
                    Storage::disk('public')->delete($vacancy->company_logo);
                }
                $companyLogo = $request->file('company_logo')->store('logos', 'public');
            } else {
                $companyLogo = $vacancy->company_logo;
            }

            $vacancy->update([
                'vacancy_name' => $request->input('vacancy_name'),
                'company_id' => $request->input('company_id'),
                'slug' => $request->input('slug'),
                'company_name' => $request->input('company_name'),
                'company_logo' => $companyLogo,
                'category_id' => $request->input('category_id'),
                'job_responsibilities' => $request->input('job_responsibilities'),
                'requirements' => $request->input('requirements'),
                'working_conditions' => $request->input('working_conditions'),
                'application_method' => $request->input('application_method'),
                'salary' => $request->input('salary'),
                'app_type' => $request->app_type,
                'notes' => $request->notes,
                'is_negotiable' => $request->input('is_negotiable', false),
                'is_active' => $request->input('is_active', true),
                'is_premium' => $request->input('is_premium', false),
                'status' => $request->status,
                'views_count' => $request->views_count,
                'published_at' => $request->input('published_at'),
            ]);

            if($vacancy->is_site) {
                $status = strval($vacancy->status);
                $message = match($status) {
                    VacancyStatus::UnderReview->value => 'Sizin elanınız yoxlamadadır. Təəssüf ki, hələ dərc olunmayıb.',
                    VacancyStatus::Published->value => 'Təbrik edirik! Sizin elanınız saytımızda dərc olunmuşdur.',
                    VacancyStatus::Returned->value => 'Sizin elanınız geri qaytarılıb. Zəhmət olmasa, düzəlişlər edin.',
                    VacancyStatus::Cancelled->value => 'Sizin elanınız imtina edilib. Dərc olunmayacaq.',
                    default => 'Statusunuz dəyişdi.',
                };

                Notice::create([
                    'company_id' => $vacancy->company_id,
                    'body' => $message,
                ]);
            }

            return redirect()->route('vacancies.index')->with('message', 'Vacancy updated successfully.');

        }catch (\Exception $exception){
            return $exception->getMessage();
        }
    }

    public function destroy($id)
    {
        $vacancy = Vacancy::findOrFail($id);

        // Delete the company logo if exists
        if ($vacancy->company_logo) {
            Storage::disk('public')->delete($vacancy->company_logo);
        }

        // Delete the vacancy
        $vacancy->delete();

        return redirect()->route('vacancies.index')->with('message', 'Vacancy deleted successfully.');
    }


}
