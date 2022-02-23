@props([
    'pageName',
])

<div>
    @extends('layouts.main')

    @section('header')
        {{ $header ?? '' }}
    @endsection

    @section('buttons')
        {{ $buttons ?? '' }}
    @endsection

    @section('content')
        {{ $slot }}
    @endsection
</div>