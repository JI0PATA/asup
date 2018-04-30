{{ config(['app.name' => 'Профиль']) }}

@extends('layouts.app')

@section('content')
    <section class="horizontal-cards">
        @forelse($applications as $application)
            <section class="horizontal-card">
                <div class="title">№ аудитории: {{ $application['place'] }}</div>
                <div class="text">Оборудование: {{ $application['equipment'] }}</div>
                <div class="text">Комментарий:<br>{!! nl2br($application['comment']) !!}</div>
                <br>
                <div class="text">Создано: <strong>{{ $application['user']['name'] }}</strong> {{ format_date($application['created_at']) }}</div>
                <div class="text">Принято: {!! $application['accept_user_id'] === null ? '-' : '<b>'.$application['engineer']['name'].'</b> '.format_date($application['accepted_at']) !!}</div>
                @if($application['completed_at'] !== null)
                    <div class="text">Завершено: {{ $application['completed_at'] }}</div>
                @endif
            </section>
        @empty
            <h2>Заявок пока нет!</h2>
        @endforelse
    </section>
@endsection