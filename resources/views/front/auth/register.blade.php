@extends('front.layouts.master')

@section('title', 'Register')
@section('description', 'Register')
@section('keywords', 'Register')

@section('content')

    <section class="h-screen flex items-center justify-center relative overflow-hidden bg-no-repeat bg-center bg-cover">
{{--        <div class="absolute inset-0 bg-gradient-to-b from-transparent to-black"></div>--}}
        <div class="container">
            <div class="md:flex justify-center">
                <div class="relative overflow-hidden bg-white dark:bg-slate-900 shadow-md dark:shadow-gray-800 rounded-md lg:w-2/5">
                    <div class="p-6">
                        <h5 class="my-6 text-xl font-semibold">Qeydiyyat</h5>
                        <form action="{{route('company.register.post')}}" method="post" class="text-start">
                            @csrf
                            <div class="grid grid-cols-1">
                                <div class="mb-4 text-start">
                                    <label class="font-semibold" for="RegisterName">Şirkət:</label>
                                    <input id="RegisterName" name="title" value="{{old('title')}}" type="text" class="form-input mt-3 rounded-md" >
                                    @if($errors->first('title')) <small class="form-text text-danger">{{ $errors->first('title') }}</small>@endif
                                </div>
                                <div class="mb-4 text-start">
                                    <label class="font-semibold" for="RegisterName">Əlaqədar şəxs:</label>
                                    <input id="RegisterName" name="name" type="text" value="{{old('name')}}" class="form-input mt-3 rounded-md" >
                                    @if($errors->first('name')) <small class="form-text text-danger">{{ $errors->first('name') }}</small>@endif
                                </div>
                                <div class="mb-4 text-start">
                                    <label class="font-semibold" for="RegisterName">Əlaqə nömrəsi:</label>
                                    <input id="RegisterName" name="phone" type="text" value="{{old('phone')}}" class="form-input mt-3 rounded-md" >
                                    @if($errors->first('phone')) <small class="form-text text-danger">{{ $errors->first('phone') }}</small>@endif
                                </div>

                                <div class="mb-4 text-start">
                                    <label class="font-semibold" for="LoginEmail">E-poçt:</label>
                                    <input id="LoginEmail" type="email" name="email" value="{{old('email')}}" class="form-input mt-3 rounded-md" >
                                    @if($errors->first('email')) <small class="form-text text-danger">{{ $errors->first('email') }}</small>@endif
                                </div>

                                <div class="mb-4 text-start">
                                    <label class="font-semibold" for="LoginPassword">Parol:</label>
                                    <input id="LoginPassword" type="password" name="password" class="form-input mt-3 rounded-md" >
                                    @if($errors->first('password')) <small class="form-text text-danger">{{ $errors->first('password') }}</small>@endif
                                </div>

                                <div class="mb-4">
                                    <div class="flex items-center mb-0">
                                        <input name="terms" class="form-checkbox rounded border-gray-200 dark:border-gray-800 text-emerald-600 focus:border-emerald-300 focus:ring focus:ring-offset-0 focus:ring-emerald-200 focus:ring-opacity-50 me-2" type="checkbox" value="" id="Accept:T&C">
                                        @if($errors->first('terms')) <small class="form-text text-danger">{{ $errors->first('terms') }}</small>@endif
                                        <label class="form-checkbox-label text-slate-400" for="Accept:T&C">Qəbul edirəm <a href="" class="text-emerald-600">Qaydalar və şərtlər</a></label>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <input type="submit" class="btn bg-emerald-600 hover:bg-emerald-700 border-emerald-600 hover:border-emerald-700 text-white rounded-md w-full" value="Qeydiyyat">
                                </div>

                                <div class="text-center">
                                    <span class="text-slate-400 me-2">Qeydiyyatınız var? </span> <a href="{{route('company.login')}}" class="text-black dark:text-white font-bold">Daxil ol</a>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>

@endsection
