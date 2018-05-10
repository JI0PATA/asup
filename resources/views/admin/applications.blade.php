{{ config(['app.name' => 'Обработанные заявки']) }}

@extends('layouts.admin')

@section('content')
    @include('templates.filter')
    @if($applications->isEmpty())
        <h2>Нет заявок</h2>
    @else
        <div>
            Среднее время выполнения: {{ calc_time($avg_time) }}
        </div>
        <div>
            <button class="btn btn-primary" id="button__download_excel">Скачать в Excel</button>
            <a href="{{ url('storage/app/excel/excel.csv') }}" download id="link__download_excel"></a>
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
                    <td>{{ $application['accept_user_id'] === null ? 'Ожидается' : ($application['completed_at'] === null ? 'Выполняется' : 'Выполнено') }}</td>
                    <td>{{ $application['accept_user_id'] === null ? '-' : $application['engineer']['name'] }}</td>
                    <td>
                        <a href="{{ route('admin.application.view', ['id' => $application['id']]) }}">
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