@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Detalhes da Vaga</h2>

        <p><strong>Vaga:</strong> {{ $vaga->nome }}</p>
        <p><strong>Descrição:</strong> {{ $vaga->descricao }}</p>
        <p><strong>Status:</strong> {{ $vaga->status }}</p>

        <h3>Filtrar Candidatos:</h3>
        <form class='filter-candidatos' action="{{ route('vagas.show', $vaga->id) }}" method="GET">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome:</label>
                <input type="text" class="form-control" id="nome" name="nome" value="{{ request()->input('nome') }}">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ request()->input('email') }}">
            </div>
            <div class="mb-3">
                <label for="cpf" class="form-label">CPF:</label>
                <input type="text" class="form-control" id="cpf" name="cpf" value="{{ request()->input('cpf') }}">
            </div>
            <button type="submit" class="btn btn-primary" onclick="applyFilters()">Filtrar</button>
        </form>

        <h3>Candidatos:</h3>
        @if(count($candidatos) > 0)
        <ul>
    @foreach($candidatos as $candidato)
        <li>
            {{ $candidato->nome }} - {{ $candidato->email }}
            <form action="{{ route('candidatos.destroy', ['vaga' => $vaga->id, 'candidato' => $candidato->id]) }}" method="POST" style="display: inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-remove-candidatos btn-danger">Remover</button>
            </form>
        </li>
    @endforeach
</ul>
        @else
            <p>Não há candidatos para esta vaga.</p>
        @endif
    </div>
    <script>
    function applyFilters() {

        let name =document.getElementById('filter-nome').value
        let cpf =document.getElementById('filter-cpf').value
        let email =document.getElementById('filter-cpf').value

        var filters = {
            nome: name,
            cpf: cpf,
            email: email
        };

     filters = Object.fromEntries(Object.entries(filters).filter(([key, value]) => {
            return value !== '';
        }));

        var queryString = Object.keys(filters).map(key => key + '=' + filters[key]).join('&');
        var url = "{{ route('vagas.index') }}" + '?' + queryString;

        window.location.href = url;
    }
</script>
@endsection
