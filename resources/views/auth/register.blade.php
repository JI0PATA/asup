{{ config(['app.name' => 'Регистрация']) }}

@extends('layouts.app')

@section('content')
    @push('styles')
        <style>
            html, body {
                min-height: 100%;
                height: 100%;
            }

            main.py-4 {
                padding: 0 !important;
            }

            nav {
                display: none !important;
            }
            .wp {
                width: 100%;
            }
            main .wp {
                width: 1200px;
            }
        </style>
    @endpush
    <main style="background-image: url('{{ asset('img/asup/bg.png') }}');">
        <div class="wp">
            <div class="left">
                <img src="{{ asset('img/asup/logo.png') }}" alt="">
                <form action="{{ route('register') }}" method="POST">
                    {{ csrf_field() }}

                    <div class="hat">
                        <img src="{{ asset('img/asup/lk.png') }}" alt="">
                        личный кабинет
                    </div>

                    <input type="hidden" name="group_id" value="1">

                    <div class="inputs">
                        <div>
                            <div style="background-image: url({{ asset('img/asup/login.png') }})"></div>
                            <input type="text" placeholder="Логин" name="login" required>
                        </div>
                        <div>
                            <div style="background-image: url({{ asset('img/asup/password.png') }})"></div>
                            <input type="password" placeholder="Пароль" name="password" required>
                        </div>
                        <div>
                            <div style="background-image: url({{ asset('img/asup/password.png') }})"></div>
                            <input type="password" placeholder="Пароль ещё раз" name="conf-password" required>
                        </div>
                        <div>
                            <div style="background-image: url({{ asset('img/asup/email.png') }})"></div>
                            <input type="email" placeholder="E-mail" name="email" required>
                        </div>
                        <div>
                            <div style="background-image: url({{ asset('img/asup/fio.png') }})"></div>
                            <input type="text" placeholder="Полное ФИО" name="name" required>
                        </div>
                        <div>
                            <div style="background-image: url({{ asset('img/asup/post.png') }})"></div>
                            <input type="text" placeholder="Должность" name="position" required>
                        </div>
                        <div>
                            <div style="background-image: url({{ asset('img/asup/key.png') }})"></div>
                            <input type="text" placeholder="Код" style="width: 150px" name="key" required>
                            <input type="submit" value="Регистрация" class="btn">
                        </div>

                    </div>
                </form>
            </div>
            <div class="right">
                <div class="title">техническая служба</div>
                <div class="images">
                    <img src="{{ asset('img/asup/img1.png') }}" alt="">
                    <img src="{{ asset('img/asup/img2.png') }}" alt="">
                </div>
            </div>
        </div>
    </main>
@endsection
