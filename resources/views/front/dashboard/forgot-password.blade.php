@extends('front.layouts.master')

@section('title', 'Reset password')
@section('description', 'Reset password')
@section('keywords', 'Reset password')

@section('content')

    <section class="relative h-screen flex justify-center items-center bg-slate-50 dark:bg-slate-800">
        <div class="container">
            <div class="md:flex justify-center">
                <div class="relative overflow-hidden bg-white dark:bg-slate-900 shadow-md dark:shadow-gray-800 rounded-md lg:w-2/5">
                    <div class="p-6">
                        <h5 class="my-6 text-xl font-semibold">Emailinizi daxil edin</h5>
                        <form class="text-start" action="{{route('company.password.email')}}" method="post">
                            @csrf
                            <div class="grid grid-cols-1">
                                <div class="mb-4 text-start">
                                    <label class="font-semibold" for="LoginEmail">E-poçt:</label>
                                    <input id="LoginEmail" name="email" type="email" class="form-input mt-3 rounded-md" >
                                </div>

                                <div class="mb-4">
                                    <input type="submit" class="btn bg-emerald-600 hover:bg-emerald-700 border-emerald-600 hover:border-emerald-700 text-white rounded-md w-full" value="Daxil ol">
                                </div>

                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section><!--end section -->

@endsection
