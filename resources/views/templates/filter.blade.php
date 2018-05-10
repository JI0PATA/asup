<form class="wp" action="">
    <div>
        <input type="radio" id="filter__all" class="hidden" name="filter"
               value="" {{ \Request::get('filter') === null ? 'checked' : '' }}>
        <label for="filter__all" class="btn btn-primary">Все заявки</label>
        <input type="radio" id="filter__not-accept" class="hidden" name="filter"
               value="not-accept" {{ \Request::get('filter') === 'not-accept' ? 'checked' : '' }}>
        <label for="filter__not-accept" class="btn btn-warning">Непринятые заявки</label>
        <input type="radio" id="filter__complete" class="hidden" name="filter"
               value="complete" {{ \Request::get('filter') === 'complete' ? 'checked' : '' }}>
        <label for="filter__complete" class="btn btn-success">Выполненные заявки</label>
    </div>
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
        <input type="radio" id="date_filter__create" class="hidden" name="date_filter"
               value="created_at" {{ \Request::get('date_filter') === null || \Request::get('date_filter') === 'created_at' ? 'checked' : '' }}>
        <label for="date_filter__create" class="btn btn-primary">Время создания</label>

        <input type="radio" id="date_filter__accept" class="hidden" name="date_filter"
               value="accepted_at" {{ \Request::get('date_filter') === 'accepted_at' ? 'checked' : '' }}>
        <label for="date_filter__accept" class="btn btn-warning">Время принятия</label>

        <input type="radio" id="date_filter__complete" class="hidden" name="date_filter"
               value="completed_at" {{ \Request::get('date_filter') === 'completed_at' ? 'checked' : '' }}>
        <label for="date_filter__complete" class="btn btn-success">Время завершения</label>
    </div>
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
                // dateFormat: 'dd/mm/yy'
            });
        });
    </script>
@endpush