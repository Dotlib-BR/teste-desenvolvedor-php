
@if(!is_null(Cart::count()))
@php
$conta = Cart::count();
@endphp
<span wire:poll.0.2s @if($conta>0) class="inline-flex items-center justify-center px-2 py-1 mr-2 text-xs font-bold leading-none text-red-100 bg-red-600 rounded-full" @endif>@if($conta >0){{$conta}} @endif</span>
@endif