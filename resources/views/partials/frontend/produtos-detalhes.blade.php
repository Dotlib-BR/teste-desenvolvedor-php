<section class="text-gray-600 body-font overflow-hidden">
  <div class="container px-5 py-24 mx-auto">
    <div class="lg:w-4/5 mx-auto flex flex-wrap">
      <img alt="ecommerce" class="lg:w-1/2 w-full lg:h-auto h-64 object-cover object-center rounded" src="{{asset('imagens/fake_produtos')}}/{{$produto->imagem}}">
      <div class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
        <h2 class="text-sm title-font text-gray-500 tracking-widest">{{ $produto->categoria ? Str::upper($produto->categoria->name) : '' }}</h2>
        <h1 class="text-gray-900 text-3xl title-font font-medium mb-1">{{$produto->nome_produto}}</h1>
        
        <p class="leading-relaxed">{{$produto->descricao}}</p>
        <div class="flex mt-6 items-center pb-5 border-b-2 border-gray-100 mb-5">
          
        </div>
        <div class="flex">
          <span class="title-font font-medium text-2xl text-gray-900">R$:{{ $produto->preco_promocional ? $produto->preco_promocional : $produto->valor_unitario }}</span>
        @php
        $iyz = $produto->id;
        @endphp
          @livewire('add-carrinho',['id' => $iyz])
          <button class="rounded-full w-10 h-10 bg-gray-200 p-0 border-0 inline-flex items-center justify-center text-gray-500 ml-4">
            <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
              <path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"></path>
            </svg>
          </button>
        </div>
      </div>
    </div>
  </div>
</section>