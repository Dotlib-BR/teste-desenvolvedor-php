@extends('layouts.app')

@section('template_title', 'Editar Produto')

@section('content')
    
    <div class="card shadow">
        <div class="card-header text-center">
            <h2><i class="fas fa-box"></i> {{$produto->nome}}</h2>
        </div>
        <div class="card-body p-5">
            <p><i class="fa fa-clock"></i> Última alteração: {{date('d/m/Y H:i:s', strtotime($produto->updated_at))}}</p>
            <form action="{{route('produtos-update', ['id' => $produto->id])}}" method="post">
            @csrf
            @method('PUT')
                <legend class="font-small form-control text-center"><i class="fas fa-clipboard-list"></i> Dados do Produto</legend>
                <div class="row form-group">
                    <div class="col-12 col-md-4 py-3">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" id="nome" name="nome" value="{{$produto->nome}}" placeholder="Informe o nome completo" class="form-control @error('nome') is-invalid @enderror">
                        @error('nome')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-md-4 py-3">
                        <label for="valor" class="form-label">Valor</label>
                        <input type="number" id="valor" name="valor" value="{{$produto->valor}}" step="0.01" min="1" max="250" placeholder="Informe o valor" class="form-control quantity money2 @error('valor') is-invalid @enderror">
                        @error('valor')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-md-4 py-3">
                        <label for="cod_barras" class="form-label">Código de Barras</label>
                        <input type="text" id="cod_barras" name="cod_barras" value="{{$produto->cod_barras}}" placeholder="Informe o cod_barras" minlength="13" maxlength="13" class="form-control @error('cod_barras') is-invalid @enderror">
                        @error('cod_barras')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-12 col-md-4 py-3">
                        <label for="quantidade" class="form-label">Quantidade</label>
                        <input type="number" id="quantidade" name="quantidade" value="{{$produto->quantidade}}" placeholder="Informe a quantidade" min="0" max="100" class="form-control @error('quantidade') is-invalid @enderror">
                        @error('quantidade')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-md-4 py-3">
                        <label for="status" class="form-label">Status</label>
                        <select id="status" name="status" class="form-select @error('status') is-invalid @enderror">
                            <option value="0" {{$produto->status == 0 ? 'selected' : ''}}>Inativo</option>
                            <option value="1" {{$produto->status == 1 ? 'selected' : ''}}>Ativo</option>
                            <option value="" disabled>Escolha</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-12 text-end pt-3 pb-0">
                    <a class="btn btn-dark" href="{{route('produtos-index')}}">Voltar</a>
                    <button class="btn btn-primary" type="submit">Salvar</button>
                </div>
            </form>
        </div>
    </div>
    
@endsection