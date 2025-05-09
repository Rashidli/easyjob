<!DOCTYPE html>
<html lang="{{app()->getLocale()}}" class="light scroll-smooth" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')">
    @if (!empty(Request::url()))
        <link rel="canonical" href="{{ Request::url() }}"/>
    @endif
    @include('front.partials.head')
    <link rel="alternate"
          href="{{url('/')}}/@yield('az_slug')"
          hreflang="az">
    <link rel="alternate"
          href="{{url('/')}}/@yield('en_slug')"
          hreflang="en">
    <link rel="alternate"
          href="{{url('/')}}/@yield('ru_slug')"
          hreflang="ru">
{{--    <meta property="og:image" content="{{asset('storage/' . $logo->image)}}">--}}
    <meta property="og:title" content="@yield('title')">
    <meta property="og:description" content="@yield('description')">
    <script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Organization",
  "name": "EasyJob",
  "alternateName": "Vakansiyalar.com",
  "url": "https://easyjob.az/",
  "logo": "https://easyjob.az/storage/5fd2de12-6717-43cd-b31b-5b1734720de7.svg",
  "contactPoint": {
    "@type": "ContactPoint",
    "telephone": "+994506761790",
    "contactType": "customer service",
    "areaServed": "AZ",
    "availableLanguage": ["en","Russian","Azerbaijani"]
  },
  "sameAs": [
    "https://www.facebook.com/easyjobaz",
    "https://www.instagram.com/easyjob.aze/",
    "https://www.linkedin.com/company/easyjobaz/",
    "https://easyjob.az/"
  ]
}



    </script>
    <script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "LocalBusiness",
  "name": "EasyJob",
  "image": "https://easyjob.az/storage/5fd2de12-6717-43cd-b31b-5b1734720de7.svg",
  "@id": "https://easyjob.az/#localbusiness",
  "url": "https://easyjob.az/",
  "telephone": "+994506761790",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "",
    "addressLocality": "Baku",
    "postalCode": "",
    "addressCountry": "AZ"
  },
  "geo": {
    "@type": "GeoCoordinates",
    "latitude": 40.40926169999999,
    "longitude": 49.8670924
  },
  "openingHoursSpecification": {
    "@type": "OpeningHoursSpecification",
    "dayOfWeek": [
      "Monday",
      "Tuesday",
      "Wednesday",
      "Thursday",
      "Friday",
      "Saturday",
      "Sunday"
    ],
    "opens": "00:00",
    "closes": "23:59"
  },
  "sameAs": [
    "https://www.facebook.com/easyjobaz",
    "https://www.instagram.com/easyjob.aze/",
    "https://www.linkedin.com/company/easyjobaz/",
    "https://easyjob.az/"
  ]
}

    </script>

    <script type="application/ld+json">
{
  "@context": "https://schema.org/",
  "@type": "BreadcrumbList",
  "itemListElement": [{
    "@type": "ListItem",
    "position": 1,
    "name": "@yield('title')",
    "item": "{{ url('/') }}"
  }]
}

    </script>


</head>
<body class="dark:bg-slate-900">

@include('front.partials.header')

@yield('content')

@include('front.partials.footer')

</body>
</html>
