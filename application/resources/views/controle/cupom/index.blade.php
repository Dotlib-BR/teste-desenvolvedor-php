@extends('layouts.controle')

@section('content')
<div class="card mb-4">
    <div class="card-header">
        Cupons de desconto
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
      Cupons de desconto
      <a href="{{ route('controle.cupom.create') }}" class="btn btn-success float-right">Cadastrar</a>
    </div>
    <div class="card-body table-responsive">
      <table class="table">
          <thead>
            <tr>
                <th>#ID</th>
                <th>Nome</th>
                <th>Código</th>
                <th>Valor</th>
                <th>Data de cadastro</th>
                <th>Opções</th>
            </tr>
          </thead>
          <tbody>
              @forelse ($cupoms as $cupom)
                <tr>
                    <td>{{ $cupom->id }}</td>
                    <td>{{ $cupom->nome }}</td>
                    <td>{{ $cupom->codigo }}</td>
                    <td>{{ ($cupom->valor) }}%</td>
                    <td>{{ $cupom->created_at->format('d/m/Y') }}</td>
                    <td>
                        <form action="{{ route('controle.cupom.destroy', $cupom->id) }}" method="POST">
                            <a href="{{ route('controle.cupom.edit', $cupom->id) }}" class="btn btn-primary">Editar</a>
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
                  <td colspan="7">{!! $cupoms->appends(request()->all())->links() !!}</td>
              </tr>
          </tfoot>
      </table>
    </div>
</div>
@endsection
