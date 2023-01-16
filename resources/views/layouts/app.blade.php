<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="@yield('description')">
    <meta name="author" content="@yield('author')">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="/css/bootstrap.css" />

    </head>

<body>
<div id="app">
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img width="200" src="https://toprogram.ru/images/logo.png" alt="{{ env('APP_NAME') }}">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                    aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{route('site.posts.index')}}">{{trans("layout.menu.home")}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" target="_blank" href="https://toprogram.ru">{{trans("layout.menu.contact")}}</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        <div class="container">
            <div class="row">
                @yield('content')
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="py-5 bg-secondary">
        <div class="container">
            <p class="m-0 text-center text-white"> &copy; Мастерская Кода Евгения Носенко 2013 - {{ date('Y') }}</p>
        </div>
        <!-- /.container -->
    </footer>

</div>

</body>

</html>
