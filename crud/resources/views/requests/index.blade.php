@extends("home")
@section("container")

 {{-- MENU --}}
 <div class="menu">
  <h3>PEDIDOS:</h3>
  <a href="/requests/add" class="buttom-add">
    Adicionar pedido +
  </a>
  <a href="/requests/type" class="buttom-add">
    Adicionar tipo de estatus
  </a>
</div>

  {{-- LISTAGEM PRODUTOS --}}
  <table class="list">
    <thead>
      <tr>
        <th>ID</th>
        <th>Produto</th>
        <th>Valor</th>
        <th>#</th>
        <th>#</th>
      </tr>
    </thead>
    <tbody>
    @foreach($requests as $request)
      <tr> 
        <td> {{$request->id}} </td>  
        <td> {{$request->request}} </td>  
        <td>R$ {{$request->value}} </td>  
        <td> <a href="/requests/edit/{{$request->id}}"> Editar </a></td>  
        <td>
           <form action="/requests/delet/{{$request->id}}" method="POST" class="form-delet"> 
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