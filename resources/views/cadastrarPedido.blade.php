@extends('layout')

@section('content')
		<div class="col-10">
			<div class="row">
				<div class="col-12 c12">
					<h2>
						Cadastrar Pedido
					</h2>
					<div class="form form_estiloP">
					<form method="post" action="/api/cadastrarPedido"> 
						@csrf
						<div class="form-group ">
							 
							<label for="nmC">
								Cliente
							</label>
							<select name="nmCliente" class="form-select">
								@foreach ($clientes as $item)
								<option value="{{$item->id}}">{{$item->NomeCliente}}</option><!--filtrar pela sigla do órgão-->
								@endforeach   
							</select>
						</div>
						<div class="form-group ">
							 
							<label for="nmp">
								Produto
							</label>
							<select name="nmProduto" class="form-select">
								@foreach ($produtos as $item)
								<option value="{{$item->id}}">{{$item->NomeProduto}}</option><!--filtrar pela sigla do órgão-->
								@endforeach   
							</select>
						</div>
						<div class="form-group ">
							 
							<label for="qtd">
								Quantidade
							</label>
							<input class="input-group-text" type="text" value="" name="Qtd">
						</div>
                        <div class="col-md-8">
                            <label for="inputState" class="form-label">Data</label>
                            <input class="form-control" type="date" name="nmData">
                        </div>
						<div class="btn-form">
						<button type="submit" class="btn btn-primary"  onclick="cadastrarPedido()">
							Fazer Pedido
						</button>
						<a class="btn btn-danger" role="button" href="/api/pedido">Cancelar</a>
					    </div>
					</form> 
                    </div>
					</div>
				</div>
			</div>
		</div>
		<script>
			function cadastrarPedido()
			{
			alert("Pedido cadastrado com sucesso!");
			}
		</script>
@endsection
