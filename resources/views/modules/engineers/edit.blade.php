{{ config(['app.name' => 'Изменить инженера']) }}

@extends('layouts.admin')

@section('content')
    <form action="{{ route('admin.engineers.update', ['id' => $engineer['id']]) }}" method="post">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="login">Логин</label>
                <input type="text" name="login" value="{{ $engineer['login'] }}" class="form-control" id="login" placeholder="Логин" required>
            </div>
            <div class="form-group col-md-6">
                <label for="position">Должность</label>
                <input type="text" name="position" value="{{ $engineer['position'] }}" class="form-control" id="position" placeholder="Должность" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="email">E-mail</label>
                <input type="email" name="email" value="{{ $engineer['email'] }}" class="form-control" id="email" placeholder="E-mail" required>
            </div>
            <div class="form-group col-md-6">
                <label for="name">ФИО</label>
                <input type="text" name="name" value="{{ $engineer['name'] }}" class="form-control" id="name" placeholder="ФИО" required>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Сохранить данные</button>
    </form><br><br>
    <form action="{{ route('admin.engineers.update.password', ['id' => $engineer['id']]) }}" method="post">
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