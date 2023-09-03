@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar Candidato</h2>
    <form action="{{ route('candidates.update', $candidate->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Nome:</label>
            <input type="text" name="name" class="form-control" value="{{ $candidate->name }}">
        </div>
        <div class="form-group">
            <label for="email">E-mail:</label>
            <input type="email" name="email" class="form-control" value="{{ $candidate->email }}">
        </div>
        <div class="form-group">
            <label for="experience">Experiência:</label>
            <input type="text" name="experience" class="form-control" value="{{ $candidate->experience }}">
        </div>
        <div class="form-group">
            <label for="skills">Habilidades:</label>
            <input type="text" name="skills" class="form-control" value="{{ $candidate->skills }}">
        </div>
        <div class="form-group">
            <label for="availability">Disponibilidade:</label>
            <input type="text" name="availability" class="form-control" value="{{ $candidate->availability }}">
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
</div>
@endsection
