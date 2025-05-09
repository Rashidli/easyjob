@extends('front.layouts.master')

@section('title', 'Success')
@section('description', 'Success')
@section('keywords', 'Success')

@section('content')

    <section class="relative h-screen flex justify-center items-center bg-slate-50 dark:bg-slate-800">
        <div class="container">
            <div class="md:flex justify-center">
                <div class="lg:w-2/5">
                    <div class="relative overflow-hidden rounded-md bg-white dark:bg-slate-900 shadow dark:shadow-gray-800">
                        <div class="px-6 py-12 bg-emerald-600 text-center">
                            <i class="uil uil-check-circle text-white text-8xl"></i>
                            <h5 class="text-white text-xl tracking-wide uppercase font-semibold mt-2">Uğurlu</h5>
                        </div>

                        <div class="px-6 py-12 text-center">
                            <p class="text-black font-semibold text-xl dark:text-white">Təbrik edirik! 🎉</p>
                            <p class="text-slate-400 mt-4">Sizin qeydiyyatınız tamamlandı <br> Enjoy your journey. Thank you</p>

                            <div class="mt-6">
                                <a href="{{route('company.login')}}" class="btn bg-emerald-600 hover:bg-emerald-700 border-emerald-600 hover:border-indigobg-emerald-700 text-white rounded-md">Daxil ol</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div><!--end container-->
    </section><!--end section-->

@endsection
