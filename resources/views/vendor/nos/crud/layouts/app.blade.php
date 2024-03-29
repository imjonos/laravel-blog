<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="stylesheet" type="text/css" href="/css/app.css">
    @include('vendor.nos.crud.layouts.translations')
</head>
<body>
<nav class="navbar navbar-dark bg-dark navbar-expand-lg">
    <a class="navbar-brand" href="#">{{ env('APP_NAME') }}</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
            aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto">
        </ul>
        {{-- <span class="navbar-text">
        </span> --}}
        <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        @lang('crud.labels.profile')
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                        <li>
                            @if(auth()->check())
                                <a class="dropdown-item" href="/logout">@lang('crud.labels.logout')</a>
                            @else
                                <a class="dropdown-item" href="/login">@lang('crud.labels.login')</a>
                            @endif
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container-fluid" id="app">
    <div class="row" v-cloak>
        <div class="col-md-2 bg-white pt-3">
            <ul class="navbar-nav mr-auto">
                <div class="list-group">
                    @include('nos.crud::layouts.menu')
                </div>
            </ul>
        </div>
        <div class="col-md-10 pt-3">
            @yield('content')
            <notifications group="system"/>
        </div>
    </div>
</div>
<script type="text/javascript" src="/js/app.js"></script>
</body>
</html>
