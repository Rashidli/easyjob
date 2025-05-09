<?php

namespace App\Http\Controllers\Front;

use App\Enums\VacancyStatus;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Company;
use App\Models\Notice;
use App\Models\Vacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use Mockery\Exception;

class CompanyAuthController extends Controller
{
    public function success()
    {
        return view('front.auth.signup_success');
    }

    public function showLoginForm()
    {
        return view('front.auth.login');
    }

    public function login(Request $request)
    {
        try {
            $credentials = $request->only('email', 'password');
            $remember = $request->has('remember'); // Check if 'remember' is checked

            if (Auth::guard('company')->attempt($credentials, $remember)) {
                return redirect()->route('company.dashboard');
            }

            return back()->withErrors(['email' => 'Invalid credentials']);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }


    public function showRegistrationForm()
    {
        return view('front.auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:companies',
            'password' => 'required|string|min:4',
        ], [
            'name.required' => 'Əlaqədar şəxs adı mütləqdir.',
            'title.required' => 'Şirkət adı mütləqdir.',
            'phone.required' => 'Əlaqə nömrəsi mütləqdir.',
            'email.required' => 'E-poçt mütləqdir.',
            'email.email' => 'Düzgün e-poçt ünvanı daxil edin.',
            'email.unique' => 'Bu e-poçt artıq qeydiyyatdan keçib.',
            'password.required' => 'Parol mütləqdir.',
            'password.min' => 'Parol minimum 4 simvol olmalıdır.',
        ]);


        $company = Company::create([
            'name' => $request->name,
            'title' => $request->title,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        Auth::guard('company')->login($company);

        return redirect()->route('company.dashboard');
    }

    public function dashboard()
    {
        $company = \auth()->guard('company')->user();
        return view('front.dashboard.details', compact('company'));
    }

    public function logout()
    {
        Auth::guard('company')->logout();
        return redirect()->route('company.login');
    }

    public function uploadLogo(Request $request, $id)
    {
        $request->validate([
            'logo' => 'required|image',
        ]);

        $company = Company::findOrFail($id);

        if($request->hasFile('logo')){

            $file = $request->file('logo');
            $filename = Str::uuid() . "." . $file->extension();
            $file->storeAs('public/',$filename);
            $company->image = $filename;

        }

        $company->save();

        return back()->with('success', 'Loqo dəyişdirildi!');
    }

    public function update(Request $request, $id)
    {

        $company = Company::findOrFail($id);
        $request->validate([
            'title' => 'required|string|max:255',
            'name' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('companies')->ignore($company->id),
            ],
            'password' => 'nullable|string|min:4',
        ]);

        $updateData = [
            'title' => $request->title,
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $updateData['password'] = bcrypt($request->password);
        }

        $company->update($updateData);

        return back()->with('success', 'Company details updated successfully!');
    }

    public function newVacancy()
    {
        $categories = Category::all();
        $company = Company::query()->findOrFail(auth()->guard('company')->user()->id);
        return view('front.dashboard.new_vacancy', compact('categories', 'company'));
    }

    public function vacancyList()
    {
        $company = \auth()->guard('company')->user();
        $vacancies = Vacancy::query()
            ->where(
                [
                    'company_id' => $company->id,
                    'status' => VacancyStatus::Published
                ])
            ->get();
        return view('front.dashboard.vacancy_list', compact('vacancies','company'));
    }


    public function vacancyPending()
    {
        $company = \auth()->guard('company')->user();
        $vacancies = Vacancy::query()
            ->where(
                [
                    'company_id' => $company->id,
                    'status' => VacancyStatus::UnderReview
                ])
            ->get();
        return view('front.dashboard.vacancy_pending', compact('vacancies','company'));
    }

    public function returnedVacancy()
    {
        $company = auth()->guard('company')->user();

        $vacancies = Vacancy::query()
            ->where('status',VacancyStatus::Returned)
            ->where('company_id', $company->id)
            ->get();

        return view('front.dashboard.return_vacancy', compact('vacancies', 'company'));
    }


    public function vacancy_edit($id)
    {
        $categories = Category::all();
        $company = auth()->guard('company')->user();
        $vacancy = Vacancy::query()->findOrFail($id);
        return view('front.dashboard.edit_vacancy', compact('vacancy','categories','company'));

    }

    public function vacancy_update(Request $request, $id)
    {
        $vacancy = Vacancy::query()->findOrFail($id);

        $request->validate([
            'vacancy_name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'job_responsibilities' => 'required',
            'requirements' => 'required',
            'working_conditions' => 'required',
            'application_method' => 'required|string|max:255',
            'salary' => 'nullable|numeric',
            'is_negotiable' => 'sometimes|boolean',
        ]);

        $vacancy->update([
            'vacancy_name' => $request->input('vacancy_name'),
//            'slug' => $this->generateUniqueSlug($request->vacancy_name),
            'company_id' => auth()->guard('company')->id(),
            'company_name' => $request->input('company_name'),
            'category_id' => $request->input('category_id'),
            'job_responsibilities' => $request->input('job_responsibilities'),
            'requirements' => $request->input('requirements'),
            'working_conditions' => $request->input('working_conditions'),
            'application_method' => $request->input('application_method'),
            'salary' => $request->input('salary'),
            'is_negotiable' => $request->has('is_negotiable') ? $request->boolean('is_negotiable') : false,
            'is_site' => true,
            'status' => VacancyStatus::UnderReview
        ]);

        Notice::create([
            'company_id' => Auth()->guard('company')->id(),
            'body' => 'Müraciətiniz üçün təşəkkür edirik. Dəyişiklikləriniz moderatorlar tərəfindən yoxlandıqdan sonra dərc ediləcək.',
        ]);

        return redirect()->route('vacancy_post_success');
    }

    public function notices()
    {
        $company = auth()->guard('company')->user();
        $notices = Notice::query()->where('company_id', \auth()->guard('company')->user()->id)->orderByDesc('id')->get();
        return view('front.dashboard.notices', compact('notices','company'));
    }

    public function markAsRead($id)
    {
        $notice = Notice::find($id);
        $notice->update(['is_read' => true]);
        return redirect()->back()->with('message', 'Oxunmuş kimi işarələndi');
    }


    public function showForgotPasswordForm()
    {
        return view('front.dashboard.forgot-password');
    }

    public function sendResetLink(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email|exists:companies,email',
            ]);

            $company = Company::where('email', $request->email)->first();

            $token = Str::random(64);

            DB::table('password_reset_tokens')->updateOrInsert(
                ['email' => $company->email],
                [
                    'email' => $company->email,
                    'token' => $token,
                    'created_at' => Carbon::now()
                ]
            );

            Mail::send('emails.company-reset-password', ['token' => $token,'email' => $company->email], function ($message) use ($company) {
                $message->to($company->email);
                $message->subject('Şifrəni Sıfırla');
            });

            return back()->with('status', 'Parol sıfırlama keçidi e-poçtunuza göndərildi.');
        }catch (\Exception $exception){
            return $exception->getMessage();
        }
    }

    public function showResetForm(Request $request)
    {
        $token = $request->query('token');
        $email = $request->query('email');
        return view('front.auth.reset-password', compact('token','email'));

    }

    public function resetPassword(Request $request)
    {

        try {
            $request->validate([
                'token' => 'required',
                'email' => 'required|email|exists:companies,email',
                'password' => 'required|min:4|confirmed',
            ]);

            $reset = DB::table('password_reset_tokens')
                ->where('email', $request->email)
                ->where('token', $request->token)
                ->first();

            if (!$reset) {
                return back()->withErrors(['email' => 'Etibarsız və ya vaxtı keçmiş token.']);
            }

            $company = Company::where('email', $request->email)->first();
            $company->password = Hash::make($request->password);
            $company->save();

            DB::table('password_reset_tokens')->where('email', $request->email)->delete();

            return redirect()->route('company.login')->with('status', 'Parolunuz uğurla yeniləndi.');
        }catch (\Exception $exception){
            return $exception->getMessage();
        }
    }


}
