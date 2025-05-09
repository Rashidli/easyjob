@extends('front.layouts.master')

@section('title', 'Login')
@section('description', 'Login')
@section('keywords', 'Login')

@section('content')

    <section class="relative h-screen flex justify-center items-center bg-slate-50 dark:bg-slate-800">
{{--        <div class="absolute inset-0 bg-gradient-to-b from-transparent to-black"></div>--}}
        <div class="container">
            <div class="md:flex justify-center">
                <div class="relative overflow-hidden bg-white dark:bg-slate-900 shadow-md dark:shadow-gray-800 rounded-md lg:w-2/5">
                    <div class="p-6">
                        <h5 class="my-6 text-xl font-semibold">Daxil ol</h5>
                        <form class="text-start" action="{{route('company.login.post')}}" method="post">
                            @csrf
                            <div class="grid grid-cols-1">
                                <div class="mb-4 text-start">
                                    <label class="font-semibold" for="LoginEmail">E-poçt:</label>
                                    <input id="LoginEmail" name="email" type="email" class="form-input mt-3 rounded-md" >
                                </div>

                                <div class="mb-4 text-start">
                                    <label class="font-semibold" for="LoginPassword">Parol:</label>
                                    <input id="LoginPassword" name="password" type="password" class="form-input mt-3 rounded-md" >
                                </div>

                                <div class="flex justify-between mb-4">
                                    <div class="inline-flex items-center mb-0">
                                        <input name="remember" class="form-checkbox rounded border-gray-200 dark:border-gray-800 text-emerald-600 focus:border-emerald-300 focus:ring focus:ring-offset-0 focus:ring-emerald-200 focus:ring-opacity-50 me-2" type="checkbox" id="RememberMe">
                                        <label class="form-checkbox-label text-slate-400" for="RememberMe">Məni xatırla</label>
                                    </div>
                                    <p class="text-slate-400 mb-0"><a href="{{route('company.password.request')}}" class="text-slate-400">Parolu unutmusan?</a></p>
                                </div>

                                <div class="mb-4">
                                    <input type="submit" class="btn bg-emerald-600 hover:bg-emerald-700 border-emerald-600 hover:border-emerald-700 text-white rounded-md w-full" value="Daxil ol">
                                </div>

                                <div class="text-center">
                                    <span class="text-slate-400 me-2">Hesabın yoxdur?</span> <a href="{{route('company.register')}}" class="text-black dark:text-white font-bold">Qeydiyyatdan keç</a>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section><!--end section -->

@endsection
