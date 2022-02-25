@extends("home")
@section("container")
<link rel="stylesheet" href="{{ asset('css/customers.css') }}">


  {{-- MENU --}}
<div class="menu">
  <h3>CLIENTES:</h3>
  <a href="/customers/add" class="buttom-add">
    Adicionar cliente +
  </a>
</div>

  {{-- LISTAGEM CLIENTES --}}
  <table class="list">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>#</th>
        <th>#</th>
      </tr>
    </thead>
    <tbody>
    @foreach($customers as $customer)
      <tr> 
        <td> {{$customer->id}} </td>  
        <td> {{$customer->name}} </td>  
        <td> <a href="/customers/edit/{{$customer->id}}"> Editar </a></td>  
        <td>
           <form action="/customers/delet/{{$customer->id}}" method="POST" class="form-delet"> 
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