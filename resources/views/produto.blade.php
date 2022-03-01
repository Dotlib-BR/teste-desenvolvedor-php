@extends('layout')

@section('content')
		<div class="col-10">
            <div class="row">
                <div class="col-12 c12">
                <a class="btn btn-primary" role="button" href="/cadastrarProduto">Cadastrar Novo Produto</a>

                <div class="table-responsive" style="margin-top:1rem;">
                    <table class="table table-bordered" id="tabelaEditar" >
                      <thead  class="table-dark">
                        <tr>
                          <th >Nome</th>
                          <th >Código de Barras</th>
                          <th >Valor Unitário</th>
                          <th >Opções</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($produtos as $item)
                        <tr>
                            <td>{{$item->NomeProduto}}</td>
                            <td>{{$item->CodBarras}}</td>
                            <td>{{$item->ValorUnitario}}</td>
                            <td >
                              <form action="{{ route('produto',  $item->id) }}" method="post">
                                 <a href="{{ route('detalhesDoProduto', 
                                $item->id) }}">Detalhes</a> | 
                                   <a href="{{ route('editarProduto', 
                                   $item->id) }}">Editar</a>
                                 @csrf
                                 
                                 <button type="submit" onclick="excluirProduto()">Excluir</button>
                              </form></td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>

                </div>
            </div>
        </div>
        <script>
          function excluirProdutoo()
          {
          alert("Produto excluído com sucesso!");
          }
      </script>
@endsection