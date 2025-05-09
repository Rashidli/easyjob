@foreach($vacancies as $vacancy)
    <div class="group relative overflow-hidden lg:flex justify-between items-center rounded shadow hover:shadow-md dark:shadow-gray-700 transition-all duration-500 p-2">
        <div class="flex items-center">
            <div class="size-14 flex items-center justify-center bg-white dark:bg-slate-900 shadow dark:shadow-gray-700 rounded-md">
                <img src="{{ asset('storage/' . $vacancy->company?->image) }}" class="size-8" alt="{{ $vacancy->vacancy_name }}">
            </div>
            <div>
                <a href="{{ route('dynamic.page', $vacancy->slug) }}" class="text-lg hover:text-emerald-600 font-semibold transition-all duration-500 ms-3 min-w-[150px]">
                    {{ $vacancy->vacancy_name }}
                </a>
                <span class="block text-slate-400 text-sm md:mt-1 mt-0">
                        {{ $vacancy->company?->title }}
                    </span>
            </div>
        </div>
        <div class="flex justify-between">
            <div class="lg:block flex justify-between lg:mt-0 mt-4">
                @if($vacancy->is_premium)
                    <span class="block for_premium">
                            <span class="bg-emerald-600/10 inline-block text-emerald-600 text-xs px-2.5 py-0.5 font-semibold">
                                Premium
                            </span>
                        </span>
                @elseif($vacancy->updated_at->gt(now()->subDays(10)))
                    <span class="block for_premium">
                            <span class="bg-emerald-600/10 inline-block text-emerald-600 text-xs px-2.5 py-0.5 font-semibold new_vacancy">
                                Yeni
                            </span>
                        </span>
                @endif
                <span class="block text-slate-400 text-sm md:mt-1 mt-0">
                        <i class="uil uil-clock"></i> {{ $vacancy->updated_at->translatedFormat('d.m') }}
                    </span>
            </div>
            <div class="lg:mt-0 mt-4 flex items-center">
                <span class="text-slate-400"><i class="uil uil-eye"></i> {{ $vacancy->views_count }}</span>
            </div>
            <div class="lg:mt-0 mt-4">
                <button data-id="{{ $vacancy->id }}" class="btn btn-icon btn-bookmark rounded-full bg-emerald-600/5 hover:bg-emerald-600 border-emerald-600/10 hover:border-emerald-600 text-emerald-600 hover:text-white md:relative absolute top-0 end-0 md:m-0 m-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bookmark size-4">
                        <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>
@endforeach
