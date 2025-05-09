@extends('front.layouts.master')

@section('title', $blog->meta_title)
@section('description', $blog->meta_description)
@section('keywords', $blog->meta_keywords)

@section('az_slug',$blog->meta_title)
@section('en_slug',$blog->meta_description)
@section('ru_slug',$blog->meta_keywords)
@section('content')

    <section class="relative md:py-24 py-16 bg-gray-50 dark:bg-slate-900">
        <div class="container">
            <div class="grid md:grid-cols-12 grid-cols-1 gap-10">
                <div class="lg:col-span-8 md:col-span-6 mx-auto">
                    <div class="relative overflow-hidden rounded-md shadow-lg dark:shadow-gray-800 bg-white dark:bg-slate-800">
                        <!-- Blog Image -->
                        <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->img_alt }}" title="{{ $blog->img_title }}" class="w-full h-auto object-cover rounded-t-md">

                        <!-- Blog Content -->
                        <div class="p-6">
                            <!-- Blog Title -->
                            <h4 class="text-2xl font-bold text-slate-900 dark:text-white mb-4">{{ $blog->title }}</h4>

                            <!-- Blog Description -->
                            <p class="text-slate-500 dark:text-slate-300 leading-relaxed mt-3">{!! $blog->description !!}</p>
                        </div>

                        <!-- Blog Metadata (Optional) -->
                        <div class="p-6 border-t dark:border-gray-700 flex justify-between items-center">
                            <div class="flex items-center">
                            <span class="text-slate-500 dark:text-slate-400 text-sm mr-4">
                                <i class="uil uil-calendar-alt mr-1"></i> {{ $blog->created_at->format('d.m.Y') }}
{{--                            </span>--}}
{{--                                <span class="text-slate-500 dark:text-slate-400 text-sm">--}}
{{--                                <i class="uil uil-eye mr-1"></i> {{ $blog->views }} views--}}
{{--                            </span>--}}
                            </div>

                            <div class="flex items-center space-x-4">
                                <!-- Facebook Share -->
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}"
                                   target="_blank"
                                   class="text-slate-500 hover:text-emerald-600 dark:text-slate-400 dark:hover:text-emerald-600 transition text-2xl">
                                    <i class="uil uil-facebook-f"></i>
                                </a>

                                <!-- Twitter Share -->
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($blog->title) }}"
                                   target="_blank"
                                   class="text-slate-500 hover:text-emerald-600 dark:text-slate-400 dark:hover:text-emerald-600 transition text-2xl">
                                    <i class="uil uil-twitter"></i>
                                </a>

                                <!-- LinkedIn Share -->
                                <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->fullUrl()) }}"
                                   target="_blank"
                                   class="text-slate-500 hover:text-emerald-600 dark:text-slate-400 dark:hover:text-emerald-600 transition text-2xl">
                                    <i class="uil uil-linkedin"></i>
                                </a>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



@endsection
