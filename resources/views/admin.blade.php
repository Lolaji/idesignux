<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Favicon -->
        <link rel="icon" type="image/x-icon" href="/images/short-icon-blue.ico">
        {{-- <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png"> --}}
        <link rel="icon" type="image/png" sizes="32x32" href="/logo/short-icon-blue.png">
        {{-- <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png"> --}}
        {{-- <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#7492c8"> --}}

        <title>{{ config('app.name', 'iDesignUX') }}</title>

        <!-- Fonts -->
        {{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap"> --}}


        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/admin.css') }}">

        @if (request()->path() == 'backoffice/login')
            <link rel="stylesheet" href="/css/single.css">
        @endif

        <!-- Scripts -->
        @routes
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="app sidebar-mini">
        @inertia
    </body>
</html>