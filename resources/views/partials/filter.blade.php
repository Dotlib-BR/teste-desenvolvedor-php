<div class="form-group">
    <label for="filter">
        <b>Filtrar</b> 
    
        @if (isset($count_results) && $count_results)
            (Resultados: {{ $count_results }})
        @endif
    </label>

    <div class="input-group mb-3">
        <input id="filter" class="form-control" type="text" name="search" value="{{ request()->get('search') }}" placeholder="{{ $placeholder ?? '' }}" aria-describedby="button-addon-search">

        <div class="input-group-append">
            <button class="btn btn-success" type="submit" id="button-addon-search">Filtrar</button>
        </div>
    </div>
</div>

@isset($options)    
    @foreach ($options as $key => $option)    
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="filter[]" value="{{ $key }}" id="{{ $key }}" {{ array_key_exists('filter', request()->all()) && in_array($key, request()->get('filter')) ? 'checked' : '' }}>
            <label class="form-check-label" for="{{ $key }}">
                {{ $option }}            
            </label>
        </div>
    @endforeach
@endisset