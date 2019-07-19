@extends('layouts.app')
@section('content')
@if(Auth::user()->perfil == 1)
    @include('dashAdm')
@else
    @include('dashCliente')
@endif
@endsection
