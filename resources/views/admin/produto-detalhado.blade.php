@extends('layouts.dashboard')
@section('content')
<!-- component -->
<main class="grid place-items-center h-full bg-gray-100 dark:border-primary-darker dark:bg-darker h-full">
  <section class="flex flex-col md:flex-row gap-11 py-10 px-5 bg-white rounded-md shadow-lg w-3/4 md:max-w-2xl my-3">
    <div class="text-indigo-500 flex flex-col justify-between">
      <img src="{{asset('imagens/fake_produtos')}}/{{$produto->imagem}}" alt="" />
      <div>
        <small class="uppercase text-black">Disponibilidade do Produto</small>
      <div class="flex flex-wrap md:flex-nowrap gap-1">
      <span class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-gray-100 {{ $produto->status_estoque === 'disponivel' ? 'bg-green-700' : 'bg-red-700'}} rounded">{{ $produto->status_estoque === 'disponivel' ? 'Produto Disponivel Para Venda' : 'Produto Indisponivel Para Venda'}}</span>
     
      </div>
      </div>
      <div>
        <small class="uppercase text-black">Quantidade em Estoque</small>
      <div class="flex flex-wrap md:flex-nowrap gap-1">
      <small class="text-5xl">{{$produto->quantidade_estoque}}</small>
     
      </div>
      </div>
      <div>
        <small class="uppercase text-black"><b>SKU</b></small>
      <div class="flex flex-wrap md:flex-nowrap gap-1">
      <small>{{$produto->sku}}</small>
     
      </div>
      </div>
      <div>
        <small class="uppercase text-black"><b>Produto Criado Em</b></small>
      <div class="flex flex-wrap md:flex-nowrap gap-1">
      <small>{{$produto->created_at}}</small>
     
      </div>
      </div>
      <div>
        <small class="uppercase text-black"><b>Última Atualização do Produto em:</b></small>
      <div class="flex flex-wrap md:flex-nowrap gap-1">
      <small>{{$produto->updated_at}}</small>
     
      </div>
      </div>
    </div>
    <div class="text-indigo-500">
      <small class="uppercase">CATEGORIA: {{ $produto->categoria ? Str::upper($produto->categoria->name) : 'PRODUTO SEM CATEGORIA' }}</small>
      <h3 class="uppercase text-black text-2xl font-medium">{{$produto->nome_produto}}</h3>
      <small class="uppercase  text-black ">Preço de Venda:</small><br/><span class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-gray-100 @if(!is_null($produto->preco_promocional) && $produto->preco_promocional != $produto->valor_unitario){{ $produto->preco_promocional < $produto->valor_unitario ? 'bg-green-700' : 'bg-red-700'}} @else bg-blue-700 @endif rounded">@if(!is_null($produto->preco_promocional) && $produto->preco_promocional != $produto->valor_unitario) {{ $produto->preco_promocional < $produto->valor_unitario ? 'Preço Promocional' : 'Preço com taxas aplicadas'}} @else Valor Unitário Inserido @endif</span><h3 class="text-2xl font-semibold mb-7">R$: {{ $produto->preco_promocional ? $produto->preco_promocional : $produto->valor_unitario }}</h3>
      <small class="uppercase  text-black ">Valor Unitário:</small><h3 class="text-2xl font-semibold mb-7">R$:{{$produto->valor_unitario}}</h3>
     
      <small class="text-black"><b>DESCRIÇÃO DO PRODUTO: </b>{{$produto->descricao}}</small><br/>
      <small class="text-black"><b>PRODUTO DESTACADO: </b> <span class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-gray-100 {{ $produto->destaque === 1 ? 'bg-green-700' : 'bg-red-700'}} rounded">{{ $produto->destaque === 1 ? 'Produto Destacado' : 'Produto Não Destacado'}}</span>
     </small><br/>
     <small class="text-black"><b>Código de Barras por Extenso: </b>{{$produto->cod_barras}}<br/></small>
     <small class="text-black"><b>Código de Barras C39+: </b><br/> @php echo DNS1D::getBarcodeHTML($produto->cod_barras, 'C39+'); @endphp</small><br/>
   
     <button class="modal-open bg-transparent border border-gray-500 hover:border-indigo-500 text-gray-500 hover:text-indigo-500 font-bold py-2 px-4 rounded-full">Ver + Códigos de barras para este produto</button>
  
     @include('admin.modal.codigo-barras')
      <div class="flex gap-0.5 mt-4">
        <a href="{{ route('produtos.edit', $produto->id) }}" id="x" class="bg-indigo-600 hover:bg-indigo-500 focus:outline-none transition text-white uppercase px-8 py-3">Editar Produto</a>
        <a href="{{ route('produtos.index') }}" id="xx" class="bg-red-600 hover:bg-red-500 focus:outline-none transition text-white uppercase p-3">
         Listar Produtos
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