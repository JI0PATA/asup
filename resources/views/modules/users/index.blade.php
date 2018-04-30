{{ config(['app.name' => 'Список пользователей']) }}

@extends('layouts.admin')

@section('content')
    <h2>Список пользователей</h2>
    <table class="table">
        <thead>
        <tr>
            <th>#</th>
            <th>ФИО</th>
            <th>E-mail</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <th scope="row">{{ $loop->index + 1 }}</th>
                <td>{{ $user['name'] }}</td>
                <td>{{ $user['email'] }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection