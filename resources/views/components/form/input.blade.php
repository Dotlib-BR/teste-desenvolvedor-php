@isset($label)
    <label for="{{ $id }}">{{ $label }}</label>
@endisset

<input id="{{ $id }}" 
    class="form-control {{ $errors->has($name) ? 'is-invalid' : '' }}" 
    type="{{ $type ?? 'text' }}" 
    name="{{ $name }}"
    value="{{ old($name, $value ?? '') }}"
    placeholder="{{ $placeholder ?? '' }}">

@if ((isset($validate) && $validate !== false) || ! @isset($validate))    
    @if ($errors->has($name))
        <div class="invalid-feedback">
            {{ $errors->first($name) }}
        </div>
    @endif
@endif