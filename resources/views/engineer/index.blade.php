{{ config(['app.name' => 'Все заявки']) }}

@if(\Request::get('filter') === 'not-accept') {{ config(['app.name' => 'Непринятые заявки']) }}
@elseif(\Request::get('filter') === 'complete') {{ config(['app.name' => 'Выполненные заявки']) }}
@endif

@extends('layouts.app')

@section('content')
    @if($applications->isEmpty())
        <h2>Нет заявок</h2>
    @else
        <div class="wp">
            <a href="{{ route('engineer.index') }}">
                <button type="button" class="btn btn-primary">Все заявки</button>
            </a>
            <a href="{{ route('engineer.index', ['filter' => 'not-accept']) }}">
                <button type="button" class="btn btn-warning">Непринятые заявки</button>
            </a>
            <a href="{{ route('engineer.index', ['filter' => 'complete']) }}">
                <button type="button" class="btn btn-success">Выполненные заявки</button>
            </a>
        </div><br>
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>ФИО</th>
                <th>№ ауд.</th>
                <th>Оборудование</th>
                <th>Время принятия</th>
                <th>Время завершения</th>
                <th>Сложность</th>
                <th>Статус</th>
                <th>Техник</th>
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
                    <td>{{ format_date($application['accepted_at']) }}</td>
                    <td>{{ format_date($application['completed_at']) }}</td>
                    <td>{{ $application['level'] }} уровень</td>
                    <td>{{ $application['accept_user_id'] === null ? 'Ожидается' : ($application['completed_at'] === null ? 'Выполняется' : 'Выполнено')}}</td>
                    <td>{{ $application['accept_user_id'] === null ? '-' : $application['engineer']['name'] }}</td>
                    <td>
                        <a href="{{ route('engineer.application.view', ['id' => $application['id']]) }}">
                            <button type="button" class="btn btn-primary">Открыть</button>
                        </a>
                        @if($application['accept_user_id'] === null)
                            <a href="#" onclick="if(confirm('Вы уверены?')) location.href='{{ route('engineer.application.accept', ['id' => $application['id']]) }}'">
                                <button type="button" class="btn btn-primary">Принять</button>
                            </a>
                        @elseif($application['accept_user_id'] === Auth::id() && $application['accept_user_id'] !== null && $application['completed_at'] === null)
                            <a href="#" onclick="if(confirm('Вы уверены?')) location.href='{{ route('engineer.application.complete', ['id' => $application['id']]) }}'">
                                <button type="button" class="btn btn-success">Завершить</button>
                            </a>
                        @elseif($application['accept_user_id'] === Auth::id() && $application['completed_at'] !== null)
                            <a href="#" onclick="if(confirm('Вы уверены?')) location.href='{{ route('engineer.application.resume', ['id' => $application['id']]) }}'">
                                <button type="button" class="btn btn-warning">Возобновить</button>
                            </a>
                        @elseif($application['completed_at'] === null)
                            <a href="#" onclick="if(confirm('Вы уверены?')) location.href='{{ route('engineer.application.accept', ['id' => $application['id']]) }}'">
                                <button type="button" class="btn btn-danger">Перепринять</button>
                            </a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
@endsection