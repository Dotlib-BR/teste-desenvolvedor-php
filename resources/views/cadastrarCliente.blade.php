@extends('layout')

@section('content')
		<div class="col-10">
			<div class="row">
				<div class="col-12 c12">
					<h2>
						Cadastrar Cliente
					</h2>
					<div class="form form_estilo">
					<form method="post" action="/api/cliente">
						@csrf
						<div class="form-group">
							 
							<label for="nomeCliente">
								Nome
							</label>
							<input type="text" class="form-control fc" name="nomeCliente">
						</div>
						<div class="form-group">
							 
							<label for="cpfCliente">
								CPF
							</label>
							<input type="text" class="form-control fc" name="cpfCliente">
						</div>
						<div class="form-group">
							 
							<label for="emailCliente">
								Email
							</label>
							<input type="text" class="form-control fc" name="emailCliente">
						</div>
						<div class="btn-form">
						<button type="submit" class="btn btn-primary" onclick="cadastrarCliente()">
							Cadastrar
						</button>
						<a class="btn btn-danger" role="button" href="/api/cliente">Cancelar</a>
					</div>
					</form> 
					</div>
				</div>
			</div>
		</div>
		<script>
			function cadastrarCliente()
			{
			alert("Cliente cadastrado com sucesso!");
			}
		</script>
@endsection
