<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<div class="lg:col-span-4 md:col-span-5">
    <div class="bg-white dark:bg-gray-800 rounded-md shadow-lg p-6 sticky top-20 mt-8">

        <!-- Logo Section -->
        <div class="text-center mb-8">
            <!-- Logo Section -->
            <div
                class="relative inline-block rounded-full overflow-hidden w-28 h-28 border-4 border-emerald-600"
                style="width: 112px">

                @if($company->image)
                    <!-- Display the logo if it exists -->
                    <img src="{{ asset('storage/'.$company->image) }}" alt="Company Logo"
                         class="object-cover w-full h-full">
                @else
                    <!-- Default Icon (Circular) -->
                    <div
                        class="bg-gray-200 flex items-center justify-center w-full h-full rounded-full">
                        <img src="{{asset('/')}}front/share.png" alt="logo" title="logo">
                    </div>
                @endif

                <!-- Image Upload Overlay -->
                <label for="logo-upload"
                       class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 hover:bg-opacity-75 text-white cursor-pointer">
{{--                    <i class="fas fa-upload text-lg"></i>--}}
                </label>
                <form id="upload-form" action="{{ route('company.upload.logo', $company->id) }}"
                      method="POST" enctype="multipart/form-data" class="hidden">
                    @csrf
                    <input type="file" id="logo-upload" name="logo" class="hidden"
                           onchange="document.getElementById('upload-form').submit();">
                </form>
            </div>

            <!-- Company Title -->
            <p class="mt-4 text-lg font-semibold text-gray-800 dark:text-white">{{ $company->title }}</p>

        </div>

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-5 space-y-4">
            <!-- Şirkət haqqında -->
            <li>
                <a href="{{ route('company.dashboard') }}"
                   class="flex items-center space-x-3 py-3 px-5 text-gray-700 dark:text-gray-300 hover:text-emerald-600 dark:hover:text-emerald-400 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-all">
                    <i class="fas fa-info-circle text-2xl text-emerald-500"></i>
                    <span class="font-semibold">Şirkət haqqında</span>
                </a>
                <hr class="border-gray-200 dark:border-gray-700 mt-3">
            </li>

            <!-- Vakansiyalar -->
            <li x-data="{ open: window.location.pathname.includes('vacancy') }">
                <button @click="open = !open"
                        class="flex items-center justify-between w-full py-3 px-5 text-gray-700 dark:text-gray-300 hover:text-emerald-600 dark:hover:text-emerald-400 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-all">
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-plus-circle text-2xl text-emerald-500"></i>
                        <span class="font-semibold">Vakansiyalar</span>
                    </div>
                    <i class="fas fa-chevron-down text-gray-500 dark:text-gray-400 transition-transform"
                       :class="open ? 'rotate-180' : ''"></i>
                </button>

                <!-- Dropdown -->
                <ul x-show="open" x-collapse
                    class="mt-2 w-full bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg shadow-md overflow-hidden">
                    <li>
                        <a href="{{ route('newVacancy') }}"
                           class="block px-4 py-2 text-black dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600 hover:text-emerald-600 dark:hover:text-emerald-400 transition-all">
                            Yeni Vakansiya yarat
                        </a>
                        <hr class="border-gray-300 dark:border-gray-600">
                    </li>
                    <li>
                        <a href="{{ route('vacancyList') }}"
                           class="block px-4 py-2 text-black dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600 hover:text-emerald-600 dark:hover:text-emerald-400 transition-all">
                            Dərc edilən vakansiyalar
                        </a>
                        <hr class="border-gray-300 dark:border-gray-600">
                    </li>
                    <li>
                        <a href="{{ route('vacancyPending') }}"
                           class="block px-4 py-2 text-black dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600 hover:text-emerald-600 dark:hover:text-emerald-400 transition-all">
                            Gözləyən vakansiyalar
                        </a>
                        <hr class="border-gray-300 dark:border-gray-600">
                    </li>
                    <li>
                        <a href="{{ route('returnedVacancy') }}"
                           class="block px-4 py-2 text-black dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600 hover:text-emerald-600 dark:hover:text-emerald-400 transition-all">
                            Geri qaytarılan vakansiyalar
                        </a>
                    </li>
                </ul>

                <hr class="border-gray-200 dark:border-gray-700 mt-3">
            </li>

            <!-- Bildirişlər -->
            <li>
                <a href="{{ route('notices') }}"
                   class="flex items-center space-x-3 py-3 px-5 text-gray-700 dark:text-gray-300 hover:text-emerald-600 dark:hover:text-emerald-400 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-all">
                    <i class="fas fa-bell text-2xl text-emerald-500"></i>
                    <span class="font-semibold">
                Bildirişlər ({{ auth()->guard('company')->user()->notices()->where('is_read', false)->count() }})
            </span>
                </a>
                <hr class="border-gray-200 dark:border-gray-700 mt-3">
            </li>

            <!-- Çıxış -->
            <li>
                <a href="{{ route('company_logout') }}"
                   class="flex items-center space-x-3 py-3 px-5 text-gray-700 dark:text-gray-300 hover:text-emerald-600 dark:hover:text-emerald-400 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-all">
                    <i class="fas fa-sign-out-alt text-2xl text-emerald-500"></i>
                    <span class="font-semibold">Çıxış</span>
                </a>
            </li>
        </ul>



    </div>
</div><!--end col-->
