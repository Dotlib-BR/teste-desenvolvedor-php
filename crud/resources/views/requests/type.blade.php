@extends("home")
@section("container")

<form action="/requests/type" method="POST">
  {{csrf_field()}}
  @method('POST')

  <label for="type">Tipo de Estatus<span>*</span></label>
  <input type="text" name="type" id="type">

  <button id="button" class="buttom-add" type="submit" onclick="save()" >Adicionar</button>
  <p><span>*</span> = Obrigatório.</p> 
</form>
<a class="buttom-add" href="/requests" >Cancelar</a>

<script>

</script>

@endsection