@extends("home")
@section("container")

<form action="/customers/add" method="POST">
  {{csrf_field()}}
  <label for="name">Nome<span>*</span></label>
  <input type="text" name="name" id="name">

  <label for="cpf">CPF<span>*</span></label> 
  <input type="number" name="cpf" id="cpf">

  <label for="email">E-mail</label>
  <input type="text" name="email" id="email">

  <button id="button" class="buttom-add" type="submit" onclick="save()" >Adicionar</button>
  <p><span>*</span> = Obrigatório.</p> 
</form>
<a class="buttom-add" href="/customers" >Cancelar</a>

<script>

</script>

@endsection