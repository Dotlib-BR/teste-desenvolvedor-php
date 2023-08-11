@extends('layouts.app')

@section('content')
    <h1>Editar Vaga</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('vagas.update', $vaga->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nome">Nome da Vaga</label>
            <input type="text" class="form-control" id="nome" name="nome" value="{{ $vaga->nome }}" required>
        </div>
        <div class="form-group">
            <label for="tipo">Tipo</label>
            <select class="form-control" id="tipo" name="tipo" required>
                <option value="CLT" {{ $vaga->tipo === 'CLT' ? 'selected' : '' }}>CLT</option>
                <option value="Pessoa Jurídica" {{ $vaga->tipo === 'Pessoa Jurídica' ? 'selected' : '' }}>Pessoa Jurídica</option>
                <option value="Freelancer" {{ $vaga->tipo === 'Freelancer' ? 'selected' : '' }}>Freelancer</option>
            </select>
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <select class="form-control" id="status" name="status" required>
                <option value="ativo" {{ $vaga->status === 'ativo' ? 'selected' : '' }}>Ativo</option>
                <option value="pausado" {{ $vaga->status === 'pausado' ? 'selected' : '' }}>Pausado</option>
            </select>
        </div>
        <div class="form-group">
            <label for="email">Email de Contato</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $vaga->email }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Atualizar Vaga</button>
    </form>
@endsection
