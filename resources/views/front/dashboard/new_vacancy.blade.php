@extends('front.layouts.master')

@section('title', 'Details')
@section('description', 'Details')
@section('keywords', 'Details')

<style>
    .sidebar-menu a.active {
        background-color: #10b981; /* emerald-500 */
        color: white;
        border-radius: 0.5rem; /* rounded-lg */
    }

    .sidebar-menu a:hover {
        background-color: #d1fae5; /* emerald-100 */
        color: #065f46; /* emerald-800 */
    }
    .dark select {
    background: rgb(15, 23, 42);
    border: 1px solid #0F172A;
    color: white;
  }
</style>

@section('content')

    <section class="relative mb:pb-24 pb-16 mt-30 z-1">
        <div class="container mt-12">
            <div class="grid md:grid-cols-12 grid-cols-1 gap-[30px]">
                <!-- Sidebar -->
                @include('front.includes.sidebar')

                <!-- Main Content -->
                <div class="lg:col-span-8 md:col-span-7">
                    <div class="p-6 rounded-md shadow-lg bg-white dark:bg-gray-800 mt-8">
                        <h5 class="text-2xl font-semibold mb-6">Yeni vakansiya əlavə et</h5>

                        <form class="space-y-6" action="{{ route('vacancy_post') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="grid lg:grid-cols-12 lg:gap-6">

                                <!-- Vakansiya adı -->
                                <div class="lg:col-span-6">
                                    <label for="vacancy_name" class="block font-medium text-gray-700">{{$words['vacancy_name']->translate(app()->getLocale())->title}}:</label>
                                    <div class="relative mt-2">
                                        <input name="vacancy_name" id="vacancy_name" type="text"
                                               class="form-input w-full border-gray-300 focus:border-emerald-500 focus:ring focus:ring-emerald-300 rounded-lg shadow-sm"
                                               value="{{ old('vacancy_name') }}">
                                    </div>
                                    @error('vacancy_name')
                                    <span class="text-red-600">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Kateqoriya -->
                                <div class="lg:col-span-6">
                                    <label for="category_id" class="block font-medium bg-black text-gray-700">{{$words['category']->translate(app()->getLocale())->title}}:</label>
                                    <div class="relative mt-2">
                                        <select  name="category_id" id="category_id" class="form-select w-full border-gray-300 focus:border-emerald-500 focus:ring focus:ring-emerald-300 rounded-lg shadow-sm">
                                            <option value="">{{$words['choose']->translate(app()->getLocale())->title}}</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('category_id')
                                    <span class="text-red-600">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Vəzifə Öhdəlikləri -->
                                <div class="lg:col-span-12">
                                    <label for="job_responsibilities" class="block font-medium text-gray-700">{{$words['job_responsibility']->translate(app()->getLocale())->title}}:</label>
                                    <div class="relative mt-2">
                                        <textarea name="job_responsibilities" id="job_responsibilities" class="form-input w-full border-gray-300 focus:border-emerald-500 focus:ring focus:ring-emerald-300 rounded-lg shadow-sm" style="min-height: 150px;" placeholder="{{$words['job_responsibility']->translate(app()->getLocale())->title}}">{{ old('job_responsibilities') }}</textarea>
                                    </div>
                                    @error('job_responsibilities')
                                    <span class="text-red-600">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Tələblər -->
                                <div class="lg:col-span-12">
                                    <label for="requirements" class="block font-medium text-gray-700">{{$words['requirement']->translate(app()->getLocale())->title}}:</label>
                                    <div class="relative mt-2">
                                        <textarea name="requirements" id="requirements" class="form-input w-full border-gray-300 focus:border-emerald-500 focus:ring focus:ring-emerald-300 rounded-lg shadow-sm" style="min-height: 150px;" placeholder="{{$words['requirement']->translate(app()->getLocale())->title}}">{{ old('requirements') }}</textarea>
                                    </div>
                                    @error('requirements')
                                    <span class="text-red-600">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- İş şərtləri -->
                                <div class="lg:col-span-12">
                                    <label for="working_conditions" class="block font-medium text-gray-700">{{$words['work_condition']->translate(app()->getLocale())->title}}:</label>
                                    <div class="relative mt-2">
                                        <textarea name="working_conditions" id="working_conditions" class="form-input w-full border-gray-300 focus:border-emerald-500 focus:ring focus:ring-emerald-300 rounded-lg shadow-sm" style="min-height: 150px;" placeholder="{{$words['work_condition']->translate(app()->getLocale())->title}}">{{ old('working_conditions') }}</textarea>
                                    </div>
                                    @error('working_conditions')
                                    <span class="text-red-600">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Müraciət vasitəsi -->
                                <div class="lg:col-span-6">
                                    <label for="application_method" class="block font-medium text-gray-700">{{$words['application_method']->translate(app()->getLocale())->title}}:</label>
                                    <div class="relative mt-2">
                                        <input name="application_method" id="application_method" type="text"
                                               class="form-input w-full border-gray-300 focus:border-emerald-500 focus:ring focus:ring-emerald-300 rounded-lg shadow-sm"
                                               value="{{ old('application_method') }}" placeholder="Email və ya telefon">
                                    </div>
                                    @error('application_method')
                                    <span class="text-red-600">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Is Negotiable -->
                                <div class="lg:col-span-6">
                                    <label for="is_negotiable" class="block font-medium text-gray-700">{{$words['is_negoriable']->translate(app()->getLocale())->title}}:</label>
                                    <div class="relative mt-2">
                                        <select name="is_negotiable" id="is_negotiable_select" class="form-select w-full border-gray-300 focus:border-emerald-500 focus:ring focus:ring-emerald-300 rounded-lg shadow-sm">
                                            <option value="0" {{ old('is_negotiable') == 0 ? 'selected' : '' }}>{{$words['no']->translate(app()->getLocale())->title}}</option>
                                            <option value="1" {{ old('is_negotiable') == 1 ? 'selected' : '' }}>{{$words['yes']->translate(app()->getLocale())->title}}</option>
                                        </select>
                                    </div>
                                    @error('is_negotiable')
                                    <span class="text-red-600">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Maaş -->
                                <div class="lg:col-span-6">
                                    <label for="salary" class="block font-medium text-gray-700">{{$words['salary']->translate(app()->getLocale())->title}}:</label>
                                    <div class="relative mt-2">
                                        <input name="salary" id="salary_input" type="number"
                                               class="form-input w-full border-gray-300 focus:border-emerald-500 focus:ring focus:ring-emerald-300 rounded-lg shadow-sm"
                                               value="{{ old('salary') }}">
                                    </div>
                                    @error('salary')
                                    <span class="text-red-600">{{ $message }}</span>
                                    @enderror
                                </div>


                            </div>
                            <br>
                            <button type="submit"
                                    class="w-full py-3 bg-emerald-600 text-white font-medium rounded-lg shadow-md hover:bg-emerald-700 transition-all">
                                Yadda saxla
                            </button>
                        </form>
                    </div>
                </div><!--end col-->



            </div><!--end grid-->
        </div><!--end container-->
    </section><!--end section-->

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
