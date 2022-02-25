@extends("home")
@section("container")

<form action="/products/add" method="POST">
  {{csrf_field()}}
  @method('POST')

  <label for="product">Produto<span>*</span></label>
  <input type="text" name="product" id="product">

  <label for="bar_code">Cód. Barras</label> 
  <input type="text" name="bar_code" id="bar_code">

  <label for="inventory">Estoque<span>*</span></label>
  <input type="text" name="inventory" id="inventory">

  <label for="value">Valor<span>*</span></label>
  <input type="text" name="value" id="value">

  <label for="description">Descrição</label>
  <input type="text" name="description" id="description">

  <button id="button" class="buttom-add" type="submit" onclick="save()" >Adicionar</button>
  <p><span>*</span> = Obrigatório.</p> 
</form>
<a class="buttom-add" href="/products" >Cancelar</a>

<script>

</script>

@endsection