@extends('master.main')
@section('main')
    <div class="container my-5">
        <form class="row g-3" action="{{route('produto.store')}}" method="post">
            @csrf
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Nome</label>
            <input name='nome' class="form-control"  >
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Código de barras</label>
            <input name="cd-barras" class="cb form-control"  >
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Valor</label>
            <input name="valor"  class="form-control" >
        </div>
            <div class="col-5">
                <button type="submit" class="btn btn-dark">Enviar</button>
            </div>
        </form>
    </div>

@endsection
