{{ config(['app.name' => 'Новые заявки']) }}

@extends('layouts.admin')

@section('content')

    @if($applications->isEmpty())
        <h2>Нет новых заявок!</h2>
    @else
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>ФИО</th>
                <th>№ ауд.</th>
                <th>Оборудование</th>
                <th>Время отправки</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach($applications as $application)
                <tr>
                    <th scope="row">{{ $loop->index + 1 }}</th>
                    <td>{{ $application['user']['name'] }}</td>
                    <td>{{ $application['place'] }}</td>
                    <td>{{ $application['equipment'] }}</td>
                    <td>{{ format_date($application['created_at']) }}</td>
                    <td>
                        <a href="{{ route('admin.application.view.level', ['id' => $application['id']]) }}">
                            <button type="button" class="btn btn-primary">Открыть</button>
                        </a>
                        <a href="#" onclick="if(confirm('Вы уверены?')) location.href='{{ route('admin.application.delete', ['id' => $application['id']]) }}'">
                            <button type="button" class="btn btn-danger">Удалить</button>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
@endsection