@extends('front.layouts.master')

@section('title', $about_page->seo_title)
@section('description', $about_page->seo_description)
@section('keywords', $about_page->seo_keywords)
@section('az_slug',$about_page->seo_title)
@section('en_slug',$about_page->seo_description)
@section('ru_slug',$about_page->seo_keywords)
@section('content')

    <section class="relative md:py-24 py-16 bg-gray-50 dark:bg-slate-900">
        <div class="container">
            <div class="grid md:grid-cols-12 grid-cols-1 gap-10">
                <div class="lg:col-span-8 md:col-span-6 mx-auto">
                    <div class="relative overflow-hidden rounded-md shadow-lg dark:shadow-gray-800 bg-white dark:bg-slate-800">
                        <!-- Blog Image -->
                        <img src="{{ asset('storage/' . $about->image) }}" alt="{{ $about->img_alt }}" title="{{ $about->img_title }}" class="w-full h-auto object-cover rounded-t-md">

                        <!-- Blog Content -->
                        <div class="p-6">
                            <!-- Blog Title -->
                            <h4 class="text-2xl font-bold text-slate-900 dark:text-white mb-4">{{ $about->title }}</h4>

                            <!-- Blog Description -->
                            <p class="text-slate-500 dark:text-slate-300 leading-relaxed mt-3">{!! $about->description !!}</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>



@endsection
