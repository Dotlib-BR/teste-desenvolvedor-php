@extends("home")
@section("container")
<link rel="stylesheet" href="{{ asset('css/products.css') }}">


  {{-- MENU --}}
<div class="menu">
  <h3>PRODUTOS:</h3>
  <a href="/products/add" class="buttom-add">
    Adicionar produto +
  </a>
</div>

  {{-- LISTAGEM PRODUTOS --}}
  <table class="list">
    <thead>
      <tr>
        <th>ID</th>
        <th>Produto</th>
        <th>Estoque</th>
        <th>Valor</th>
        <th>#</th>
        <th>#</th>
      </tr>
    </thead>
    <tbody>
    @foreach($products as $product)
      <tr> 
        <td> {{$product->id}} </td>  
        <td> {{$product->product}} </td>  
        <td> {{$product->inventory}} </td>  
        <td>R$ {{$product->value}} </td>  
        <td> <a href="/products/edit/{{$product->id}}"> Editar </a></td>  
        <td>
           <form action="/products/delet/{{$product->id}}" method="POST" class="form-delet"> 
            @csrf 
            @method('DELETE')
            <button type="submit">
              Deletar
            </button>
          </form> 
        </td>  
      </tr>
      @endforeach
    </tbody>

  </table>


@endsection