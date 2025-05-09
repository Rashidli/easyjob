@extends('front.layouts.master')


@section('title', $vacancy->vacancy_name . ' | ' . ($vacancy->company?->title ?? $vacancy->company_name) . ' | easyjob.az')

{{--@section('description',$vacancy->vacancy_name  .' | easyjob.az 2025')--}}
@section('keywords', $vacancy->vacancy_name)

@section('az_slug',$vacancy->vacancy_name)
@section('en_slug',$vacancy->vacancy_name)
@section('ru_slug',$vacancy->vacancy_name)
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@section('content')

    <!-- Start -->
    <section class="bg-slate-50 dark:bg-slate-800 md:py-24 py-16">
        <div class="container mt-10">
            <div class="grid md:grid-cols-12 grid-cols-1 gap-[30px]">
                <div class="lg:col-span-8 md:col-span-6">
                    <div
                        class="md:flex items-center p-6 shadow dark:shadow-gray-700 rounded-md bg-white dark:bg-slate-900">
                        @if($vacancy->company)
                            <img src="{{ asset('storage/' . $vacancy->company->image) }}"
                                 class="rounded-full size-28 p-4 bg-white dark:bg-slate-900 shadow dark:shadow-gray-700"
                                 alt="">
                        @else
                            <span
                                class="flex items-center justify-center rounded-full size-28 p-4 bg-white dark:bg-slate-900 shadow dark:shadow-gray-700 text-4xl">
        {{ ucfirst(substr($vacancy->company_name, 0, 1)) }}
    </span>
                        @endif


                        <div class="md:ms-4 md:mt-0 mt-6">
                            <h5 class="text-xl font-semibold">{{$vacancy->vacancy_name}}</h5>
                            <div class="mt-2">
        <span class="text-slate-400 font-medium me-2 inline-block">
            <i class="uil uil-building text-[18px] text-emerald-600 me-1"></i>
            @if($vacancy->company)
                {{$vacancy->company?->title}}
            @else
                {{$vacancy->company_name}}
            @endif

        </span>

                                <span
                                    class="text-slate-400 font-medium me-2 inline-block bg-emerald-100 text-emerald-700 px-3 py-1 rounded-lg border border-emerald-600">
            Son tarix: {{ $vacancy->published_at->addMonth()->translatedFormat('d F Y') }}
        </span><br>
                                <span class="text-slate-400 text-xs md:text-sm ml-4"><i class="uil uil-eye"></i>
                                            {{$vacancy->views_count}}
                                        </span>
                            </div>
                        </div>


                    </div>

                    @if($vacancy->job_responsibilities)
                        <h5 class="text-lg font-semibold mt-6">Vəzifə öhdəlikləri:</h5>
                        <div class=" mt-4 for_ckeditor">{!! $vacancy->job_responsibilities !!}</div>
                    @endif
                    @if($vacancy->requirements)
                        <h5 class="text-lg font-semibold mt-6">Tələblər: </h5>
                        <div class=" mt-4 for_ckeditor">{!! $vacancy->requirements !!}</div>
                    @endif
                    @if($vacancy->working_conditions)
                        <h5 class="text-lg font-semibold mt-6">İş şəraiti: </h5>
                        <div class=" mt-4 for_ckeditor">{!! $vacancy->working_conditions !!}</div>
                    @endif


                    <div class="mt-5 relative">
                        @if($vacancy->app_type == 'email')
                            <a id="applyButton" data-title="{{$vacancy->application_method}}"
                               class="btn rounded-md bg-emerald-600 hover:bg-emerald-700 border-emerald-600 hover:border-emerald-700 text-white md:ms-2 w-full md:w-auto">Müraciət
                                et</a>
                        @else
                            <a href="{{$vacancy->application_method}}"
                               class="btn rounded-md bg-emerald-600 hover:bg-emerald-700 border-emerald-600 hover:border-emerald-700 text-white md:ms-2 w-full md:w-auto">Müraciət
                                et</a>
                        @endif

                        <!-- Hidden box to show the data-title -->
                        <div id="tooltip"
                             class="hidden absolute bg-white text-slate-700 shadow-md rounded-md px-4 py-2 mt-2 w-full md:w-auto">
                            <span id="tooltipText" class="tooltipText"></span>
                            <button id="copyButton" class="ml-2 text-emerald-600 hover:text-emerald-700" title="Copy">
                                <i class="uil uil-copy-alt text-[20px]"></i>
                            </button>
                            <span id="copiedMessage" class="ml-2 text-emerald-600 hidden">Copied!</span>
                        </div>
                    </div>


                </div><!--end col-->

                <div class="lg:col-span-4 md:col-span-6 for_top_mobile">
                    <div class="shadow dark:shadow-gray-700 rounded-md bg-white dark:bg-slate-900 sticky top-20">
                        <div class="p-6">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <!-- İş haqqında Tab -->
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="job-tab" data-bs-toggle="tab"
                                            data-bs-target="#job" type="button" role="tab" aria-controls="job"
                                            aria-selected="true">
                                        İş haqqında
                                    </button>
                                </li>

                                <!-- Şirkət haqqında Tab -->
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="company-tab" data-bs-toggle="tab"
                                            data-bs-target="#company" type="button" role="tab" aria-controls="company"
                                            aria-selected="false">
                                        Şirkət haqqında
                                    </button>
                                </li>
                            </ul>

                            <!-- Tab Content -->
                            <div class="tab-content p-6 border border-t-0 border-slate-100 dark:border-gray-700"
                                 id="myTabContent">
                                <!-- İş haqqında Content -->
                                <div class="tab-pane fade show active" id="job" role="tabpanel"
                                     aria-labelledby="job-tab">
                                    <ul class="list-none">
                                        <li class="flex items-center">
                                            <i data-feather="user-check" class="size-5"></i>
                                            <div class="ms-4">
                                                <p class="font-medium">Şirkət:</p>
                                                <span class="text-emerald-600 font-medium text-sm">
                            <a href="{{ route('welcome', ['company_id' => $vacancy->company?->id]) }}"
                               class="inner_vacancy">
                                @if($vacancy->company)
                                    {{$vacancy->company?->title}}
                                @else
                                    {{$vacancy->company_name}}
                                @endif
                            </a>
                        </span>
                                            </div>
                                        </li>

                                        <li class="flex items-center mt-3">
                                            <i data-feather="monitor" class="size-5"></i>
                                            <div class="ms-4">
                                                <p class="font-medium">Kateqoriya:</p>
                                                <span class="text-emerald-600 font-medium text-sm">
                            <a href="{{ route('welcome', ['category_id' => $vacancy->category?->id]) }}"
                               class="inner_vacancy">
                                {{ $vacancy->category?->title }}
                            </a>
                        </span>
                                            </div>
                                        </li>

                                        <li class="flex items-center mt-3">
                                            <i data-feather="dollar-sign" class="size-5"></i>
                                            <div class="ms-4">
                                                <p class="font-medium">Əmək haqqı:</p>
                                                <span class="text-emerald-600 font-medium text-sm">
                            @if($vacancy->is_negotiable)
                                                        Müsahibə əsasında
                                                    @else
                                                        {{ $vacancy->salary }} AZN
                                                    @endif
                        </span>
                                            </div>
                                        </li>

                                        <li class="flex items-center mt-3">
                                            <i data-feather="clock" class="size-5"></i>
                                            <div class="ms-4">
                                                <p class="font-medium">Elanın tarixi:</p>
                                                <span class="text-emerald-600 font-medium text-sm">
                            {{ $vacancy->updated_at->translatedFormat('d F Y') }}
                        </span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                                <!-- Şirkət haqqında Content -->
                                <div class="tab-pane fade" id="company" role="tabpanel" aria-labelledby="company-tab">
                                    <p class="text-slate-400 mt-3">
                                        {!! $vacancy->company?->description !!}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--end col-->
            </div>

            <div class="grid md:grid-cols-2 mt-8 gap-[30px]">
                <div class="group rounded-lg shadow hover:shadow-lg dark:shadow-gray-700 transition-all duration-500">
                    <div
                        class="group rounded-lg shadow hover:shadow-lg dark:shadow-gray-700 transition-all duration-500 w-full">
                        <div class="flex items-center justify-between p-1">
                            <div class="flex items-center w-full">
                                <a href="https://t.me/easyjobaz"
                                   class="block text-[16px] font-semibold hover:text-emerald-600 transition-all duration-500">
                                    <img src="{{asset('/')}}front/banner.jpg" alt="">
            </a>
        </div>
    </div>
</div>
                </div><!--end content-->
            </div>

        </div>
        <!--end container-->

    </section>
    <!--end section-->

@endsection
