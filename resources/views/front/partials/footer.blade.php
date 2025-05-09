<!-- Start Footer -->
<footer class="relative bg-slate-900 dark:bg-slate-800">
    <div class="container">
        <div class="grid grid-cols-1">
            <div class="relative py-12">
                <!-- Subscribe -->
                <div class="relative w-full">
                    <div class="grid md:grid-cols-12 grid-cols-1 gap-[30px]">
                        <div class="md:col-span-3">
                            <a href="{{route('welcome')}}" class="flex justify-center md:justify-start focus:outline-none footer_logo">
                                <img src="{{asset('storage/' . $logo->image)}}" class="" alt="logo" title="logo">
                            </a>
                        </div><!--end col-->

                        <div class="md:col-span-9">
                            <ul class="list-disc footer-list md:text-end text-center space-x-3">

                                <li class="inline-block mt-[10px] md:mt-0"><a href="{{route('dynamic.page', $blog_page->slug)}}"
                                                                              class="text-gray-300 hover:text-gray-400 duration-500 ease-in-out font-medium">{{$blog_page->title}}</a></li>
                                <li class="inline-block mt-[10px] md:mt-0"><a href="{{route('dynamic.page',$post_vacancy->slug)}}"
                                                                              class="text-gray-300 hover:text-gray-400 duration-500 ease-in-out font-medium">{{$post_vacancy->title}}</a></li>
                                <li class="inline-block mt-[10px] md:mt-0"><a href="{{route('dynamic.page',$about_page->slug)}}"
                                                                              class="text-gray-300 hover:text-gray-400 duration-500 ease-in-out font-medium">{{$about_page->title}}</a></li>
                                <li class="inline-block mt-[10px] md:mt-0"><a href="{{route('dynamic.page',$contact->slug)}}"
                                                                              class="text-gray-300 hover:text-gray-400 duration-500 ease-in-out font-medium">{{$contact->title}}</a></li>
                            </ul><!--end icon-->
                        </div><!--end col-->
                    </div><!--end grid-->
                </div>
                <!-- Subscribe -->
            </div>
        </div>
    </div><!--end container-->

    <div class="py-[30px] px-0 border-t border-gray-800 dark:border-gray-700">
        <div class="container text-center">
            <div class="grid md:grid-cols-2 items-center gap-6">
                <div class="md:text-start text-center">
                    <p class="mb-0 text-gray-300 font-medium">
                        <script>document.write(new Date().getFullYear())</script>
                        EasyJob © Bütün hüquqlar qorunur.
                    </p>
                </div>
                <ul class="list-none md:text-end text-center space-x-0.5">
                    @foreach($socials as $social)
                        <li class="inline"><a href="{{$social->link}}" target="_blank"
                                              class="btn btn-icon btn-sm border-2 border-gray-800 dark:border-gray-700 rounded-md hover:border-emerald-600 dark:hover:border-emerald-600 hover:bg-emerald-600 dark:hover:bg-emerald-600 text-white"><i
                                    class="{{$social->image}}" title="{{$social->title}}" alt="{{$social->title}}"></i></a></li>
                    @endforeach
                </ul><!--end icon-->
            </div><!--end grid-->
        </div><!--end container-->
    </div>
</footer><!--end footer-->
<!-- End Footer -->
<!-- Switcher -->
<div class="fixed top-1/4 -left-2 z-50 for_mobile">
            <span class="relative inline-block rotate-90">
                <input type="checkbox" class="checkbox opacity-0 absolute" id="chk">
                <label
                    class="label bg-slate-900 dark:bg-white shadow dark:shadow-gray-800 cursor-pointer rounded-full flex justify-between items-center p-1 w-14 h-8"
                    for="chk">
                    <i class="uil uil-moon text-[20px] text-yellow-500"></i>
                    <i class="uil uil-sun text-[20px] text-yellow-500"></i>
                    <span
                        class="ball bg-white dark:bg-slate-900 rounded-full absolute top-[2px] left-[2px] size-7"></span>
                </label>
            </span>
</div>


<!-- Back to top -->
<a href="#" onclick="topFunction()" id="back-to-top"
   class="back-to-top fixed hidden text-lg rounded-full z-10 bottom-5 end-5 size-9 text-center bg-emerald-600 text-white justify-center items-center"><i
        class="uil uil-arrow-up"></i></a>
<!-- Back to top -->

<!-- JAVASCRIPTS -->
<script src="{{asset('/')}}front/libs/choices.js/public/assets/scripts/choices.min.js"></script>
<script src="{{asset('/')}}front/libs/feather-icons/feather.min.js"></script>
<script src="{{asset('/')}}front/js/plugins.init.js"></script>
<script src="{{asset('/')}}front/js/app.js"></script>
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<!-- JAVASCRIPTS -->

