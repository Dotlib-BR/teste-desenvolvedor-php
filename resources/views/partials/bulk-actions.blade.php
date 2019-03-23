<div class="form-group mb-0">
    <label for="bulk">Ações em Massa</label>
    <select id="bulk-option" class="form-control form-control-sm" name="bulk" id="bulk">
        <option value="" selected>Selecione</option>

        @foreach ($actions as $key => $action)
            <option value="{{ $key }}" data-action="{{ $action }}">Remover</option>
        @endforeach
    </select>
</div>

<button id="bulk-action" class="btn btn-sm btn-secondary ml-2" type="button">Aplicar</button>