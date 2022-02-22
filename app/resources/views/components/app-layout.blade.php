@props([
    'pageName',
])

@extends('layouts.main')

@section('header')
    {{ $header ?? '' }}
@endsection

@section('content')
    {{ $slot }}
@endsection