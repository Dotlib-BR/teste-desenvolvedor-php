@extends("home")
@section("container")
<link rel="stylesheet" href="{{ asset('css/customers.css') }}">


  {{-- MENU --}}
<div class="menu">
  <h3>CLIENTES:</h3>
  <a href="/add" class="buttom-add">
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
        <td> <a href="/edit/{{$customer->id}}"> Editar </a></td>  
        <td> <a href="/customers/{{$customer->id}}"> Deletar </a> </td>  
      </tr>
      @endforeach
    </tbody>

  </table>




@endsection