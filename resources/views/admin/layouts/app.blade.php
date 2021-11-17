<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>ATR - Alpha Training & Recognition</title>

        {{-- Style Sheets --}}
        @include('admin.layouts.styles')

    </head>
    <body>
        <div id="wrapper">
            {{-- Navbar --}}
            @include('admin.components.navbar')
            <div id="page-wrapper" class="gray-bg dashbard-1">
                @include('admin.components.header')

                @include('admin.components.breadcrumbs')

                @yield('content')

            </div>
        </div>

        @include('admin.layouts.scripts')
    </body>
</html>
