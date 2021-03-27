@extends('layouts.controle')

@section('content')
<div class="card mb-4">
    <div class="card-header">
      Clientes
    </div>
    <div class="card-body">
        {!! Form::model(request()->all(), ['route' => null, 'method' => 'GET']) !!}

        <div class="form-group">
            <label for="q">Nome, E-mail ou CPF</label>
            {!! Form::text('q',  null, ['class' => 'form-control', 'maxlength' => 255]) !!}
        </div>

        <button type="submit" class="btn btn-info">Buscar</button>

        {!! Form::close() !!}
    </div>
</div>

<div class="card">
    <div class="card-header">
      Clientes
      <a href="{{ route('controle.clientes.create') }}" class="btn btn-success float-right">Cadastrar</a>
    </div>
    <div class="card-body table-responsive">
      <table class="table">
          <thead>
            <tr>
                <th>#ID</th>
                <th>Nome</th>
                <th>E-mail</th>
                <th>CPF</th>
                <th>Data de cadastro</th>
                <th>Opções</th>
            </tr>
          </thead>
          <tbody>
              @forelse ($clientes as $cliente)
                <tr>
                    <td>{{ $cliente->id }}</td>
                    <td>{{ $cliente->nome }}</td>
                    <td>{{ $cliente->email }}</td>
                    <td>{{ $cliente->cpf }}</td>
                    <td>{{ $cliente->created_at->format('d/m/Y') }}</td>
                    <td>
                        <form action="{{ route('controle.clientes.destroy', $cliente->id) }}" method="POST">
                            <a href="{{ route('controle.clientes.edit', $cliente->id) }}" class="btn btn-primary">Editar</a>
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
                  <td colspan="7">{!! $clientes->appends(request()->all())->links() !!}</td>
              </tr>
          </tfoot>
      </table>
    </div>
</div>
@endsection
