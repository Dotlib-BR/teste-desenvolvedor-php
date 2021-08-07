@extends('master.main')
@section('main')
    <div class="container my-5">
        <form class="row g-3" action="{{route('produto.update',$produto->id)}}" method="post">
            @csrf
            @method('PUT')
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Nome</label>
            <input name='nome' class="form-control" value="{{$produto->NomeProduto}}"  >
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Código de Barras</label>
            <input name="cod-barras" class=" cb form-control" value="{{$produto->CodBarras}}" >
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Valor</label>
            <input name="valor"  class="form-control" value="{{$produto->Valor}}" >
        </div>
            <div class="col-5">
                <button type="submit" class="btn btn-dark">Enviar</button>
            </div>
        </form>
    </div>

@endsection
