<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Preload -->
    <link rel="preload" href="{{ asset_cdn('adminkit/static/css/app.css') }}" as="style"/>
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" as="style"/>
    <link rel="preload" href="{{ asset_cdn('adminkit/static/js/app.js') }}" as="script"/>
    <!-- Styles -->
    <link href="{{ asset_cdn('adminkit/static/css/app.css') }}" rel="stylesheet" async="1"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet"
          async="1"/>
    @yield('style')
</head>
<body class="">
@yield('content')
<script src="{{ asset_cdn('adminkit/static/js/app.js')}}"></script>
@yield('script2')
</body>
</html>
