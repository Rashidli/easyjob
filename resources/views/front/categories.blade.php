@extends('front.layouts.master')

@section('title', $category_page->seo_title)
@section('description', $category_page->seo_description)
@section('keywords', $category_page->seo_keywords)

@section('az_slug',$category_page->seo_title)
@section('en_slug',$category_page->seo_description)
@section('ru_slug',$category_page->seo_keywords)
@section('content')

    <section class="relative md:py-24 py-16 section">
        <div class="container">
            <div class="grid md:grid-cols-12 grid-cols-1 gap-[30px] justify-center"> <!-- Added justify-center -->

                <div class="lg:col-span-8 md:col-span-6">
                    <div class="grid grid-cols-1 gap-[10px]">
                        @foreach($categories as $category)
                            <a href="{{ route('welcome', ['category_id' => $category->id]) }}"
                               class="group relative overflow-hidden flex justify-between items-center rounded shadow hover:shadow-md dark:shadow-gray-700 p-2">

                                <!-- Category Image -->
                                <div class="flex items-center">
                                    <div class="size-14 flex items-center justify-center bg-white dark:bg-slate-900 shadow dark:shadow-gray-700 rounded-md">
                                        <img src="{{ asset('storage/' . $category->image) }}" class="size-8" alt="{{ $category->title }}">
                                    </div>

                                    <!-- Category Title and Vacancy Count -->
                                    <div class="ms-3 min-w-[150px]">
                    <span class="text-lg hover:text-emerald-600 font-semibold transition-all duration-500">
                        {{ $category->title }}
                    </span>
                                        <span class="block text-slate-400 text-sm mt-1">
                        {{ $category->vacancies_count }} {{ $words['job_add']->translate(app()->getLocale())->title }}
                    </span>
                                    </div>
                                </div>

                                <!-- Companies Count -->
                                <div class="lg:block flex justify-between lg:mt-0 mt-4">
                <span class="block text-slate-400 text-sm">
                    {{ $category->companies_count }} {{ $words['company_little']->translate(app()->getLocale())->title }}
                </span>
                                </div>
                            </a>
                        @endforeach
                    </div>


                    <!-- Pagination -->
                    @if ($categories->lastPage() > 1)
                        <div class="grid md:grid-cols-12 grid-cols-1 mt-8">
                            <div class="md:col-span-12 text-center">
                                <nav aria-label="Page navigation example">
                                    <ul class="inline-flex items-center -space-x-px">
                                        <!-- Pagination logic here -->
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    @endif
                </div><!--end col-->
            </div><!--end grid-->
        </div><!--end container-->
    </section>


@endsection
