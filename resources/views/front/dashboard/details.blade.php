@extends('front.layouts.master')

@section('title', 'Details')
@section('description', 'Details')
@section('keywords', 'Details')

<style>
    .sidebar-menu a.active {
        background-color: #10b981; /* emerald-500 */
        color: white;
        border-radius: 0.5rem; /* rounded-lg */
    }

    .sidebar-menu a:hover {
        background-color: #d1fae5; /* emerald-100 */
        color: #065f46; /* emerald-800 */
    }
</style>

@section('content')

    <section class="relative mb:pb-24 pb-16 mt-30 z-1">
        <div class="container mt-12">
            <div class="grid md:grid-cols-12 grid-cols-1 gap-[30px]">
                <!-- Sidebar -->
                @include('front.includes.sidebar')

                <!-- Main Content -->
                <div class="lg:col-span-8 md:col-span-7">
                    <div class="p-6 rounded-md shadow-lg bg-white dark:bg-gray-800 mt-8">
                        <h5 class="text-2xl font-semibold mb-6">Məlumatları dəyiş:</h5>

                        <form class="space-y-6" action="{{ route('company.update', $company->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="grid lg:grid-cols-12 lg:gap-6">

                                <!-- Şirkət adı -->
                                <div class="lg:col-span-6">
                                    <label for="title" class="block font-medium text-gray-700">Şirkət adı:</label>
                                    <div class="relative mt-2">
                                        <input name="title" id="title" type="text"
                                               class="form-input w-full border-gray-300 focus:border-emerald-500 focus:ring focus:ring-emerald-300 rounded-lg shadow-sm"
                                               value="{{ $company->title }}">
                                    </div>
                                </div>

                                <!-- Əlaqədar şəxs -->
                                <div class="lg:col-span-6">
                                    <label for="name" class="block font-medium text-gray-700">Əlaqədar şəxs:</label>
                                    <div class="relative mt-2">
                                        <input name="name" id="name" type="text"
                                               class="form-input w-full border-gray-300 focus:border-emerald-500 focus:ring focus:ring-emerald-300 rounded-lg shadow-sm"
                                               value="{{ $company->name }}">
                                    </div>
                                </div>

                                <!-- Əlaqədar şəxs -->
                                <div class="lg:col-span-6">
                                    <label for="phone" class="block font-medium text-gray-700">Əlaqə nömrəsi:</label>
                                    <div class="relative mt-2">
                                        <input name="phone" id="phone" type="text"
                                               class="form-input w-full border-gray-300 focus:border-emerald-500 focus:ring focus:ring-emerald-300 rounded-lg shadow-sm"
                                               value="{{ $company->phone }}">
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="grid lg:grid-cols-12 lg:gap-6">
                                <!-- Parol -->
                                <div class="lg:col-span-6">
                                    <label for="password" class="block font-medium text-gray-700">Parol:</label>
                                    <div class="relative mt-2">
                                        <input name="password" id="password" type="password"
                                               class="form-input w-full border-gray-300 focus:border-emerald-500 focus:ring focus:ring-emerald-300 rounded-lg shadow-sm">
                                    </div>
                                </div>

                                <!-- E-poçt -->
                                <div class="lg:col-span-6">
                                    <label for="email" class="block font-medium text-gray-700">E-poçt:</label>
                                    <div class="relative mt-2">
                                        <input name="email" id="email" type="email"
                                               class="form-input w-full border-gray-300 focus:border-emerald-500 focus:ring focus:ring-emerald-300 rounded-lg shadow-sm"
                                               value="{{ $company->email }}">
                                    </div>
                                </div>
                            </div>
                            <br>
                            <button type="submit"
                                    class="w-full py-3 bg-emerald-600 text-white font-medium rounded-lg shadow-md hover:bg-emerald-700 transition-all">
                                Yadda saxla
                            </button>
                        </form>
                    </div>
                </div><!--end col-->
            </div><!--end grid-->
        </div><!--end container-->
    </section><!--end section-->

@endsection
