@extends('master.main')
@section('main')
    <div class="container my-5">
        <form class="row g-3" action="{{route('produto.store')}}" method="post">
            @csrf
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Nome</label>
            <input name='nome' class="form-control"  value="{{old('nome')}}">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Código de barras</label>
            <input name="cd-barras" class="cb form-control"  value="{{old('cd-barras')}}">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Valor</label>
            <input name="valor"  class="form-control" value="{{old('valor')}}">
        </div>
            <div class="col-5">
                <button type="submit" class="btn btn-dark">Enviar</button>
            </div>
        </form>
    </div>

@endsection
