@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        Dados do Cupom  
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form method="post" action="{{route('descontos.store')}}">
                            @csrf  
                            <input type="hidden" name="id" value="{{$desconto->id}}">                          
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="nome">Desconto</label>
                                    <input type="text" class="form-control" id="nome" name="nome" value="{{$desconto->nome}}"> 
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="valor">Valor</label>
                                    <input type="text" class="form-control" id="valor" name="valor" value="{{$desconto->valor}}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="validade">Validade</label>
                                    <input type="date" class="form-control" id="validade" name="validade" value="{{$desconto->validade}}">
                                </div>                               
                            </div>  
                            <button type="submit" class="btn btn-outline-secondary">Salvar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection