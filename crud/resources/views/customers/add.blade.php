@extends("home")
@section("container")

<form method="POST">
  {{csrf_field()}}
  <label for="name">Nome<span>*</span></label>
  <input type="text" name="name" id="name">

  <label for="cpf">CPF<span>*</span></label> 
  <input type="number" name="cpf" id="cpf">

  <label for="email">E-mail</label>
  <input type="text" name="email" id="email">

  <button id="button" class="buttom-add" type="submit" onclick="save()" >Salvar</button>
  <p><span>*</span> = Obrigatório.</p> 
</form>
<a class="buttom-add" href="/customers" >Cancelar</a>

<script>
//   document.addEventListener("click", function(){
//     document.getElementById("demo").innerHTML = "Hello World";
//   });

  // function save() {
  //   window.alert("asdl")
    echo '<script>alert("Inserido com sucesso!")//</script>';

  // }
</script>

@endsection