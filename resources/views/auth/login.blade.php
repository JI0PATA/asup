{{ config(['app.name' => 'Авторизация']) }}

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Авторизация') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="login" class="col-sm-4 col-form-label text-md-right">{{ __('Логин') }}</label>

                            <div class="col-md-6">
                                <input id="login" type="text" class="form-control" name="login" required autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Пароль') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Войти') }}
                                </button>
                                <a href="{{ route('resetPassword') }}">
                                    <button type="button" class="btn btn-primary">
                                        {{ __('Восстановить пароль') }}
                                    </button>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<footer class="wp">
    Сайт разработан <a href="https://vk.com/n.karpovich98" target="_blank">Анастасией Карпович</a>
</footer>
@endsection
