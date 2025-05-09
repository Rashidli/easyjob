@extends('front.layouts.master')

@section('title', $home_page->seo_title)
@section('description', $home_page->seo_description)
@section('keywords', $home_page->seo_keywords)
@section('az_slug','')
@section('en_slug','en')
@section('ru_slug','ru')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [{
    "@type": "Question",
    "name": "Vakansiya nədir?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "Vakansiya, işəgötürənin boş olan və uyğun işçi ilə doldurmaq istədiyi iş yeridir."
    }
  },{
    "@type": "Question",
    "name": "Vakansiyalar niyə işəgötürənlər üçün vacibdir?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "Vakansiyalar işəgötürənlərin lazım olan bacarıqlara malik işçiləri tapmasını təmin edir."
    }
  },{
    "@type": "Question",
    "name": "Vakansiyalar iş axtaranlara hansı üstünlükləri təmin edir?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "İş axtaranlar vakansiyalar sayəsində yeni iş imkanları əldə edir və karyeralarını inkişaf etdirirlər."
    }
  },{
    "@type": "Question",
    "name": "Vakansiyalara müraciət edərkən nəyə diqqət etmək lazımdır?",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "Müraciət edərkən iş təsvirinə uyğun bacarıq və təcrübələri vurğulamaq vacibdir."
    }
  }]
}

</script>

@section('content')

    <section class="relative md:py-24 py-16">
        <div class="container">
            <div class="grid md:grid-cols-12 grid-cols-1 gap-[30px]">
                <div class="lg:col-span-4 md:col-span-6">
                    <div class="shadow dark:shadow-gray-700 p-6 rounded-md bg-white dark:bg-slate-900 sticky top-20">
                        <form action="{{ route('welcome') }}" method="get">
                            <div class="grid grid-cols-1 gap-3">
                                <!-- Search Field -->
                                <div>
                                    <h2 for="searchname" class="font-semibold">

                                        {{$words['adds_search']->translate(app()->getLocale())->title}}
                                    </h2>
                                    <div class="relative mt-2">
                                        <i class="uil uil-search text-lg absolute top-[5px] start-3 mt-2"></i>
                                        <input name="search" id="searchname" type="text"
                                               class="form-input border border-slate-100 dark:border-slate-800 ps-10"
                                               placeholder="{{$words['adds_search']->translate(app()->getLocale())->title}}"
                                               value="{{ request()->get('search', '') }}">
                                    </div>
                                </div>

                                <!-- Company Field -->
                                <div>
                                    <label
                                        class="font-semibold">{{$words['company']->translate(app()->getLocale())->title}}</label>
                                    <select name="company_id"
                                            class="form-select form-input border border-slate-100 dark:border-slate-800 block w-full mt-1"
                                            id="choices_company">
                                        <option
                                            value="" {{ request()->get('company_id') == '' ? 'selected' : '' }}>{{$words['all']->translate(app()->getLocale())->title}}</option>
                                        @foreach($companies as $company)
                                            <option value="{{ $company->id }}"
                                                {{ request()->get('company_id') == $company->id ? 'selected' : '' }}>
                                                {{ $company->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Category Field -->
                                <div>
                                    <label
                                        class="font-semibold">{{$words['category']->translate(app()->getLocale())->title}}</label>
                                    <select name="category_id"
                                            class="form-select form-input border border-slate-100 dark:border-slate-800 block w-full mt-1"
                                            id="choices">
                                        <option
                                            value="" {{ request()->get('category_id') == '' ? 'selected' : '' }}>{{$words['all']->translate(app()->getLocale())->title}}</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ request()->get('category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Date Field -->
                                <div>
                                    <label
                                        class="font-semibold">{{$words['step']->translate(app()->getLocale())->title}}</label>
                                    <select name="date"
                                            class="form-select form-input border border-slate-100 dark:border-slate-800 block w-full mt-1"
                                            id="choices-type">
                                        <option
                                            value="" {{ request()->get('date') == '' ? 'selected' : '' }}>{{$words['all']->translate(app()->getLocale())->title}}</option>
                                        <option
                                            value="one_day" {{ request()->get('date') == 'one_day' ? 'selected' : '' }}>{{$words['one']->translate(app()->getLocale())->title}}</option>
                                        <option
                                            value="three_days" {{ request()->get('date') == 'three_days' ? 'selected' : '' }}>{{$words['three']->translate(app()->getLocale())->title}}</option>
                                        <option
                                            value="one_week" {{ request()->get('date') == 'one_week' ? 'selected' : '' }}>{{$words['week']->translate(app()->getLocale())->title}}</option>
                                        <option
                                            value="ten_days" {{ request()->get('date') == 'ten_days' ? 'selected' : '' }}>{{$words['ten']->translate(app()->getLocale())->title}}</option>
                                        <option
                                            value="two_weeks" {{ request()->get('date') == 'two_weeks' ? 'selected' : '' }}>{{$words['two_week']->translate(app()->getLocale())->title}}</option>
                                    </select>
                                </div>

                                <!-- Salary Field -->
                                <div>
                                    <label
                                        class="font-semibold">{{$words['salary']->translate(app()->getLocale())->title}}</label>
                                    <div class="block mt-2">
                                        <div>
                                            <label class="inline-flex items-center">
                                                <input type="radio"
                                                       class="form-radio border-gray-200 dark:border-gray-800 text-emerald-600 focus:border-emerald-300 focus:ring focus:ring-offset-0 focus:ring-emerald-200 focus:ring-opacity-50 me-2"
                                                       name="salary"
                                                       value="all" {{ request()->get('salary') == 'all' ? 'checked' : '' }}>
                                                <span
                                                    class="text-slate-400">{{$words['all']->translate(app()->getLocale())->title}}</span>
                                            </label>
                                        </div>
                                        <div>
                                            <label class="inline-flex items-center">
                                                <input type="radio"
                                                       class="form-radio border-gray-200 dark:border-gray-800 text-emerald-600 focus:border-emerald-300 focus:ring focus:ring-offset-0 focus:ring-emerald-200 focus:ring-opacity-50 me-2"
                                                       name="salary"
                                                       value="1" {{ request()->get('salary') == '1' ? 'checked' : '' }}>
                                                <span class="text-slate-400">500 - 1000</span>
                                            </label>
                                        </div>
                                        <div>
                                            <label class="inline-flex items-center">
                                                <input type="radio"
                                                       class="form-radio border-gray-200 dark:border-gray-800 text-emerald-600 focus:border-emerald-300 focus:ring focus:ring-offset-0 focus:ring-emerald-200 focus:ring-opacity-50 me-2"
                                                       name="salary"
                                                       value="2" {{ request()->get('salary') == '2' ? 'checked' : '' }}>
                                                <span class="text-slate-400">1000 - 2000</span>
                                            </label>
                                        </div>
                                        <div>
                                            <label class="inline-flex items-center">
                                                <input type="radio"
                                                       class="form-radio border-gray-200 dark:border-gray-800 text-emerald-600 focus:border-emerald-300 focus:ring focus:ring-offset-0 focus:ring-emerald-200 focus:ring-opacity-50 me-2"
                                                       name="salary"
                                                       value="3" {{ request()->get('salary') == '3' ? 'checked' : '' }}>
                                                <span class="text-slate-400">2000 - 5000</span>
                                            </label>
                                        </div>
                                        <div>
                                            <label class="inline-flex items-center">
                                                <input type="radio"
                                                       class="form-radio border-gray-200 dark:border-gray-800 text-emerald-600 focus:border-emerald-300 focus:ring focus:ring-offset-0 focus:ring-emerald-200 focus:ring-opacity-50 me-2"
                                                       name="salary"
                                                       value="5" {{ request()->get('salary') == '5' ? 'checked' : '' }}>
                                                <span class="text-slate-400">5000+</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div>
                                    {{--                                    <input type="submit"--}}
                                    {{--                                           class="btn bg-emerald-600 hover:bg-emerald-700 border-emerald-600 hover:border-emerald-700 text-white rounded-md w-full"--}}
                                    {{--                                           value="{{$words['search']->translate(app()->getLocale())->title}}">--}}
                                    <button type="submit"
                                            class="btn bg-emerald-600 hover:bg-emerald-700 border-emerald-600 hover:border-emerald-700 text-white rounded-md w-full">
                                        <h2>{{$words['search']->translate(app()->getLocale())->title}}</h2></button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div><!--end col-->

                <div class="lg:col-span-8 md:col-span-6">
                    <h1 class="text-3xl font-bold text-gray-600">Vakansiyalar</h1>
                    <br>
                    <div class="grid grid-cols-1 gap-[10px]">
                        <div
                            class="block group relative overflow-hidden lg:flex justify-between items-center rounded shadow hover:shadow-md dark:shadow-gray-700 p-2 no-underline">
                            <a href="https://t.me/easyjobaz" target="_blank">
                                <img src="{{asset('/')}}front/banner1.jpg" alt="">
                            </a>
                        </div>
                        <br>
                        @foreach($vacancies as $vacancy)
                            <div
                                class="block group relative overflow-hidden lg:flex justify-between items-center rounded shadow hover:shadow-md dark:shadow-gray-700 p-2 no-underline">

                                {{-- Sol hissə: Logo + Vakansiya adı --}}
                                <a href="{{ route('dynamic.page', $vacancy->slug) }}"
                                   class="flex items-center min_height">
                                    <div
                                        class="size-14 flex items-center justify-center bg-white dark:bg-slate-900 shadow dark:shadow-gray-700 rounded-md">
                                        @if($vacancy->company && $vacancy->company->image)
                                            <img src="{{ asset('storage/' . $vacancy->company->image) }}" class="size-8"
                                                 alt="{{ $vacancy->vacancy_name }}">
                                        @else
                                            <span
                                                class="text-lg md:text-4xl font-bold flex items-center justify-center h-full w-full">
                    {{ strtoupper(substr($vacancy->company_name, 0, 1)) }}
                </span>
                                        @endif
                                    </div>

                                    <div>
                                        <h3 class="text-sm md:text-lg hover:text-emerald-600 font-semibold transition-all duration-500 ms-3 min-w-[150px] for_max_width">
                                            {{ $vacancy->vacancy_name }}
                                        </h3>
                                        <span class="block text-slate-400 text-xs md:text-sm mt-0 new_class">
                @if($vacancy->company)
                                                {{ $vacancy->company?->title }}
                                            @else
                                                {{ $vacancy->company_name }}
                                            @endif
            </span>
                                    </div>
                                </a>

                                {{-- Sağ hissə --}}
                                <div
                                    class="flex flex-wrap justify-between items-center w-full lg:w-auto for_vacancy mt-2 md:mt-0 gap-y-1">

                                    {{-- Premium / New --}}
                                    <div class="lg:block mr-2">
                                        @if($vacancy->is_premium)
                                            <span class="block for_premium">
                    <span class="bg-emerald-600/10 inline-block text-emerald-600 text-xs pt-2 px-2.5 py-0.5 font-semibold">
                        {{ $words['premium']->translate(app()->getLocale())->title }}
                    </span>
                </span>
                                        @elseif($vacancy->is_new)
                                            <span class="block for_premium">
                    <span class="bg-emerald-600/10 inline-block text-emerald-600 text-xs pt-2 px-2.5 py-0.5 font-semibold new_vacancy">
                        {{ $words['new']->translate(app()->getLocale())->title }}
                    </span>
                </span>
                                        @endif
                                    </div>

                                    {{-- Tarix --}}
                                    <span class="block text-slate-400 text-xs md:text-sm mt-0 mr-3">
            <i class="uil uil-clock"></i> {{ $vacancy->published_at->format('d.m') }}
        </span>

                                    {{-- Baxış sayı (mobil və masaüstü üçün eyni görünüş) --}}
                                    <span class="flex items-center text-slate-400 text-xs md:text-sm mt-0 mr-3">
            <i class="uil uil-eye mr-1"></i> {{ $vacancy->views_count }}
        </span>

                                    {{-- Bookmark button --}}
                                    <div class="ml-auto md:ml-4">
                                        <button data-id="{{ $vacancy->id }}"
                                                class="btn btn-icon btn-bookmark rounded-full bg-emerald-600/5 hover:bg-emerald-600 border-emerald-600/10 hover:border-emerald-600 text-emerald-600 hover:text-white md:relative absolute top-0 end-0 md:m-0 m-3 bookmark-btn">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                 stroke-linecap="round" stroke-linejoin="round"
                                                 class="feather feather-bookmark size-4">
                                                <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>


                        @if($loop->iteration === 10)
                                <div
                                    class="block group relative overflow-hidden lg:flex justify-between items-center rounded shadow hover:shadow-md dark:shadow-gray-700 p-2 no-underline">
                                    <a href="https://whatsapp.com/channel/0029Vb4aJJz4o7qGhrG9Y03Y" target="_blank">
                                        <img src="{{ asset('/') }}front/vp.jpg" alt="Telegram Banner">
                                    </a>
                                </div>
                            @endif
                        @endforeach

                    </div>

                    <div class="grid md:grid-cols-12 grid-cols-1 mt-8">
                        @if ($vacancies->lastPage() > 1)
                            <div class="md:col-span-12 text-center">
                                <nav aria-label="Page navigation example">
                                    <ul class="inline-flex items-center -space-x-px">
                                        @if ($vacancies->onFirstPage())
                                            <li>
                                <span
                                    class="size-[30px] md:size-[40px] inline-flex justify-center items-center text-slate-400 bg-white dark:bg-slate-900 rounded-s-3xl border border-gray-100 dark:border-gray-800 cursor-not-allowed">
                                    <i class="uil uil-angle-left text-[16px] md:text-[20px] rtl:rotate-180 rtl:-mt-1"></i>
                                </span>
                                            </li>
                                        @else
                                            <li>
                                                <a href="{{ $vacancies->previousPageUrl() }}"
                                                   class="size-[30px] md:size-[40px] inline-flex justify-center items-center text-slate-400 bg-white dark:bg-slate-900 rounded-s-3xl border border-gray-100 dark:border-gray-800 hover:text-white hover:border-emerald-600 hover:bg-emerald-600 dark:hover:border-emerald-600">
                                                    <i class="uil uil-angle-left text-[16px] md:text-[20px] rtl:rotate-180 rtl:-mt-1"></i>
                                                </a>
                                            </li>
                                        @endif

                                        @foreach ($vacancies->getUrlRange(1, $vacancies->lastPage()) as $page => $url)
                                            <li>
                                                @if ($page == $vacancies->currentPage())
                                                    <span
                                                        class="z-10 size-[30px] md:size-[40px] inline-flex justify-center items-center text-white bg-emerald-600 border border-emerald-600">{{ $page }}</span>
                                                @else
                                                    <a href="{{ $url }}"
                                                       class="size-[30px] md:size-[40px] inline-flex justify-center items-center text-slate-400 bg-white dark:bg-slate-900 border border-gray-100 dark:border-gray-800 hover:text-white hover:border-emerald-600 hover:bg-emerald-600 dark:hover:border-emerald-600">{{ $page }}</a>
                                                @endif
                                            </li>
                                        @endforeach

                                        @if ($vacancies->hasMorePages())
                                            <li>
                                                <a href="{{ $vacancies->nextPageUrl() }}"
                                                   class="size-[30px] md:size-[40px] inline-flex justify-center items-center text-slate-400 bg-white dark:bg-slate-900 rounded-e-3xl border border-gray-100 dark:border-gray-800 hover:text-white hover:border-emerald-600 hover:bg-emerald-600 dark:hover:border-emerald-600">
                                                    <i class="uil uil-angle-right text-[16px] md:text-[20px] rtl:rotate-180 rtl:-mt-1"></i>
                                                </a>
                                            </li>
                                        @else
                                            <li>
                                <span
                                    class="size-[30px] md:size-[40px] inline-flex justify-center items-center text-slate-400 bg-white dark:bg-slate-900 rounded-e-3xl border border-gray-100 dark:border-gray-800 cursor-not-allowed">
                                    <i class="uil uil-angle-right text-[16px] md:text-[20px] rtl:rotate-180 rtl:-mt-1"></i>
                                </span>
                                            </li>
                                        @endif
                                    </ul>
                                </nav>
                            </div>
                        @endif
                    </div>
                    <div class="grid md:grid-cols-1 mt-8 gap-[30px]">
                        <div
                            class="group rounded-lg shadow hover:shadow-lg dark:shadow-gray-700 transition-all duration-500 w-full">
                            <div class="flex items-center justify-between p-1">
                                <div class="flex items-center w-full">
                                    <a href="https://t.me/easyjobaz"
                                       class="block text-[16px] font-semibold hover:text-emerald-600 transition-all duration-500">
                                        <img src="{{asset('/')}}front/banner.jpg" alt="">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!--end content-->
                    </div>


                </div>
                <!--end col-->
            </div><!--end grid-->
            <div class="grid md:grid-cols-1 mt-8 gap-[30px]">
                <div class="max-w-2xl mx-auto p-4 text-center">
                    <h2 class="text-xl font-bold mb-2">{{$words['text1']->translate(app()->getLocale())->title}}</h2>
                    <p class="text-gray-700 mb-4">{{$words['description1']->translate(app()->getLocale())->title}}</p>

                    <h2 class="text-xl font-bold mb-2">{{$words['text2']->translate(app()->getLocale())->title}}</h2>
                    <p class="text-gray-700 mb-4">{{$words['description2']->translate(app()->getLocale())->title}}</p>

                    <h2 class="text-xl font-bold mb-2">{{$words['text3']->translate(app()->getLocale())->title}}</h2>
                    <p class="text-gray-700 mb-4">{{$words['description3']->translate(app()->getLocale())->title}}</p>

                    <h2 class="text-xl font-bold mb-2">{{$words['text4']->translate(app()->getLocale())->title}}</h2>
                    <p class="text-gray-700 mb-4">{{$words['description4']->translate(app()->getLocale())->title}}</p>

                    <h2 class="text-xl font-bold mb-2">{{$words['text5']->translate(app()->getLocale())->title}}</h2>
                    <p class="text-gray-700 mb-4">{{$words['description5']->translate(app()->getLocale())->title}}</p>
                </div>


            </div>
        </div><!--end container-->


    </section>

@endsection
<script>
    document.addEventListener('DOMContentLoaded', function () {

        // Function to toggle bookmark status
        function toggleBookmark(vacancyId) {
            const bookmarkedVacancies = JSON.parse(localStorage.getItem('bookmarkedVacancies') || '[]');

            if (bookmarkedVacancies.includes(vacancyId)) {
                // Remove from bookmarks
                const index = bookmarkedVacancies.indexOf(vacancyId);
                if (index > -1) {
                    bookmarkedVacancies.splice(index, 1);
                }
            } else {
                // Add to bookmarks
                bookmarkedVacancies.push(vacancyId);
            }

            localStorage.setItem('bookmarkedVacancies', JSON.stringify(bookmarkedVacancies));
            updateBookmarkIcons();
            updateBookmarkCount();
        }

        // Function to update the bookmark icons based on local storage
        function updateBookmarkIcons() {
            const bookmarkedVacancies = JSON.parse(localStorage.getItem('bookmarkedVacancies') || '[]');

            document.querySelectorAll('.btn-bookmark').forEach(button => {
                const vacancyId = button.getAttribute('data-id');
                // const icon = button.querySelector('i');
                if (bookmarkedVacancies.includes(Number(vacancyId))) {
                    // button.classList.add('text-emerald-600');
                    button.classList.add('for_active');
                } else {

                    button.classList.remove('for_active');
                    // button.classList.remove('text-emerald-600');
                }
            });
        }

        // Function to update the bookmark count display
        function updateBookmarkCount() {
            const bookmarkedVacancies = JSON.parse(localStorage.getItem('bookmarkedVacancies') || '[]');
            const count = bookmarkedVacancies.length;
            const countDisplay = document.querySelector('#bookmark-count');

            if (countDisplay) {
                countDisplay.textContent = `${count}`;
            } else {
                console.error('Bookmark count display element not found.');
            }
        }

        // Attach event listeners to all bookmark buttons
        document.querySelectorAll('.btn-bookmark').forEach(button => {
            button.addEventListener('click', function () {
                const vacancyId = this.getAttribute('data-id');
                toggleBookmark(Number(vacancyId));
            });
        });

        // Initial update of bookmark icons and count based on local storage
        updateBookmarkIcons();
        updateBookmarkCount();
    });

</script>

