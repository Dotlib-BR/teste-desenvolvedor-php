@extends('layout')

@section('content')
		<div class="col-10">
			<div class="row">
				<div class="col-12 c12">
					<h2>
						Cadastrar Produto
					</h2>
					<div class="form form_estilo">
					<form method="post" action="/api/produto">
					@csrf
						<div class="form-group ">
							 
							<label for="nomeProduto">
								Nome
							</label>
							<input type="text" class="form-control fc" name="nomeProduto">
						</div>
						<div class="form-group ">
							 
							<label for="cBarras">
								Código de Barras
							</label>
							<input type="text" class="form-control fc" name="cBarras" maxlength="13">
						</div>
						<div class="form-group fg">
							 
							<label for="valorU">
								Valor Unitário
							</label>
							<input type="text" class="form-control fc" name="valorU">
						</div>
						<div class="btn-form">
						<button type="submit" class="btn btn-primary" onclick="cadastrarProduto()">
							Cadastrar
						</button>
						<a class="btn btn-danger" role="button" href="/api/produto">Cancelar</a>
					</div>
					</form> 
					</div>
				</div>
			</div>
		</div>
		<script>
			function cadastrarProduto()
			{
			alert("Produto cadastrado com sucesso!");
			}
		</script>
@endsection
