<div class="form-group">
    <label for="equipment">Выберите оборудование</label>
    <select class="custom-select" name="equipment" id="equipment" required {{ isset($disabled) ? 'disabled' : '' }}>
        {{ !isset($equipment) ? $equipment = 'empty' : '' }}
        <option value="Компьютер" {{ $equipment === 'Компьютер' ? 'selected' : '' }}>Компьютер</option>
        <option value="Принтер" {{ $equipment === 'Принтер' ? 'selected' : '' }}>Принтер</option>
        <option value="Проектор" {{ $equipment === 'Проектор' ? 'selected' : '' }}>Проектор</option>
        <option value="СКУД - система контроля и управления доступом" {{ $equipment === 'СКУД - система контроля и управления доступом' ? 'selected' : '' }}>СКУД - система контроля и управления доступом</option>
        <option value="Прочее" {{ $equipment === 'Прочее' ? 'selected' : '' }}>Прочее</option>
    </select>
</div>