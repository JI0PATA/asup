{{ config(['app.name' => 'Список инженеров']) }}

@extends('layouts.admin')

@section('content')
    <div>
        <a href="{{ route('admin.engineers.new') }}">
            <button type="button" class="btn btn-primary">Новый инженер</button>
        </a>
    </div>
    <br><table class="table">
        <thead>
        <tr>
            <th>#</th>
            <th>ФИО</th>
            <th>E-mail</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>
        @foreach($engineers as $engineer)
            <tr>
                <th scope="row">{{ $loop->index + 1 }}</th>
                <td>{{ $engineer['name'] }}</td>
                <td>{{ $engineer['email'] }}</td>
                <td>
                    <a href="{{ route('admin.engineers.edit', ['id' => $engineer['id']]) }}">
                        <button type="button" class="btn btn-primary">Изменить</button>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection