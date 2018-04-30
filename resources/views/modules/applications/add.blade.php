{{ config(['app.name' => 'Новая заявка']) }}

@extends('layouts.app')

@section('content')
    <form action="{{ route('user.createApplication') }}" method="POST">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="name">ФИО</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="ФИО" value="{{ Auth::user()->name }}" readonly required>
            </div>
            <div class="form-group col-md-6">
                <label for="place">Номер аудитории</label>
                <input type="text" name="place" class="form-control" id="place" placeholder="Номер аудитории" required>
            </div>
        </div>
        @include('templates.equipment')
        <div class="form-group">
            <label for="comment">Комментарий</label>
            <textarea class="form-control" name="comment" id="comment" rows="6"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Оставить заявку</button>
    </form>
@endsection