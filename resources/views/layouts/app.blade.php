<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'АСУП') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/asup.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    @stack('styles')
</head>
<body>

@if(\Session::has('popupMsg'))
    <div id="popup_msg" class="{{ \Session::get('popupMsg.class') }}">{{ \Session::get('popupMsg.msg') }}</div>
@endif

<div id="app">
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li><a class="nav-link" href="{{ route('login') }}">{{ __('Логин') }}</a></li>
                        <li><a class="nav-link" href="{{ route('register') }}">{{ __('Регистрация') }}</a></li>
                    @else
                        @if(Auth::user()->group_id === 2)
                            <li class="nav-item dropdown">
                                <a class="nav-link" href="{{ route('engineer.index') }}" role="button" aria-haspopup="true"
                                   aria-expanded="false" v-pre>
                                    <?php
                                        $count = \App\Application::where('level', '<>', 0)->where('accept_user_id', null)->count();
                                    ?>
                                    Все заявки {!! $count !== 0 ? '<span class="badge badge-pill badge-secondary">'.$count.'</span>' : ''!!}
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link" href="{{ route('engineer.application.my') }}" role="button" aria-haspopup="true"
                                   aria-expanded="false" v-pre>
                                    Мои заявки
                                </a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a class="nav-link" href="{{ route('user.newApplication') }}" role="button" aria-haspopup="true"
                                   aria-expanded="false" v-pre>
                                    Оставить заявку
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link" href="{{ route('home') }}" role="button" aria-haspopup="true"
                                   aria-expanded="false" v-pre>
                                    Мои заявки
                                </a>
                            </li>
                        @endif
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ Auth::user()->group_id === 1 ? route('user.profile') : route('engineer.profile') }}">
                                    {{ __('Личные данные') }}
                                </a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Выйти') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4 wp">
        @yield('content')
    </main>
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
