@extends('front.layouts.master')

@section('title', $favorite_page->seo_title)
@section('description', $favorite_page->seo_description)
@section('keywords', $favorite_page->seo_keywords)

@section('az_slug',$favorite_page->seo_title)
@section('en_slug',$favorite_page->seo_description)
@section('ru_slug',$favorite_page->seo_keywords)

@section('content')

    <section class="relative md:py-24 py-16 section">
        <div class="container">
            <div class="grid md:grid-cols-12 grid-cols-1 gap-[30px]">

                <div class="lg:col-span-8 md:col-span-6">
                    <div class="grid grid-cols-1 gap-[10px]" id="favorite-vacancies-container">

                    </div>
                </div><!--end col-->
            </div><!--end grid-->
        </div><!--end container-->
    </section>

@endsection
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const bookmarkedVacancies = JSON.parse(localStorage.getItem('bookmarkedVacancies') || '[]');

        // Function to render the vacancies on the page
        function renderVacancies(vacancies) {
            const container = document.getElementById('favorite-vacancies-container');
            container.innerHTML = ''; // Clear the container

            if (vacancies.length === 0) {
                container.innerHTML = '<p>No bookmarked vacancies.</p>';
                return;
            }

            vacancies.forEach(vacancy => {
                const updatedDate = new Intl.DateTimeFormat('en-GB', { day: '2-digit', month: '2-digit' }).format(new Date(vacancy.updated_at));

                // Premium və Yeni təsdiqini buradan alırıq
                const isPremium = vacancy.is_premium ? `
        <span class="block for_premium">
            <span class="bg-emerald-600/10 inline-block text-emerald-600 text-xs px-2.5 py-0.5 font-semibold">Premium</span>
        </span>
    ` : '';

                const isNew = vacancy.is_new ? `
        <span class="block for_premium">
            <span class="bg-emerald-600/10 inline-block text-emerald-600 text-xs px-2.5 py-0.5 font-semibold new_vacancy">Yeni</span>
        </span>
    ` : '';

                const vacancyHtml = `
        <div class="block group relative overflow-hidden lg:flex justify-between items-center rounded shadow hover:shadow-md dark:shadow-gray-700 p-2 no-underline">
            <a href="${vacancy.slug}" class="flex items-center min_height">
                <div class="size-14 flex items-center justify-center bg-white dark:bg-slate-900 shadow dark:shadow-gray-700 rounded-md">
                    ${vacancy.company && vacancy.company.image ? `
                        <img src="/storage/${vacancy.company.image}" class="size-8" alt="${vacancy.vacancy_name}">
                    ` : `
                        <span class="text-lg md:text-4xl font-bold flex items-center justify-center h-full w-full">
                            ${vacancy.company_name.charAt(0).toUpperCase()}
                        </span>
                    `}
                </div>
                <div>
                    <span class="text-sm md:text-lg hover:text-emerald-600 font-semibold transition-all duration-500 ms-3 min-w-[150px]">
                        ${vacancy.vacancy_name}
                    </span>
                    <span class="block text-slate-400 text-xs md:text-sm mt-0 new_class">
                        ${vacancy.company ? vacancy.company.title : vacancy.company_name}
                    </span>
                </div>
            </a>
            <div class="flex justify-between items-center w-full lg:w-auto for_vacancy mt-2 md:mt-0">
                <div class="hidden lg:block">
                    ${isPremium}
                    ${isNew}
                </div>
                <span class="block text-slate-400 text-xs md:text-sm mt-1 md:mt-0">
                    <i class="uil uil-clock"></i> ${updatedDate}
                </span>
                <div class="hidden md:flex items-center ml-4">
                    <span class="text-slate-400 text-xs md:text-sm"><i class="uil uil-eye"></i> ${vacancy.views_count || '0'}</span>
                </div>
                <div class="ml-2 md:ml-4">
                    <button data-id="${vacancy.id}" class="btn btn-icon btn-bookmark rounded-full bg-emerald-600/5 hover:bg-emerald-600 border-emerald-600/10 hover:border-emerald-600 text-emerald-600 hover:text-white md:relative absolute top-0 end-0 md:m-0 m-3 bookmark-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bookmark size-4">
                            <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    `;

                container.insertAdjacentHTML('beforeend', vacancyHtml);
            });

            setupBookmarkButtons();
            updateBookmarkIcons();
        }

        // Send an AJAX request to fetch the vacancies
        function fetchFavoriteVacancies() {
            if (bookmarkedVacancies.length === 0) {
                renderVacancies([]);
                return;
            }

            fetch(`{{ route('favorite.vacancies') }}?bookmarks=${bookmarkedVacancies.join(',')}`)
                .then(response => response.json())
                .then(data => {
                    if (data) {
                        renderVacancies(data);
                    } else {
                        console.error('Unexpected data format:', data);
                        renderVacancies([]);
                    }
                })
                .catch(error => {
                    console.error('Error fetching vacancies:', error);
                    renderVacancies([]);
                });
        }

        fetchFavoriteVacancies();

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
                if (bookmarkedVacancies.includes(Number(vacancyId))) {
                    button.classList.add('for_active');
                } else {
                    button.classList.remove('for_active');
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
        function setupBookmarkButtons() {
            document.getElementById('favorite-vacancies-container').addEventListener('click', function (event) {
                if (event.target.closest('.btn-bookmark')) {
                    const button = event.target.closest('.btn-bookmark');
                    const vacancyId = button.getAttribute('data-id');
                    toggleBookmark(Number(vacancyId));
                }
            });
        }

        // Initial update of bookmark icons and count based on local storage
        updateBookmarkIcons();
        updateBookmarkCount();
    });

</script>

