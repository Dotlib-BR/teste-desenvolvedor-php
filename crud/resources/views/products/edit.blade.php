@extends("home")
@section("container")

<form action="/products/update/{{$id}}" method="POST">
  {{-- {{csrf_field()}} --}}

  @csrf
  @method('PUT')

  <label for="product">Produto<span>*</span></label>
  <input type="text" name="product" id="product" value="{{$product}}">

  <label for="bar_code">Cód. Barras</label> 
  <input type="text" name="bar_code" id="bar_code" value="{{$bar_code}}">

  <label for="inventory">Estoque<span>*</span></label>
  <input type="text" name="inventory" id="inventory" value="{{$inventory}}">

  <label for="value">Valor<span>*</span></label>
  <input type="text" name="value" id="value" value="{{$value}}">

  <label for="description">Descrição</label>
  <input type="text" name="description" id="description" value="{{$description}}">

  <button id="button" class="buttom-add" type="submit" onclick="save()" >Salvar</button>
  <p><span>*</span> = Obrigatório.</p> 
</form>
<a class="buttom-add" href="/products" >Cancelar</a>

<script>
//   document.addEventListener("click", function(){
//     document.getElementById("demo").innerHTML = "Hello World";
//   });

  // function save() {
  //   window.alert("test")

  // }
</script>

@endsection