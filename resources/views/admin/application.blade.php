{{ config(['app.name' => 'Заявка']) }}

@if(session()->has('admin')) <?php $layout = 'admin' ?>
@else <?php $layout = 'app' ?>
@endif


@extends('layouts.'.$layout)

@section('content')
    @push('styles')
        <style>
            .title {
                font-size: 20px;
            }
        </style>
    @endpush

    <p class="title font-weight-bold">Аудитория: {{ $application['place'] }}</p>
    <p class="title">Оборудование: {{ $application['equipment'] }}</p>
    <p class="title">Комментарий:<br>
        {!! nl2br($application['comment']) !!}
    </p>
    <p class="title">
        Создано: <strong>{{ $application['user']['name'] }}</strong> {{ format_date($application['created_at']) }}
    </p>
    <p class="title">
        Уровень сложности: {{ $application['level'] }} уровень
    </p>
    <p class="title">
        Принял: {!! $application['engineer'] === null ? '-' : '<b>'.$application['engineer']['name'].'</b> '.format_date($application['accepted_at']) !!}
    </p>
    @if(Auth::check())
        @if($application['completed_at'] !== null)
            <p class="title">
                Завершено: {{ $application['completed_at'] }}
            </p>
        @endif
        @if($application['accept_user_id'] === null)
            <a href="#"
               onclick="if(confirm('Вы уверены?')) location.href='{{ route('engineer.application.accept', ['id' => $application['id']]) }}'">
                <button type="button" class="btn btn-primary">Принять</button>
            </a>
        @elseif($application['accept_user_id'] === Auth::id() && $application['accept_user_id'] !== null && $application['completed_at'] === null)
            <a href="#"
               onclick="if(confirm('Вы уверены?')) location.href='{{ route('engineer.application.complete', ['id' => $application['id']]) }}'">
                <button type="button" class="btn btn-success">Завершить</button>
            </a>
        @elseif($application['accept_user_id'] === Auth::id() && $application['completed_at'] !== null)
            <a href="#"
               onclick="if(confirm('Вы уверены?')) location.href='{{ route('engineer.application.resume', ['id' => $application['id']]) }}'">
                <button type="button" class="btn btn-warning">Возобновить</button>
            </a>
        @else
            <a href="#"
               onclick="if(confirm('Вы уверены?')) location.href='{{ route('engineer.application.accept', ['id' => $application['id']]) }}'">
                <button type="button" class="btn btn-danger">Перепринять</button>
            </a>
        @endif
        @if($application['accept_user_id'] === Auth::id())
            <a href="#"
               onclick="if(confirm('Вы уверены?')) location.href='{{ route('engineer.application.cancel', ['id' => $application['id']]) }}'">
                <button type="button" class="btn btn-danger">Отказаться</button>
            </a>
        @endif
    @endif
@endsection