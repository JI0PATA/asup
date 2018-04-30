{{ config(['app.name' => 'Просмотр заявки']) }}

@extends('layouts.admin')

@section('content')
    <form action="{{ route('admin.updateApplication', ['id' => $application['id']]) }}" method="POST">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="name">ФИО</label>
                <input type="text" class="form-control" id="name" placeholder="ФИО"
                       value="{{ $application['user']['name'] }}" readonly required>
            </div>
            <div class="form-group col-md-6">
                <label for="place">Номер аудитории</label>
                <input type="text" class="form-control" id="place" placeholder="Номер аудитории"
                       value="{{ $application['place'] }}" required readonly>
            </div>
        </div>
        @include('templates.equipment', ['disabled' => true, 'equipment' => $application['equipment']])
        <div class="form-group">
            <label for="comment">Комментарий</label>
            <textarea class="form-control" id="comment" rows="6" readonly>{{ $application['comment'] }}</textarea>
        </div>
        <div class="form-group">
            <label for="level">Уровень сложности</label>
            <select class="custom-select" name="level" id="level" required>
                <option value="1">1 уровень</option>
                <option value="2">2 уровень</option>
                <option value="3">3 уровень</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>
@endsection

