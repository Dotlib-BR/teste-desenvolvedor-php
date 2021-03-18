@extends('principal')

@section('conteudo')

<form method="post" action="{{route('salvar.cliente.editado', $cliente->id)}}">

    {{ csrf_field() }}



    <div class="form-group">
        <label for="nome_cliente">Nome do Cliente</label>
        <input type="text" class="form-control" name="nome_cliente" value="{{$cliente->nome_cliente}}">
    </div>

    <div class="form-group">
        <label for="cpf">CPF</label>
        <input type="text" class="form-control" name="cpf" value="{{$cliente->cpf}}">
    </div>

    <div class="form-group">
        <label for="email">E-Mail</label>
        <input type="email" class="form-control" name="email" value="{{$cliente->email}}">
    </div>


    <button type="submit" class="btn btn-primary">Atualizar Cliente</button>
    <button type="reset" class="btn btn-warning">Limpar</button>
</form>

@endsection