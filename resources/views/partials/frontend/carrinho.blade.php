@include('partials.frontend.header-unico')
@if(!is_null(Cart::count()))
@php
$contador = Cart::count();
@endphp
@if($contador > 0)
<div class="flex justify-center my-6">
  <div class="flex flex-col w-full p-8 text-gray-800 bg-white shadow-lg pin-r pin-y md:w-4/5 lg:w-4/5">
    <div class="flex-1">
   
         
    @livewire('carrinho-pagina')
   
    </div>
  </div>
</div>
@else
<section class="text-gray-600 body-font">
  <div class="container px-5 py-24 mx-auto">
    <div class="lg:w-2/3 flex flex-col sm:flex-row sm:items-center items-start mx-auto">
      <h1 class="flex-grow sm:pr-16 text-2xl font-medium title-font text-gray-900">O seu carrinho está Vazio. Adicione produtos em seu carrinho</h1>
      <a href="{{route('index')}}" class="flex-shrink-0 text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg mt-10 sm:mt-0">Ir para Loja</a>
    </div>
  </div>
</section>
@endif
@endif