<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    {{ Vite::useBuildDirectory('build/site') }}
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    @yield('css')
    @vite('resources/assets/site/scss/main.scss')
    <title>@yield('title', config('app.name', 'Portfolio'))</title>
</head>
<body>
    @include('site.partials.header') 
    <main class="main">
        <div class="container">
            @yield('content')
        </div>
    </main>
    @include('site.partials.footer') 

    @include('site.partials.script')
</body>