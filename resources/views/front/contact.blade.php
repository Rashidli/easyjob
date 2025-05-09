@extends('front.layouts.master')

@section('title', $contact->seo_title)
@section('description', $contact->requirements)
@section('keywords', $contact->requirements)

@section('az_slug',$contact->seo_title)
@section('en_slug',$contact->seo_description)
@section('ru_slug',$contact->seo_keywords)

@section('content')

    <section class="relative lg:py-24 py-16">
        <div class="container">
            <div class="grid md:grid-cols-12 grid-cols-1 items-center gap-[30px]">
                <div class="lg:col-span-7 md:col-span-6">
                    <img src="{{asset('/')}}front/images/svg/contact.svg" alt="">
                </div>

                <div class="lg:col-span-5 md:col-span-6">
                    <div class="lg:ms-5">
                        <div class="bg-white dark:bg-slate-900 rounded-md shadow dark:shadow-gray-700 p-6">
                            <h3 class="mb-6 text-2xl leading-normal font-semibold">Biz zəng edək!</h3>

                            <form method="post"  action="{{route('contact_post')}}">
                                @csrf
                                <p class="mb-0" id="error-msg"></p>
                                <div id="simple-msg"></div>
                                <div class="grid lg:grid-cols-12 lg:gap-6">
                                    <div class="lg:col-span-6 mb-5">
                                        <label for="name" class="font-semibold">Adınız:</label>
                                        <input required name="name" id="name" type="text" class="form-input border border-slate-100 dark:border-slate-800 mt-2" placeholder="Ad :">
                                    </div>

                                    <div class="lg:col-span-6 mb-5">
                                        <label for="email" class="font-semibold">E-poçt:</label>
                                        <input required name="email" id="email" type="email" class="form-input border border-slate-100 dark:border-slate-800 mt-2" placeholder="E-poçt :">
                                    </div>
                                </div>

                                <div class="grid grid-cols-1">
                                    <div class="mb-5">
                                        <label for="subject" class="font-semibold">Telefon:</label>
                                        <input required name="phone" id="subject" class="form-input border border-slate-100 dark:border-slate-800 mt-2" placeholder="Telefon :">
                                    </div>

                                    <div class="mb-5">
                                        <label for="comments" class="font-semibold">Mesajınız:</label>
                                        <textarea required name="message" id="comments" class="form-input border border-slate-100 dark:border-slate-800 mt-2 textarea" placeholder="Mesajınız :"></textarea>
                                    </div>
                                </div>
                                <button type="submit" class="btn bg-emerald-600 hover:bg-emerald-700 text-white rounded-md">Göndər</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--end container-->

        <div class="container lg:mt-24 mt-16">
            <div class="grid grid-cols-1 lg:grid-cols-2 md:grid-cols-2 gap-[30px]">
                <div class="text-center px-6">
                    <div class="relative text-transparent">
                        <div class="size-14 bg-emerald-600/5 text-emerald-600 rounded-xl text-2xl flex align-middle justify-center items-center mx-auto shadow-sm dark:shadow-gray-800">
                            <i class="uil uil-phone"></i>
                        </div>
                    </div>

                    <div class="content mt-7">
                        <h5 class="title h5 text-lg font-semibold">Telefon</h5>

                        <div class="mt-5">
                            <a href="tel:+994506761790" class="btn btn-link text-emerald-600 hover:text-emerald-600 after:bg-emerald-600 transition duration-500">+994 50 676 17 90</a>
                        </div>
                    </div>
                </div>

                <div class="text-center px-6">
                    <div class="relative text-transparent">
                        <div class="size-14 bg-emerald-600/5 text-emerald-600 rounded-xl text-2xl flex align-middle justify-center items-center mx-auto shadow-sm dark:shadow-gray-800">
                            <i class="uil uil-envelope"></i>
                        </div>
                    </div>

                    <div class="content mt-7">
                        <h5 class="title h5 text-lg font-semibold">E-poçt</h5>

                        <div class="mt-5">
                            <a href="mailto:info@easyjob.az" class="btn btn-link text-emerald-600 hover:text-emerald-600 after:bg-emerald-600 transition duration-500">info@easyjob.az</a>
                        </div>
                    </div>
                </div>

{{--                <div class="text-center px-6">--}}
{{--                    <div class="relative text-transparent">--}}
{{--                        <div class="size-14 bg-emerald-600/5 text-emerald-600 rounded-xl text-2xl flex align-middle justify-center items-center mx-auto shadow-sm dark:shadow-gray-800">--}}
{{--                            <i class="uil uil-map-marker"></i>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="content mt-7">--}}
{{--                        <h5 class="title h5 text-lg font-semibold">Ünvan</h5>--}}

{{--                        <div class="mt-5">--}}
{{--                            <a href="https://maps.app.goo.gl/G9gQbKGypuHQW37S9"--}}
{{--                               data-type="iframe" class="video-play-icon read-more lightbox btn btn-link text-emerald-600 hover:text-emerald-600 after:bg-emerald-600 transition duration-500">Mirəli Qaşqay, 22</a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div><!--end grid-->
        </div><!--end container-->
    </section>

@endsection

