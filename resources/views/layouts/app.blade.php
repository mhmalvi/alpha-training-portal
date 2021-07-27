<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta name="google-site-verification" content="3idDLDHSyct6XokaWytdxoXgyOUS5uPDzOYkOyliv4s" />
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title') - ATR</title>
        <link rel="canonical" href="{{ URL::current() }}" />

        <meta name="robots" content="follow, index, max-snippet:-1, max-video-preview:-1, max-image-preview:large" />
        <meta name="title" content="@yield('title') - ATR" />

        @stack('seo')

        {{-- Open Graph --}}
        <meta property="og:title" content="@yield('title') - ATR">
        <meta property="og:site_name" content="Alpha Training & Recognition - ATR">
        <meta property="og:locale" content="en_US">
        <meta property="og:type" content="article">
        <meta property="og:url" content="{{ URL::current() }}">
        @stack('og')
        {{-- Open Graph --}}

        <meta name="ahrefs-site-verification" content="c6df018699d9864e4f9c1521bf9ee15e4f9385ca41191ae25fe13bc86a28c0ec">

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        @include('layouts.styles')

        @livewireStyles

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.3/dist/alpine.js" defer></script>
    </head>
    <body>

        <div class="wrapper">
            @auth
                <div class="bg-light" style="display: flex; justify-content: center;">
                    <a href="{{route('admin.home')}}"><i class="fa fa-pencil-square"></i> Back to dashboard!</a>
                </div>
            @endauth

            @include('components.header')

            @include('components.nav')

            @yield('content')

            @include('components.footer')
        </div>

        @livewireScripts
        @include('layouts.scripts')
    </body>
</html>
