<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="author" content="Shreethemes">
<meta name="website" content="https://easyjob.az">
<meta name="version" content="1.5.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<!-- favicon -->
<link rel="shortcut icon" href="{{asset('storage/' . $favicon->image)}}">

<!-- Css -->
<link href="{{asset('/')}}front/libs/choices.js/public/assets/styles/choices.min.css" rel="stylesheet">
<!-- Main Css -->
<link href="{{asset('/')}}front/libs/@iconscout/unicons/css/line.css" type="text/css" rel="stylesheet">
<link href="{{asset('/')}}front/libs/@mdi/font/css/materialdesignicons.min.css" rel="stylesheet" type="text/css">
<link href="{{asset('/')}}front/css/tailwind.css?v={{time()}}" rel="stylesheet" type="text/css">
@foreach($tags as $tag)
    {!! $tag->description !!}
@endforeach
