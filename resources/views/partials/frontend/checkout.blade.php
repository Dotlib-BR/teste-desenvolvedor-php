@include('partials.frontend.header-unico')
@if(!is_null(Cart::count()))
@php
$contador = Cart::count();
@endphp
@if($contador > 0)

 
         
    @include('partials.frontend.checkout.card')
   
@else
<section class="text-gray-600 body-font">
  <div class="container px-5 py-24 mx-auto">
    <div class="lg:w-2/3 flex flex-col sm:flex-row sm:items-center items-start mx-auto">
      <h1 class="flex-grow sm:pr-16 text-2xl font-medium title-font text-gray-900">Adicione Produtos para efetuar pagamento no Checkout</h1>
      <a href="{{route('index')}}" class="flex-shrink-0 text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg mt-10 sm:mt-0">Ir para Loja</a>
    </div>
  </div>
</section>
@endif
@endif