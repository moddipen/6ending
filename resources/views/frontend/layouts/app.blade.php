<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('img/favicon.png')}}">
    <link rel="icon" type="image/png" href="{{asset('img/favicon.png')}}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>@yield('title') | {{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="{{ setting('meta_description') }}">
    <meta name="keyword" content="{{ setting('meta_keyword') }}">

    @include('frontend.includes.meta')

    <!-- Shortcut Icon -->
    <link rel="shortcut icon" href="{{asset('img/favicon.png')}}">
    <link rel="icon" type="image/ico" href="{{asset('img/favicon.png')}}" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @stack('before-styles')

    <link rel="stylesheet" href="{{'css/bootstrap.min.css'}}">
    <link rel="stylesheet" href="{{'css/bootstrap-theme.min.css'}}">
    <link rel="stylesheet" href="{{'css/fontAwesome.css'}}">
    <link rel="stylesheet" href="{{'css/hero-slider.css'}}">
    <link rel="stylesheet" href="{{'css/tooplate-style.css'}}">

    @stack('after-styles')

    <x-google-analytics />
</head>

<body>

    @include('frontend.includes.header')

  <!--   <x-preloader />
  -->
    <main>
        @yield('content')
    </main>

    @include('frontend.includes.footer')

</body>

<!-- Scripts -->
@stack('before-scripts')
<script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>  
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>
    <script src="js/vendor/bootstrap.min.js"></script>

    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>

    <!-- <script src="{{ mix('js/frontend.js') }}"></script> -->

    @stack('after-scripts')

    </html>