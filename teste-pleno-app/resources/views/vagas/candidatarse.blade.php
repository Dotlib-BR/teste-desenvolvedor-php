@extends('layouts.app')

@section('content')

<h1>Listagem de Vagas</h1>

<form method="get">
    <div class="row">
        <div class="col-md-3">
            <input type="text" class="form-control" id="filter-nome" name="nome" placeholder="Filtrar por nome" value="{{ request('nome') }}">
        </div>
        <div class="col-md-2">
            <select class="form-control" id="filter-tipo" name="tipo">
                <option value="">Filtrar por tipo</option>
                <option value="CLT" {{ request('tipo') === 'CLT' ? 'selected' : '' }}>CLT</option>
                <option value="Pessoa Jurídica" {{ request('tipo') === 'Pessoa Jurídica' ? 'selected' : '' }}>Pessoa Jurídica</option>
                <option value="Freelancer" {{ request('tipo') === 'Freelancer' ? 'selected' : '' }}>Freelancer</option>
            </select>
        </div>
        <div class="col-md-2">
            <select class="form-control" id="filter-status" name="status">
                <option value="">Filtrar por status</option>
                <option value="ativo" {{ request('status') === 'ativo' ? 'selected' : '' }}>ativo</option>
                <option value="Fechada" {{ request('status') === 'Fechada' ? 'selected' : '' }}>Fechada</option>
                <option value="pausado" {{ request('status') === 'pausado' ? 'selected' : '' }}>pausado</option>
            </select>
        </div>
        <div class="col-md-3">
            <input type="text" class="form-control" id="filter-email" name="email" placeholder="Filtrar por email do candidato" value="{{ request('email') }}">
        </div>
        <div class="col-md-2">
            <button type="button" class="btn btn-primary" onclick="applyFilters()">Aplicar Filtros</button>
        </div>
    </div>
</form>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Tipo</th>
            <th>Status</th>
            <th>Email</th>

            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($vagas as $vaga)
            <tr>
                <td>{{ $vaga->id }}</td>
                <td>{{ $vaga->nome }}</td>
                <td>{{ $vaga->tipo }}</td>
                <td>{{ $vaga->status }}</td>
                <td>{{ $vaga->email }}</td>

                <td>

                @if ($vaga->candidatos->contains(function ($candidato) {
                    return $candidato->user_id === Auth::user()->id;
                }))
                <div class='btn-candidato-action'>

                    <button class="btn btn-success" disabled>Candidatado!</button>
                    <form action="{{ route('remover-candidatura', ['vaga' => $vaga->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger ml-2">Cancelar Candidatura</button>
                        </form>
                </div>
                @else
                    <a href="{{ route('candidatar-vaga', ['vaga' => $vaga->id]) }}" class="btn btn-primary">Candidatar-se à Vaga</a>
                @endif



                </td>
            </tr>
        @endforeach
    </tbody>
</table>

{{ $vagas->appends(array_filter(request()->except(['page'])))->links() }}

<a href="/" class="btn btn-secondary">Voltar</a>

<script>
    function applyFilters() {

        let name =document.getElementById('filter-nome').value
        let tipo =document.getElementById('filter-tipo').value
        let status =document.getElementById('filter-status').value
        let email =document.getElementById('filter-email').value

        var filters = {
            nome: name,
            tipo: tipo,
            status: status,
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

