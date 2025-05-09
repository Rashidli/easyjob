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

    .vacancy-status {
        padding: 4px 8px;
        border-radius: 9999px;
        font-weight: 600;
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
                        <h5 class="text-2xl font-semibold mb-6">Geri qaytarılmış vakansiyalar</h5>

                        <!-- Vacancy List -->
                        <div class="space-y-6">
                            @foreach($vacancies as $vacancy)
                                <div class="p-4 bg-gray-50 text-black dark:text-gray-300 rounded-lg shadow-md flex justify-between items-center">
                                    <div class="flex flex-col">
                                        <span class="text-lg font-semibold text-gray-900 text-black dark:text-gray-300">{{ $vacancy->vacancy_name }}</span>
                                    </div>
                                    <div class="vacancy-status">
                                        <a href="{{route('vacancy_edit',$vacancy->id)}}">Dəyişdir</a>
                                    </div>
                                </div>
                                <br>
                            @endforeach
                        </div>

                    </div>
                </div><!--end col-->

            </div><!--end grid-->
        </div><!--end container-->
    </section><!--end section-->

@endsection
