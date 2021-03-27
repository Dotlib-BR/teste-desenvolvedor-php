@extends('layouts.controle')

@section('content')
<div class="card mb-4">
    <div class="card-header">
      Produtos
    </div>
    <div class="card-body">
        {!! Form::model(request()->all(), ['route' => null, 'method' => 'GET']) !!}

        <div class="form-group">
            <label for="nome">Nome</label>
            {!! Form::text('nome',  null, ['class' => 'form-control', 'maxlength' => 255]) !!}
        </div>

        <button type="submit" class="btn btn-info">Buscar</button>

        {!! Form::close() !!}
    </div>
</div>

<div class="card">
    <div class="card-header">
      Produtos
      <a href="{{ route('controle.produtos.create') }}" class="btn btn-success float-right">Cadastrar</a>
    </div>
    <div class="card-body table-responsive">
      <table class="table">
          <thead>
            <tr>
                <th>#ID</th>
                <th>Nome</th>
                <th>Valor</th>
                <th>Publicado</th>
                <th>Data de cadastro</th>
                <th>Opções</th>
            </tr>
          </thead>
          <tbody>
              @forelse ($produtos as $produto)
                <tr>
                    <td>{{ $produto->id }}</td>
                    <td>{{ $produto->nome }}</td>
                    <td>{{ decimalParaPagina($produto->valor) }}</td>
                    <td>{{ ($produto->ativo) ? 'SIM' : 'NÃO' }}</td>
                    <td>{{ $produto->created_at->format('d/m/Y') }}</td>
                    <td>
                        <form action="{{ route('controle.produtos.destroy', $produto->id) }}" method="POST">
                            <a href="{{ route('controle.produtos.edit', $produto->id) }}" class="btn btn-primary">Editar</a>
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger atencao">Excluir</button>
                        </form>
                    </td>
                </tr>
              @empty
                  <tr>
                      <td colspan="7">Nenhum registro cadastrado.</td>
                  </tr>
              @endforelse
          </tbody>
          <tfoot>
              <tr>
                  <td colspan="7">{!! $produtos->appends(request()->all())->links() !!}</td>
              </tr>
          </tfoot>
      </table>
    </div>
</div>
@endsection
