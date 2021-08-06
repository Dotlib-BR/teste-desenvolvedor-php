@extends('master.main')
@section('main')
    <div class="container my-5">
        <form class="row g-3" action="{{route('cliente.update',$cliente->id)}}" method="post">
            @csrf
            @method('PUT')
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Nome</label>
            <input name='nome' class="form-control" value="{{$cliente->NomeCliente}}"  >
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">CPF</label>
            <input name="cpf" class="cpf form-control" value="{{$cliente->CPF}}" >
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">E-mail</label>
            <input name="email" type="email" class="form-control" value="{{$cliente->Email}}" >
        </div>
            <div class="col-5">
                <button type="submit" class="btn btn-dark">Enviar</button>
            </div>
        </form>
    </div>

@endsection
