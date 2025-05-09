@extends('front.layouts.master')

@section('title', $company_page->seo_title)
@section('description', $company_page->seo_description)
@section('keywords', $company_page->seo_keywords)

@section('az_slug',$company_page->seo_title)
@section('en_slug',$company_page->seo_description)
@section('ru_slug',$company_page->seo_keywords)
@section('content')

    <section class="relative md:py-24 py-16 section">
        <div class="container">
            <div class="grid md:grid-cols-12 grid-cols-1 gap-[30px] justify-center"> <!-- Added justify-center -->

                <div class="lg:col-span-8 md:col-span-6">
                    <div class="grid grid-cols-1 gap-[10px]">
                        @foreach($companies as $company)
                            <div
                                class="group relative overflow-hidden lg:flex justify-between items-center rounded shadow hover:shadow-md dark:shadow-gray-700  p-2">
                                <div class="flex items-center">
                                    <div
                                        class="size-14 flex items-center justify-center bg-white dark:bg-slate-900 shadow dark:shadow-gray-700 rounded-md">
                                        <img src="{{asset('storage/' . $company->image)}}" class="size-8"
                                             alt="{{$company->title}}">
                                    </div>
                                    <div>
                                        <a href="{{ route('welcome', ['company_id' => $company->id]) }}"
                                           class="text-lg hover:text-emerald-600 font-semibold transition-all duration-500 ms-3 min-w-[150px]">
                                            {{$company->title}}
                                        </a>
                                        <span class="block text-slate-400 text-sm md:mt-1 mt-0 new_class">
                                        {{$company->short_title}}
                                    </span>
                                    </div>
                                </div>

                                <div class="flex justify-between ">
                                    <div class="lg:block flex justify-between lg:mt-0 mt-4">
                                        <span class="block text-slate-400 text-sm md:mt-1 mt-0"> {{$company->vacancies_count}} {{$words['job_add']->translate(app()->getLocale())->title}}</span>
                                    </div>
                                </div>
                            </div><!--end content-->
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="grid md:grid-cols-12 grid-cols-1 mt-8">
                        @if ($companies->lastPage() > 1)
                            <div class="md:col-span-12 text-center">
                                <nav aria-label="Page navigation example">
                                    <ul class="inline-flex items-center -space-x-px">
                                        @if ($companies->onFirstPage())
                                            <li>
                                <span class="size-[30px] md:size-[40px] inline-flex justify-center items-center text-slate-400 bg-white dark:bg-slate-900 rounded-s-3xl border border-gray-100 dark:border-gray-800 cursor-not-allowed">
                                    <i class="uil uil-angle-left text-[16px] md:text-[20px] rtl:rotate-180 rtl:-mt-1"></i>
                                </span>
                                            </li>
                                        @else
                                            <li>
                                                <a href="{{ $companies->previousPageUrl() }}"
                                                   class="size-[30px] md:size-[40px] inline-flex justify-center items-center text-slate-400 bg-white dark:bg-slate-900 rounded-s-3xl border border-gray-100 dark:border-gray-800 hover:text-white hover:border-emerald-600 hover:bg-emerald-600 dark:hover:border-emerald-600">
                                                    <i class="uil uil-angle-left text-[16px] md:text-[20px] rtl:rotate-180 rtl:-mt-1"></i>
                                                </a>
                                            </li>
                                        @endif

                                        @foreach ($companies->getUrlRange(1, $companies->lastPage()) as $page => $url)
                                            <li>
                                                @if ($page == $companies->currentPage())
                                                    <span class="z-10 size-[30px] md:size-[40px] inline-flex justify-center items-center text-white bg-emerald-600 border border-emerald-600">{{ $page }}</span>
                                                @else
                                                    <a href="{{ $url }}" class="size-[30px] md:size-[40px] inline-flex justify-center items-center text-slate-400 bg-white dark:bg-slate-900 border border-gray-100 dark:border-gray-800 hover:text-white hover:border-emerald-600 hover:bg-emerald-600 dark:hover:border-emerald-600">{{ $page }}</a>
                                                @endif
                                            </li>
                                        @endforeach

                                        @if ($companies->hasMorePages())
                                            <li>
                                                <a href="{{ $companies->nextPageUrl() }}"
                                                   class="size-[30px] md:size-[40px] inline-flex justify-center items-center text-slate-400 bg-white dark:bg-slate-900 rounded-e-3xl border border-gray-100 dark:border-gray-800 hover:text-white hover:border-emerald-600 hover:bg-emerald-600 dark:hover:border-emerald-600">
                                                    <i class="uil uil-angle-right text-[16px] md:text-[20px] rtl:rotate-180 rtl:-mt-1"></i>
                                                </a>
                                            </li>
                                        @else
                                            <li>
                                <span class="size-[30px] md:size-[40px] inline-flex justify-center items-center text-slate-400 bg-white dark:bg-slate-900 rounded-e-3xl border border-gray-100 dark:border-gray-800 cursor-not-allowed">
                                    <i class="uil uil-angle-right text-[16px] md:text-[20px] rtl:rotate-180 rtl:-mt-1"></i>
                                </span>
                                            </li>
                                        @endif
                                    </ul>
                                </nav>
                            </div>
                        @endif
                    </div>
                </div><!--end col-->
            </div><!--end grid-->
        </div><!--end container-->
    </section>


@endsection
