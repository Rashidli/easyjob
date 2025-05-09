
<nav id="topnav" class="defaultscroll is-sticky">
    <div class="container">
        <!-- Logo container-->
        <a class="logo" href="{{route('welcome')}}">
            <div class="block sm:hidden">
                <img src="{{asset('storage/' . $logo->image)}}" class="h-10 inline-block dark:hidden for_logo_mobile" alt="logo" title="logo">
                <img src="{{asset('storage/' . $logo->image)}}" class="h-10 hidden dark:inline-block for_logo_mobile" alt="logo" title="logo">
            </div>
            <div class="sm:block hidden">
                        <span class="inline-block dark:hidden">
                            <img src="{{asset('storage/' . $logo->image)}}" class="h-[24px] l-dark" alt="logo" title="logo">
                            <img src="{{asset('storage/' . $logo->image)}}" class="h-[24px] l-light" alt="logo" title="logo">
                        </span>
                <img src="{{asset('storage/' . $logo->image)}}" class="h-[24px] hidden dark:inline-block" alt="logo" title="logo">
            </div>
        </a>
        <!-- End Logo container-->

        <!-- Start Mobile Toggle -->
        <div class="menu-extras">
            <div class="menu-item">
                <a class="navbar-toggle" id="isToggle" onclick="toggleMenu()">
                    <div class="lines">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </a>
            </div>
        </div>
        <!-- End Mobile Toggle -->

        <div id="navigation">
            <!-- Navigation Menu-->
            <ul class="navigation-menu justify-end nav-light">
                <li class="parent-menu-item">
                    <a href="{{route('welcome')}}">{{$words['adds']->translate(app()->getLocale())->title}}</a>
                </li>

                <li class="parent-parent-menu-item">
                    <a href="{{route('dynamic.page', $category_page->slug)}}"> {{$category_page->title}} </a>
                </li>

                <li class="parent-parent-menu-item">
                    <a href="{{route('dynamic.page', $company_page->slug)}}">{{$company_page->title}}</a>
                </li>

                @if(auth()->guard('company')->check())
                    <li class="parent-parent-menu-item">
                        <a href="{{ route('company.dashboard') }}">
                            <img src="{{asset('/')}}front/26.png" alt="user" title="user">
                        </a>
                    </li>
                @else
                    <li class="parent-parent-menu-item">
                        <a href="{{ route('company.login') }}">{{ $post_vacancy->title }}</a>
                    </li>
                @endif

            @if (count($locales = LaravelLocalization::getSupportedLocales()) > 1)
                    <li class="has-submenu parent-parent-menu-item">
                        <a href="javascript:void(0)">{{ strtoupper(App::getLocale()) }}</a><span class="menu-arrow"></span>
                        <ul class="submenu">
                            @foreach ($locales as $localeCode => $properties)
                                @if ($localeCode !== App::getLocale())
                                    <li>
                                        <a href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
                                           class="sub-menu-item">
                                            {{ strtoupper($localeCode) }}
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </li>
                @endif

                <li class="parent-parent-menu-item relative">
                    <a href="{{route('dynamic.page',$favorite_page->slug)}}" class="btn-icon relative inline-block" style="margin-top: 5px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bookmark size-4">
                            <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path>
                        </svg>
                        <span id="bookmark-count" class="absolute top-[-10px] right-[-10px] bg-emerald-600 text-white text-xs font-semibold rounded-full px-2 py-1">
            0
        </span>
                    </a>
                </li>

            </ul><!--end navigation menu-->
        </div><!--end navigation-->
    </div><!--end container-->
</nav><!--end header-->

<!-- Loader Start -->

<!-- Loader End -->
<div class="relative">
    <div
        class="shape absolute start-0 end-0 sm:-bottom-px -bottom-[2px] overflow-hidden z-1 text-white dark:text-slate-900">
        <svg class="w-full h-auto" viewBox="0 0 2880 48" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 48H1437.5H2880V0H2160C1442.5 52 720 0 720 0H0V48Z" fill="currentColor"></path>
        </svg>
    </div>
</div>
