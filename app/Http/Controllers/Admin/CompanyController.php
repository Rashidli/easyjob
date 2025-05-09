<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:list-companies|create-companies|edit-companies|delete-companies', ['only' => ['index','show']]);
        $this->middleware('permission:create-companies', ['only' => ['create','store']]);
        $this->middleware('permission:edit-companies', ['only' => ['edit']]);
        $this->middleware('permission:delete-companies', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $query = Company::query();
        if($request->title){
            $query->where('title', 'like', '%' . $request->title . '%');
        }
        $companies = $query->orderByDesc('id')->paginate(300)->withqueryString();
        return view('admin.companies.index', compact('companies'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.companies.create', compact('categories'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'title' =>'required',
            'en_short_title' => 'nullable',
            'ru_short_title' => 'nullable',
            'az_short_title' => 'nullable',
            'image' => 'nullable',
            'email' => 'required|string|email|max:255|unique:companies',
            'password' => 'required|string|min:4',
        ]);

        if($request->hasFile('image')){
            $file = $request->file('image');
            $filename = Str::uuid() . "." . $file->extension();
            $file->storeAs('public/',$filename);
        }

        $company =  Company::create([
            'image'=>  $filename ?? null,
            'title' => $request->title,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'az'=>[
                'short_title'=>$request->az_short_title,
                'description'=>$request->az_description,
            ],
            'en'=>[
                'short_title'=>$request->en_short_title,
                'description'=>$request->en_description,
            ],
            'ru'=>[
                'short_title'=>$request->ru_short_title,
                'description'=>$request->ru_description,
            ]
        ]);
        $company->categories()->attach($request->categories);
        return redirect()->route('companies.index')->with('message','Company store successfully');
    }

    public function edit(Company $company)
    {
        $categories = Category::all();
        return view('admin.companies.edit', compact('company', 'categories' ));
    }

    public function update(Request $request, Company $company)
    {
        try {
            $request->validate([
                'en_short_title' => 'nullable',
                'ru_short_title' => 'nullable',
                'az_short_title' => 'nullable',
                'email' => [
                    'required',
                    'string',
                    'email',
                    'max:255',
                    Rule::unique('companies')->ignore($company->id),
                ],
                'password' => 'nullable|string|min:4',
            ]);

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = Str::uuid() . "." . $file->extension();
                $file->storeAs('public/', $filename);
                $company->image = $filename;
            }

            $data = [
                'title' => $request->title,
                'email' => $request->email,
                'az' => [
                    'short_title' => $request->az_short_title,
                    'description' => $request->az_description,
                ],
                'en' => [
                    'short_title' => $request->en_short_title,
                    'description' => $request->en_description,
                ],
                'ru' => [
                    'short_title' => $request->ru_short_title,
                    'description' => $request->ru_description,
                ],
            ];

            // Only update password if it's provided
            if ($request->filled('password')) {
                $data['password'] = bcrypt($request->password);
            }

            $company->update($data);
            $company->categories()->sync($request->categories);

            return redirect()->back()->with('message', 'Company updated successfully');
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }



    public function destroy(Company $company)
    {
        $company->delete();

        return redirect()->route('companies.index')
            ->with('success', 'Company deleted successfully.');
    }

    public function toggleStatus($id)
    {
        $company = Company::query()->findOrFail($id);
        $company->is_active = !$company->is_active;
        $company->save();

        return redirect()->back()->with('message','Status uğurla dəyişdirildi.');
    }
}
