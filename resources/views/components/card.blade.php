<div class="card border-0 shadow-sm">
    @isset($header)    
        <div class="card-header border-0 font-weight-bold shadow-sm">
            {{ $header }}
        </div>
    @endisset

    <div class="card-body">
        {{ $slot }}
    </div>
</div>