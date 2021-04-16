@extends('layouts.dashboard')
@section('content')
<!-- component -->
@php $pedidos = \App\Models\Pedido::where('user_id',$usuario->id)->get();
      @endphp
<main class="grid place-items-center min-h-full bg-gray-100">
  <section class="flex flex-col my-10 md:flex-row gap-11 py-10 px-5 bg-white rounded-md shadow-lg w-3/4 md:max-w-2xl my-3">
    <div class="text-indigo-500 flex flex-col justify-between">
 
      <img class="inline object-cover w-32 h-32 mr-2 rounded-full" src="{{is_null($usuario->profile_photo_path) ? $fotoGenerica : url('storage/'.$usuario->profile_photo_path) }}" alt="" />
    
      <div>
        <small class="uppercase text-black">Status do Usuário</small>
      <div class="flex flex-wrap md:flex-nowrap gap-1">
      <span class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-gray-100 {{ $usuario->id >0 ? 'bg-green-700' : 'bg-red-700'}} rounded">{{ $usuario->id > 0  ? 'Usuário Habilitado Para Compras' : 'Usuário Bloqueado'}}</span>
     
      </div>
      </div>
      <div>
        <small class="uppercase text-black">Compras Efetuadas</small>
      <div class="flex flex-wrap md:flex-nowrap gap-1">
      <small class="text-5xl">@if($pedidos) {{count($pedidos)}}@endif</small>
     
      </div>
      </div>
      <div>
        <small class="uppercase text-black"><b>Total  Gasto</b></small>
      <div class="flex flex-wrap md:flex-nowrap gap-1">
      <small>
      
      @if($pedidos)
      R${{$pedidos->sum('valor_total_pedido')}}
      @else
      R$ 0
      @endif

      </small>
     
      </div>
      </div>
      <div>
        <small class="uppercase text-black"><b>Cliente  Criado Em</b></small>
      <div class="flex flex-wrap md:flex-nowrap gap-1">
      <small>{{$usuario->created_at}}</small>
     
      </div>
      </div>
      <div>
        <small class="uppercase text-black"><b>Última Atualização do cliente em:</b></small>
      <div class="flex flex-wrap md:flex-nowrap gap-1">
      <small>{{$usuario->updated_at}}</small>
     
      </div>
      </div>
    </div>
    <div class="text-indigo-500">
      <small class="uppercase">TIPO DE USUÁRIO: {{ $usuario->utype ==='USR' ? 'CLIENTE' : 'CLIENTE E ADMINISTRADOR DO SISTEMA' }}</small>
      <h3 class="uppercase text-black text-2xl font-medium">{{$usuario->name}}</h3>
     
      <small class="text-black"><b>EMAIL: </b>{{$usuario->email}}</small><br/>
      <small class="text-black"><b>EMAIL VERIFICADO?: </b> <span class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-gray-100 {{ is_null($usuario->email_verified_at) ? 'bg-red-700' : 'bg-gree-700'}} rounded">{{ is_null($usuario->email_verified_at) ? 'Email Não Verificado' : 'Email Verificado'}}</span>
     </small><br/><br/><br/>
     
     <button class="modal-open bg-transparent border border-gray-500 hover:border-indigo-500 text-gray-500 hover:text-indigo-500 font-bold py-2 px-4 rounded-full">Histórico de Compras</button>
  
     @include('admin.modal.historico')
      <div class="flex gap-0.5 mt-4">
        <a href="{{ route('interno.clientes.edit', $usuario->id) }}" id="x" class="bg-indigo-600 hover:bg-indigo-500 focus:outline-none transition text-white uppercase px-8 py-3">Editar Cliente</a>
        <a href="{{ route('interno.clientes.index') }}" id="xx" class="bg-red-600 hover:bg-red-500 focus:outline-none transition text-white uppercase p-3">
         Listar CLientes
        </a>
      </div>
    </div>
  </section>
</main>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    const likeButton = document.querySelector("#likeButton");
    const addToCartButton = document.querySelector("#addToCartButton");
    likeButton.addEventListener("click", ()=>{
        likeButton.classList.toggle("text-red-400")
    })
    addToCartButton.addEventListener("click", ()=>{
      const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})

Toast.fire({
  icon: 'success',
  title: 'Added to cart'
})
    })

</script>
@endsection