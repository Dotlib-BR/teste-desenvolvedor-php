@extends('layouts.app')

@section('content')
    <h1>Detalhes da Vaga</h1>
    <p><strong>Nome:</strong> {{ $vaga->nome }}</p>
    <p><strong>Descrição:</strong> {{ $vaga->descricao }}</p>
    <p><strong>Status:</strong> {{ $vaga->status }}</p>
    <p><strong>Tipo:</strong> {{ $vaga->tipo }}</p>

    @auth
        <form action="{{ route('candidatar-vaga', $vaga->id) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>
            <div class="mb-3">
                <label for="cpf" class="form-label">CPF</label>
                <input type="text" class="form-control" id="cpf" name="cpf" maxlength="11" onchange="onCPFChange()">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <button type="submit" class="btn btn-primary">Quero me candidatar</button>
        </form>
    @else
        <p>Faça login para se candidatar a esta vaga.</p>
    @endauth
    @section('scripts')
<script>
    function onCPFChange() {
        const cpfInput = document.getElementById('cpf');
        let value = cpfInput.value.replace(/\D/g, '');
        if (value.length > 11) {
            value = value.slice(0, 11);
        }
        cpfInput.value = value.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, '$1.$2.$3-$4');
    }
</script>
@endsection

@endsection
