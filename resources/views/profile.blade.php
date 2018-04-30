{{ config(['app.name' => 'Профиль']) }}

@extends('layouts.app')

@section('content')
    <?php
        if (Auth::user()->group_id === 1) $layout = 'user';
        else $layout = 'engineer';
    ?>

    <form action="{{ route($layout.'.profile.update', ['id' => Auth::id()]) }}" method="post">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="login">Логин</label>
                <input type="text" name="login" value="{{ Auth::user()->login }}" class="form-control" id="login" placeholder="Логин" required>
            </div>
            <div class="form-group col-md-6">
                <label for="position">Должность</label>
                <input type="text" name="position" value="{{ Auth::user()->position }}" class="form-control" id="position" placeholder="Должность" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="email">E-mail</label>
                <input type="email" name="email" value="{{ Auth::user()->email}}" class="form-control" id="email" placeholder="E-mail" required>
            </div>
            <div class="form-group col-md-6">
                <label for="name">ФИО</label>
                <input type="text" name="name" value="{{ Auth::user()->name }}" class="form-control" id="name" placeholder="ФИО" required>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Сохранить данные</button>
    </form><br><br>
    <form action="{{ route($layout.'.profile.update.password', ['id' => Auth::id()]) }}" method="post">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="old_password">Старый пароль</label>
                <input type="password" name="old_password" class="form-control" id="old_password" placeholder="Старый пароль" required>
            </div>
            <div class="form-group col-md-6">
                <label for="password">Новый пароль</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Новый пароль" required>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Изменить пароль</button>
    </form>
@endsection