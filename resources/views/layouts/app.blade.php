<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'ATR') }}</title>

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
