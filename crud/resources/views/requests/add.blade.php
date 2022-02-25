@extends("home")
@section("container")

<form action="/requests/add" method="POST">
  {{csrf_field()}}
  @method('POST')

  <div>
    <label for="id_customer">Cliente<span>*</span>
    </label> 
    <input type="text" name="id_customer" id="id_customer">
    <a>
      Lupa
      <img src="lupa.png" alt="" srcset="">
    </a>
    
    <label for="id_state">Estatus<span>*</span></label> 
    <select name="id_state" for="id_state">
      <option value="valor1">Fechado</option>
      <option value="valor2" selected>Aberto</option>
      <option value="valor3">Em análise</option>
    </select>
  </div>

  <table>
    <thead>
      <tr>
        <th>Cód.</th>
        <th>Produto</th>
        <th>Estoque</th>
        <th>Vl. Unid.</th>
        <th>Qtde</th>
        <th>Total</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td> <input type="text" name="id_product" id="id_product"> </td>
        <td> <input type="text" name="id_product" id="id_product"> </td>
        <td> <input type="text" name="id_product" id="id_product"> </td>
        <td> <input type="text" name="id_product" id="id_product"> </td>
        <td> <input type="text" name="id_product" id="id_product"> </td>
        <td> <input type="text" name="id_product" id="id_product"> </td>
      </tr>
    </tbody>
    
    
  </table>

  <label for="value">Subtotal: </label>
  <label for="value">Desconto (%): </label>
  <label for="value">Total Pedido: </label>
  <label for="condicao">Condição de pagamento: </label> 

  <select name="condicao" for="condicao">
    <option value="valor1">Debito</option>
    <option value="valor2">Credito</option>
    <option value="valor3" selected>Dinheiro</option>
  </select>

  <button id="button" class="buttom-add" type="submit" onclick="save()" >Adicionar</button>
  <p><span>*</span> = Obrigatório.</p> 
</form>

<a class="buttom-add" href="/requests" >Cancelar</a>

<script>

</script>

@endsection