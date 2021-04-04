<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('icons/icon_57.png') }}">
        <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('icons/icon_60.png') }}">
        <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('icons/icon_72.png') }}">
        <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('icons/icon_76.png') }}">
        <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('icons/icon_114.png') }}">
        <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('icons/icon_120.png') }}">
        <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('icons/icon_144.png') }}">
        <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('icons/icon_152.png') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('icons/icon_180.png') }}">
        <link rel="icon" type="image/png" href="{{ asset('icons/icon_32.png') }}" sizes="32x32">
        <link rel="icon" type="image/png" href="{{ asset('icons/icon_192.png') }}" sizes="192x192">
        <link rel="icon" type="image/png" href="{{ asset('icons/icon_96.png') }}" sizes="96x96">
        <link rel="icon" type="image/png" href="{{ asset('icons/icon_16.png') }}" sizes="16x16">
        <link rel="manifest" href="{{ asset('manifest.json') }}">
        <meta name="msapplication-TileColor" content="#6366F1">
        <meta name="msapplication-TileImage" content="{{ asset('icons/icon_144.png') }}">
        <meta name="theme-color" content="#6366F1">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        
        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        <!-- Scripts -->
        @routes
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        @inertia
    </body>
</html>
