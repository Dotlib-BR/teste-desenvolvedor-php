@extends("home")
@section("container")

<form action="/customers/update/{{$id}}" method="POST">
  {{-- {{csrf_field()}} --}}

  @csrf
  @method('PUT')

  <label for="name">Nome<span>*</span></label>
  <input type="text" name="name" id="name" value="{{$name}}">

  <label for="cpf">CPF<span>*</span></label> 
  <input type="number" name="cpf" id="cpf" value="{{$cpf}}">

  <label for="email">E-mail</label>
  <input type="text" name="email" id="email" value="{{$email}}">

  <button id="button" class="buttom-add" type="submit" onclick="save()" >Salvar</button>
  <p><span>*</span> = Obrigatório.</p> 
</form>
<a class="buttom-add" href="/customers" >Cancelar</a>

<script>
//   document.addEventListener("click", function(){
//     document.getElementById("demo").innerHTML = "Hello World";
//   });

  // function save() {
  //   window.alert("test")

  // }
</script>

@endsection