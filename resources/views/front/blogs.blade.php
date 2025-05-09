@extends('front.layouts.master')

@section('title', $blog_page->seo_title)
@section('description', $blog_page->seo_description)
@section('keywords', $blog_page->seo_keywords)
@section('az_slug',$blog_page->seo_title)
@section('en_slug',$blog_page->seo_description)
@section('ru_slug',$blog_page->seo_keywords)
@section('content')

    <section class="relative md:py-24 py-16">
        <div class="container">
            <div class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-[30px]">
                @foreach($blogs as $blog)
                    <div class="group relative overflow-hidden bg-white dark:bg-slate-900 rounded-md shadow dark:shadow-gray-700">
                        <div class="relative overflow-hidden for_blog_image">
                            <img src="{{asset('storage/' . $blog->image)}}" class="scale-110 group-hover:scale-100 transition-all duration-500" alt="{{$blog->img_alt}}" title="{{$blog->img_title}}">
                        </div>

                        <div class="relative p-6">
{{--                            <div class="absolute start-6 -top-4">--}}
{{--                                <span class="bg-emerald-600 text-white text-[12px] px-2.5 py-1 font-semibold rounded-full h-5">Arts</span>--}}
{{--                            </div>--}}

                            <div class="">
                                <div class="flex mb-4">
                                    <span class="text-slate-400 text-sm"><i class="uil uil-calendar-alt text-slate-900 dark:text-white me-2"></i>{{$blog->created_at->format('d.m.Y')}}</span>
{{--                                    <span class="text-slate-400 text-sm ms-3"><i class="uil uil-clock text-slate-900 dark:text-white me-2"></i>5 min read</span>--}}
                                </div>

                                <a href="{{route('dynamic.page', $blog->slug)}}" class="title text-lg font-semibold hover:text-emerald-600 duration-500 ease-in-out">{{$blog->title}}</a>

                                <div class="flex justify-between items-center mt-3">
                                    <a href="{{route('dynamic.page', $blog->slug)}}" class="btn btn-link hover:text-emerald-600 after:bg-emerald-600 duration-500 ease-in-out">{{$words['more']->translate(app()->getLocale())->title}}<i class="uil uil-arrow-right"></i></a>
{{--                                    <span class="text-slate-400 text-sm">by <a href="" class="text-slate-900 dark:text-white hover:text-emerald-600 dark:hover:text-emerald-600 font-medium">Google</a></span>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach


                <!--end content-->
            </div><!--end grid-->

{{--            <div class="grid md:grid-cols-12 grid-cols-1 mt-8">--}}
{{--                <div class="md:col-span-12 text-center">--}}
{{--                    <nav aria-label="Page navigation example">--}}
{{--                        <ul class="inline-flex items-center -space-x-px">--}}
{{--                            <li>--}}
{{--                                <a href="#" class="size-[40px] inline-flex justify-center items-center text-slate-400 bg-white dark:bg-slate-900 rounded-s-3xl hover:text-white border border-gray-100 dark:border-gray-800 hover:border-emerald-600 dark:hover:border-emerald-600 hover:bg-emerald-600 dark:hover:bg-emerald-600">--}}
{{--                                    <i class="uil uil-angle-left text-[20px] rtl:rotate-180 rtl:-mt-1"></i>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <a href="#" class="size-[40px] inline-flex justify-center items-center text-slate-400 hover:text-white bg-white dark:bg-slate-900 border border-gray-100 dark:border-gray-800 hover:border-emerald-600 dark:hover:border-emerald-600 hover:bg-emerald-600 dark:hover:bg-emerald-600">1</a>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <a href="#" class="size-[40px] inline-flex justify-center items-center text-slate-400 hover:text-white bg-white dark:bg-slate-900 border border-gray-100 dark:border-gray-800 hover:border-emerald-600 dark:hover:border-emerald-600 hover:bg-emerald-600 dark:hover:bg-emerald-600">2</a>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <a href="#" aria-current="page" class="z-10 size-[40px] inline-flex justify-center items-center text-white bg-emerald-600 border border-emerald-600">3</a>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <a href="#" class="size-[40px] inline-flex justify-center items-center text-slate-400 hover:text-white bg-white dark:bg-slate-900 border border-gray-100 dark:border-gray-800 hover:border-emerald-600 dark:hover:border-emerald-600 hover:bg-emerald-600 dark:hover:bg-emerald-600">4</a>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <a href="#" class="size-[40px] inline-flex justify-center items-center text-slate-400 hover:text-white bg-white dark:bg-slate-900 border border-gray-100 dark:border-gray-800 hover:border-emerald-600 dark:hover:border-emerald-600 hover:bg-emerald-600 dark:hover:bg-emerald-600">5</a>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <a href="#" class="size-[40px] inline-flex justify-center items-center text-slate-400 bg-white dark:bg-slate-900 rounded-e-3xl hover:text-white border border-gray-100 dark:border-gray-800 hover:border-emerald-600 dark:hover:border-emerald-600 hover:bg-emerald-600 dark:hover:bg-emerald-600">--}}
{{--                                    <i class="uil uil-angle-right text-[20px] rtl:rotate-180 rtl:-mt-1"></i>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </nav>--}}
{{--                </div><!--end col-->--}}
{{--            </div>--}}
            <!--end grid-->
        </div><!--end container-->
    </section>


@endsection
