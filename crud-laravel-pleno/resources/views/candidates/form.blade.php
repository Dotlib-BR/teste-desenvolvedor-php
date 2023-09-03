@extends('layouts.app')

@section('content')
<form action="{{ isset($candidate) ? route('candidates.update', $candidate->id) : route('candidates.store') }}" method="post">
    @csrf
    @if(isset($candidate))
    @method('PUT')
    @endif

    <label for="name">Nome:</label>
    <input type="text" name="name" value="{{ old('name', $candidate->name ?? '') }}">

    <!-- Os demais campos vão aqui -->

    <button type="submit">{{ isset($candidate) ? 'Atualizar' : 'Criar' }} Candidato</button>
</form>
@endsection
