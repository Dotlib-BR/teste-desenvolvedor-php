@extends('layouts.app')

@section('content')
<form action="{{ isset($job) ? route('jobs.update', $job->id) : route('jobs.store') }}" method="post">
    @csrf
    @if(isset($job))
    @method('PUT')
    @endif

    <label for="title">Título:</label>
    <input type="text" name="title" value="{{ old('title', $job->title ?? '') }}">

    <!-- Os demais campos vão aqui -->

    <button type="submit">{{ isset($job) ? 'Atualizar' : 'Criar' }} Vaga</button>
</form>
@endsection
