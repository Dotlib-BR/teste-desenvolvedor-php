<div class="form-group mb-0">
    <label for="paged">Itens por Página</label>
    <select class="form-control form-control-sm" name="paged" id="paged">
        <option value="" {{ request()->get('paged') == null ? 'selected' : ''}}>Todos</option>
        <option value="20" {{ request()->get('paged') == 20 ? 'selected' : ''}}>20</option>
        <option value="30" {{ request()->get('paged') == 30 ? 'selected' : ''}}>30</option>
        <option value="40" {{ request()->get('paged') == 40 ? 'selected' : ''}}>40</option>
        <option value="50" {{ request()->get('paged') == 50 ? 'selected' : ''}}>50</option>
    </select>
</div>