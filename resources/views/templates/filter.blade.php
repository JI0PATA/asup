<form class="wp" action="">
    <div class="row">
        <div class="col">
            <select name="filter" class="form-control" title="Тип заявки">
                <option value="" {{ \Request::get('filter') === null ? 'selected' : '' }}>Все заявки</option>
                <option value="not-accept" {{ \Request::get('filter') === 'not-accept' ? 'selected' : '' }}>Непринятые заявки</option>
                <option value="complete" {{ \Request::get('filter') === 'complete' ? 'selected' : '' }}>Выполненные заявки</option>
            </select>
        </div>
        <div class="col">
            <select name="date_filter" class="form-control" title="Фильтр по времени">
                <option value="created_at" {{ \Request::get('date_filter') === null || \Request::get('date_filter') === 'created_at' ? 'selected' : '' }}>Время создания</option>
                <option value="accepted_at" {{ \Request::get('date_filter') === 'accepted_at' ? 'selected' : '' }}>Время принятия</option>
                <option value="completed_at" {{ \Request::get('date_filter') === 'completed_at' ? 'selected' : '' }}>Время завершения</option>
            </select>
        </div>
    </div><br>
    <div class="row">
        <div class="col">
            <input type="text" name="date_from" class="form-control datepicker" placeholder="Дата от"
                   value="{{ \Request::get('date_from') }}">
        </div>
        <div class="col">
            <input type="text" name="date_to" class="form-control datepicker" placeholder="Дата до"
                   value="{{ \Request::get('date_to') }}">
        </div>
    </div>
    <br>
    <div>
        <button type="submit" class="btn btn-primary">Показать</button>
    </div>
</form><br>

@push('scripts')
    <script>
        $(document).ready(function () {
            $('.datepicker').datepicker({
                maxDate: '+d',
                changeMonth: true,
                changeYear: true,
                // dateFormat: 'dd/mm/yy'
            });
        });
    </script>
@endpush