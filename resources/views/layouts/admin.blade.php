<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <script
            src="https://code.jquery.com/jquery-3.3.1.js"
            integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
            crossorigin="anonymous"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/asup.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <script src="{{ asset('js/jquery/jquery-ui.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('js/jquery/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/jquery/jquery-ui.structure.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/jquery/jquery-ui.theme.min.css') }}">

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
                {{ config('app.name') }}
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
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="{{ route('admin.index') }}" role="button" aria-haspopup="true"
                           aria-expanded="false" v-pre>
                            <?php
                                $countNewApplication = App\Application::where('level', 0)->count();
                            ?>
                            Новые заявки {!! $countNewApplication === 0 ? '' : "<span class='badge badge-pill badge-secondary'>$countNewApplication</span>" !!}
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="{{ route('admin.applications') }}" role="button" aria-haspopup="true"
                           aria-expanded="false" v-pre>
                            Обработанные заявки
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="{{ route('admin.engineers') }}" role="button" aria-haspopup="true"
                           aria-expanded="false" v-pre>
                            Техники
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="{{ route('admin.users') }}" role="button" aria-haspopup="true"
                           aria-expanded="false" v-pre>
                            Пользователи
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            Главный инженер <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('admin.logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Выйти') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
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

<script
        src="https://code.jquery.com/jquery-3.3.1.js"
        integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
        crossorigin="anonymous"></script>
<script src="{{ asset('js/jquery/jquery-ui.min.js') }}"></script>

<script src="{{ asset('js/main.js') }}"></script>

@stack('scripts')
</body>
</html>
