<!DOCTYPE html>
<html lang="en" class="light scroll-smooth" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title>Easyjob</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="website" content="https://easyjob.az">
    <meta name="version" content="1.5.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- favicon -->
    <link rel="shortcut icon" href="{{asset('storage/' . $favicon->image)}}">

    <!-- Css -->
    <!-- Main Css -->
    <link href="{{asset('/')}}front/libs/@iconscout/unicons/css/line.css" type="text/css" rel="stylesheet">
    <link href="{{asset('/')}}front/libs/@mdi/font/css/materialdesignicons.min.css" rel="stylesheet" type="text/css">
    <link href="{{asset('/')}}front/css/tailwind.css" rel="stylesheet" type="text/css">

</head>

<body class="dark:bg-slate-900">
<!-- Loader Start -->
<!-- <div id="preloader">
    <div id="status">
        <div class="spinner">
            <div class="double-bounce1"></div>
            <div class="double-bounce2"></div>
        </div>
    </div>
</div> -->
<!-- Loader End -->
<!-- Start -->
<section class="relative h-screen flex items-center justify-center text-center bg-gray-50 dark:bg-slate-800">
    <div class="container relative">
        <div class="grid grid-cols-1">
            <div class="title-heading text-center my-auto">
                <div class="size-24 bg-emerald-600/5 text-emerald-600 rounded-full text-5xl flex align-middle justify-center items-center shadow-sm dark:shadow-gray-800 mx-auto">
                    <i class="uil uil-thumbs-up"></i>
                </div>
                <h1 class="mt-6 mb-8 md:text-5xl text-3xl font-bold">Təşəkkür edirik</h1>
                <p class="text-slate-400 max-w-xl mx-auto">Tezliklə sizinlə əlaqə saxlanılacaq.</p>

                <div class="mt-6">
                    <a href="{{route('welcome')}}" class="btn bg-emerald-600/5 hover:bg-emerald-600 border-emerald-600/10 hover:border-emerald-600 text-emerald-600 hover:text-white rounded-full">Əsas səhifə</a>
                </div>
            </div>
        </div><!--end grid-->
    </div><!--end container-->
</section><!--end section-->
<!-- End -->

<div class="fixed bottom-3 end-3">
    <a href="" class="back-button btn btn-icon bg-emerald-600 hover:bg-emerald-700 border-emerald-600 hover:border-emerald-700 text-white rounded-full"><i data-feather="arrow-left" class="size-4"></i></a>
</div>

<!-- Switcher -->
<div class="fixed top-1/4 -left-2 z-50">
            <span class="relative inline-block rotate-90">
                <input type="checkbox" class="checkbox opacity-0 absolute" id="chk">
                <label class="label bg-slate-900 dark:bg-white shadow dark:shadow-gray-800 cursor-pointer rounded-full flex justify-between items-center p-1 w-14 h-8" for="chk">
                    <i class="uil uil-moon text-[20px] text-yellow-500"></i>
                    <i class="uil uil-sun text-[20px] text-yellow-500"></i>
                    <span class="ball bg-white dark:bg-slate-900 rounded-full absolute top-[2px] left-[2px] size-7"></span>
                </label>
            </span>
</div>


<!-- JAVASCRIPTS -->
<script src="{{asset('/')}}front/libs/feather-icons/feather.min.js"></script>
<script src="{{asset('/')}}front/js/plugins.init.js"></script>
<script src="{{asset('/')}}front/js/app.js"></script>
<!-- JAVASCRIPTS -->
</body>
</html>
