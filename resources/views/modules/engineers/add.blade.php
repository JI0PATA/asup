{{ config(['app.name' => 'Добавить инженера']) }}

@extends('layouts.admin')

@section('content')
    <form action="{{ route('admin.engineers.create') }}" method="post">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="login">Логин</label>
                <input type="text" name="login" class="form-control" id="login" placeholder="Логин" required>
            </div>
            <div class="form-group col-md-6">
                <label for="password">Пароль</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Пароль" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="email">E-mail</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="E-mail" required>
            </div>
            <div class="form-group col-md-6">
                <label for="name">ФИО</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="ФИО" required>
            </div>
        </div>
        <div class="form-group">
            <label for="position">Должность</label>
            <input type="text" name="position" class="form-control" id="position" placeholder="Должность" required>
        </div>
        <button type="submit" class="btn btn-primary">Добавить инженера</button>
    </form>
@endsection