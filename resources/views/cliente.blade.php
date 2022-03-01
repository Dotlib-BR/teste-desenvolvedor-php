@extends('layout')

@section('content')
		<div class="col-10">
            <div class="row">
                <div class="col-12 c12">
                <a class="btn btn-primary" role="button" href="/cadastrarCliente">Cadastrar Novo Cliente</a>

                <div class="table-responsive" style="margin-top:1rem;">
                    <table class="table table-bordered" id="tabelaEditar" >
                      <thead  class="table-dark">
                        <tr>
                          <th >Nome</th>
                          <th >CPF</th>
                          <th >Email</th>
                          <th >Opções</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($clientes as $item)
                        <tr>
                            <td>{{$item->NomeCliente}}</td>
                            <td>{{$item->CPF}}</td>
                            <td>{{$item->Email}}</td>
                            <td >
                              <form action="{{ route('cliente',  $item->id) }}" method="post">
                                 <a href="{{ route('detalhesDoCliente', 
                                $item->id) }}">Detalhes</a> | 
                                   <a href="{{ route('editarCliente', 
                                   $item->id) }}">Editar</a>
                                 @csrf
                                 
                                 <button type="submit" onclick="excluirUsuario()">Excluir</button>
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
          function excluirUsuario()
          {
          alert("Cliente excluído com sucesso!");
          }
      </script>
@endsection