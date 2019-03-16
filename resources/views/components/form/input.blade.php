@isset($options['label'])
    <label for="{{ $options['id'] }}">{{ $options['label'] }}</label>
@endisset

<input id="{{ $options['id'] }}" 
    class="form-control {{ $errors->has($options['name']) ? 'is-invalid' : '' }}" 
    @foreach ($options as $key => $option)
        @if ($key == 'type' && ! $option)
            {{ $key . '=text' }}
        @endif
        {{ $key . '=' . $option }}
    @endforeach>

@if ((isset($validate) && $validate !== false) || ! @isset($validate))    
    @if ($errors->has($options['name']))
        <div class="invalid-feedback">
            {{ $errors->first($options['name']) }}
        </div>
    @endif
@endif