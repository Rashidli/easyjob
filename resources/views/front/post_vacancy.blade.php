@extends('front.layouts.master')

@section('title', $post_vacancy->seo_title)
@section('description', $post_vacancy->requirements)
@section('keywords', $post_vacancy->requirements)

@section('az_slug',$post_vacancy->seo_title)
@section('en_slug',$post_vacancy->seo_description)
@section('ru_slug',$post_vacancy->seo_keywords)
@section('content')

    <section class="relative lg:mt-24 mt-[74px] pb-16">

        <div class="container mt-16">
            <div class="grid lg:grid-cols-12 grid-cols-1 gap-[30px]">
                <div class="lg:col-span-12">
                    <div class="p-6 rounded-md shadow dark:shadow-gray-800 bg-white dark:bg-slate-900">
                        <h5 class="text-lg font-semibold mb-4">{{$words['add_vacancy']->translate(app()->getLocale())->title}} :</h5>
                        <form action="{{ route('vacancy_post') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="grid lg:grid-cols-12 md:grid-cols-2 grid-cols-1 gap-4">
                                <!-- Vakansiya adı -->
                                <div class="lg:col-span-6">
                                    <label class="form-label font-medium">{{$words['vacancy_name']->translate(app()->getLocale())->title}}: <span class="text-red-600">*</span></label>
                                    <input type="text" class="form-input border border-slate-100 dark:border-slate-800 mt-2" placeholder="{{$words['vacancy_name']->translate(app()->getLocale())->title}}" name="vacancy_name" value="{{ old('vacancy_name') }}" required>
                                    @error('vacancy_name')
                                    <span class="text-red-600">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Kateqoriya -->
                                <div class="lg:col-span-6">
                                    <label class="form-label font-medium">{{$words['category']->translate(app()->getLocale())->title}}: <span class="text-red-600">*</span></label>
                                    <select class="form-select form-input border border-slate-100 dark:border-slate-800 block w-full mt-2" name="category_id" required>
                                        <option value="">{{$words['choose']->translate(app()->getLocale())->title}}</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                    <span class="text-red-600">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Company Name -->
                                <div class="lg:col-span-6">
                                    <label class="form-label font-medium">{{$words['company_name']->translate(app()->getLocale())->title}}: <span class="text-red-600">*</span></label>
                                    <input type="text" class="form-input border border-slate-100 dark:border-slate-800 mt-2" placeholder="{{$words['company_name']->translate(app()->getLocale())->title}}" name="company_name" value="{{ old('company_name') }}" required>
                                    @error('company_name')
                                    <span class="text-red-600">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Vəzifə Öhdəlikləri -->
                                <div class="lg:col-span-12">
                                    <label class="form-label font-medium">{{$words['job_responsibility']->translate(app()->getLocale())->title}}: <span class="text-red-600">*</span></label>
                                    <textarea class="form-input border border-slate-100 dark:border-slate-800 mt-2" placeholder="{{$words['job_responsibility']->translate(app()->getLocale())->title}}" name="job_responsibilities" style="min-height: 150px;" required>{{ old('job_responsibilities') }}</textarea>
                                    @error('job_responsibilities')
                                    <span class="text-red-600">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Tələblər -->
                                <div class="lg:col-span-12">
                                    <label class="form-label font-medium">{{$words['requirement']->translate(app()->getLocale())->title}}: <span class="text-red-600">*</span></label>
                                    <textarea class="form-input border border-slate-100 dark:border-slate-800 mt-2" placeholder="{{$words['requirement']->translate(app()->getLocale())->title}}" name="requirements" style="min-height: 150px;" required>{{ old('requirements') }}</textarea>
                                    @error('requirements')
                                    <span class="text-red-600">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- İş şərtləri -->
                                <div class="lg:col-span-12">
                                    <label class="form-label font-medium">{{$words['work_condition']->translate(app()->getLocale())->title}}: <span class="text-red-600">*</span></label>
                                    <textarea class="form-input border border-slate-100 dark:border-slate-800 mt-2" placeholder="{{$words['work_condition']->translate(app()->getLocale())->title}}" name="working_conditions" style="min-height: 150px;" required>{{ old('working_conditions') }}</textarea>
                                    @error('working_conditions')
                                    <span class="text-red-600">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Müraciət vasitəsi -->
                                <div class="lg:col-span-6">
                                    <label class="form-label font-medium">{{$words['application_method']->translate(app()->getLocale())->title}}: <span class="text-red-600">*</span></label>
                                    <input type="text" class="form-input border border-slate-100 dark:border-slate-800 mt-2" placeholder="{{$words['application_method']->translate(app()->getLocale())->title}}" name="application_method" value="{{ old('application_method') }}" required>
                                    @error('application_method')
                                    <span class="text-red-600">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="lg:col-span-6">
                                    <label class="form-label font-medium">{{$words['is_negoriable']->translate(app()->getLocale())->title}}:</label>
                                    <select class="form-select form-input border border-slate-100 dark:border-slate-800 block w-full mt-2" name="is_negotiable" id="is_negotiable_select">
                                        <option value="0" {{ old('is_negotiable') == 0 ? 'selected' : '' }}>{{$words['no']->translate(app()->getLocale())->title}}</option>
                                        <option value="1" {{ old('is_negotiable') == 1 ? 'selected' : '' }}>{{$words['yes']->translate(app()->getLocale())->title}}</option>
                                    </select>
                                    @error('is_negotiable')
                                    <span class="text-red-600">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!-- Maaş -->
                                <div class="lg:col-span-6">
                                    <label class="form-label font-medium">{{$words['salary']->translate(app()->getLocale())->title}}:</label>
                                    <input type="number" class="form-input border border-slate-100 dark:border-slate-800 mt-2" placeholder="{{$words['salary']->translate(app()->getLocale())->title}}" name="salary" id="salary_input" value="{{ old('salary') }}">
                                    @error('salary')
                                    <span class="text-red-600">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Razılaşma yolu ilə -->


                                <!-- Şirkət loqosu -->
                                <div class="lg:col-span-6">
                                    <label class="form-label font-medium" for="company_logo">{{$words['company_logo']->translate(app()->getLocale())->title}}:</label>
                                    <input type="file" class="form-input border border-slate-100 dark:border-slate-800 mt-2" id="company_logo" name="company_logo">
                                    @error('company_logo')
                                    <span class="text-red-600">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div><!--end grid-->

                            <input type="submit" class="btn bg-emerald-600 hover:bg-emerald-700 text-white rounded-md mt-5" value="Göndər">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const salaryInput = document.getElementById('salary_input');
        const isNegotiableSelect = document.getElementById('is_negotiable_select');

        // Disable salary input if "Xeyr" is selected
        function toggleSalaryInput() {
            if (isNegotiableSelect.value == '1') {
                salaryInput.disabled = true;
                salaryInput.value = ''; // Clear salary input
            } else {
                salaryInput.disabled = false;
            }
        }

        // Initial check
        toggleSalaryInput();

        // Check on change
        isNegotiableSelect.addEventListener('change', toggleSalaryInput);
    });
</script>
