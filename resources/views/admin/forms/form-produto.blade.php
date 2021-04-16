@extends('layouts.dashboard')
@section('content')

<form @if(isset($produto)) action="{{route('produtos.update',$produto->id)}}" @else  action="{{route('produtos.store')}}" @endif  method="POST" enctype="multipart/form-data">
@if(isset($produto))
            @method('PATCH') 
            @else 
            @method('POST')
            @endif   
           
<div class="min-h-screen bg-gray-100 py-6 flex flex-col justify-center sm:py-12 dark:border-primary-darker dark:bg-darker h-full">
  <div class="relative py-3 sm:max-w-xl sm:mx-auto">
    <div class="relative px-4 py-10 bg-white mx-8 md:mx-0 shadow rounded-3xl sm:p-10">
      <div class="max-w-md mx-auto">
        <div class="flex items-center space-x-5">
         
          <div class="block  font-semibold text-xl self-start text-gray-700">
            <h2 class="leading-relaxed">{{isset($produto) ? 'Editar produto SKU: '.$produto->sku: 'Criar um novo Produto' }}</h2>
            <p class="text-sm text-gray-500 font-normal leading-relaxed"> {{isset($produto) ? 'Altere os dados abaixo para editar seu produto' : 'Preencha os dados abaixo para criar seu produto' }} </p>
            @if($errors->any())
    {{ implode('', $errors->all('<div>:message</div>')) }}
@endif
          </div>
        </div>
        <div class="divide-y divide-gray-200">
          <div class="py-8 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7">
            <div class="flex flex-col">
              <label class="leading-loose">Nome do Produto</label>
              {!! csrf_field() !!}
              <input type="hidden" name="seguro" value="@if(isset($produto)){{$encryptado}}@endif">
              <input type="text" name="nome_produto" id="nome_produto" class="@error('nome_produto') border-red-600 @enderror px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600" value="{{isset($produto) ? $produto->nome_produto: '' }}" placeholder="Nome do Produto" required>
              @error('nome_produto')
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">

  <span class="block sm:inline">{{ $message }}</span>
  
</div>
   
@enderror
            </div>
            
            <div class="flex flex-col">
              <label class="leading-loose">Slug</label>
              <input type="text" id="slug_input" name="slug" class="@error('slug') border-red-600 @enderror px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600" placeholder="Slug para url do produto" value="{{isset($produto) ? $produto->slug: '' }}" required>
              @error('slug')
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">

  <span class="block sm:inline">{{ $message }}</span>
  
</div>
   
@enderror
            </div>

            <div class="flex flex-col">
              <label class="leading-loose">Descrição</label>
              <textarea name="descricao" class="@error('descricao') border-red-600 @enderror resize border rounded-md" required>{{isset($produto) ? $produto->descricao: '' }}</textarea>
             @error('descricao')
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">

  <span class="block sm:inline">{{ $message }}</span>
  
</div>
   
@enderror
            </div>
            
            <div class="flex items-center bg-white shadow  rounded mt-6 px-2 mx-8" style="width: 24rem;">
                <div class="mr-6 bg-blue-500 rounded px-4 py-2 text-center -ml-3">
                    <svg fill="none" viewBox="0 0 24 24" class="w-8 h-8 text-white" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
             
                <div class="flex items-center rounded-lg rounded-l-none py-2">
                    <h2 class="text-blue-600 text-lg font-bold mr-2 ">Info</h2>
                    <p class="text-sm text-gray-700">Imagens padronizadas geram mais impacto visual para o cliente. <u><a target="_blank" href="https://colab.research.google.com/drive/1GJlbVxjdKVbRIojPBn3-EUWI0aou53DA?usp=sharing">Clique aqui para automaticamente remover o background do seu produto e substituir por uma cor padronizada</a></u></p>
                </div>
            
            </div>
           
            <div class="mb-2 text-gray-700"> <span>Imagem do Produto </span>
                        <div class="relative h-40 rounded-lg border-dashed border-2 border-gray-200 bg-white flex justify-center items-center hover:cursor-pointer">
                            <div class="absolute">
                                <div class="flex flex-col items-center "> <i class="fa fa-cloud-upload fa-3x text-gray-200"></i> <span class="block text-gray-400 font-normal">Arraste sua imagem para cá</span> <span class="block text-gray-400 font-normal">ou</span> <span class="block text-blue-400 font-normal">Selecionar  arquivo</span> </div>
                            </div> <input type="file" id="imagem" name="imagem" class="h-full w-full opacity-0" >
                        </div>
                        <div class="flex justify-between items-center text-gray-400"> <span>Tipos de imagem aceita:.png, .jpg, .gif</span> <span class="flex items-center "><i class="fa fa-lock mr-1"></i> </span>
                         </div>
                        <div id="bloco_upload" style="display:none;">
                        <h1 id="txt_carrega">Carregando...</h1>
                        <div class="h-3 relative max-w-xl rounded-full overflow-hidden">
        <div class="w-full h-full bg-gray-200 absolute"></div>
        <div id="bar" class="transition-all ease-out duration-1000 h-full bg-green-500 relative w-0"></div>
    </div>
</div>
                    </div>
                    <div class="flex flex-col">
                    <label class="flex justify-start items-start">
  <div class="bg-white border-2 rounded border-gray-400 w-6 h-6 flex flex-shrink-0 justify-center items-center mr-2 focus-within:border-blue-500">
    <input type="checkbox" name="destaque" id="chk" class="opacity-0 absolute" @if(isset($produto)) @if($produto->destaque ===1) value="1" checked @else value="0" @endif @endif>
    <svg class="fill-current hidden w-4 h-4 text-green-500 pointer-events-none" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg>
  </div>
  <div class="select-none">Destacar Produto?</div>
</label>
@error('destaque')
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">

  <span class="block sm:inline">{{ $message }}</span>
  
</div>
   
@enderror
                    </div>

            <div class="flex items-center space-x-4">
              <div class="flex flex-col">
                <label class="leading-loose">Valor Unitário</label>
                <div class="relative focus-within:text-gray-600 text-gray-400">
                  <input type="number" step="0.01" min="0" name="valor_unitario" class="@error('valor_unitario') border-red-600 @enderror pr-4 pl-10 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600" placeholder="123,33" value="{{isset($produto) ? $produto->valor_unitario : '' }}" required>
                  <div class="absolute left-3 top-2">
                  <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
  <path fillRule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clipRule="evenodd" />
</svg>
                   </div>
                   @error('valor_unitario')
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">

  <span class="block sm:inline">{{ $message }}</span>
  
</div>
   
@enderror
                </div>
              </div>
              <div class="flex flex-col">
                <label class="leading-loose">Preço Promocional/Taxado</label>
               
                <div class="relative focus-within:text-gray-600 text-gray-400">
                  <input type="number" step="0.01" min="0" name="preco_promocional" class="@error('preco_promocional') border-red-600 @enderror pr-4 pl-10 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600" value="@php if(isset($produto)){if(isset($produto->preco_promocional)){ echo $produto->preco_promocional;} } @endphp" placeholder="Opcional" >
                  <div class="absolute left-3 top-2">
                  <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
  <path fillRule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clipRule="evenodd" />
</svg>
                   </div>
                   @error('preco_promocional')
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">

  <span class="block sm:inline">{{ $message }}</span>
  
</div>
   
@enderror
                </div>
              </div>
            </div>
            @php
              $categorias = App\Models\Categoria::all();
            @endphp
            @if(isset($categorias))
            <div class="flex flex-col">
              <label class="leading-loose">Categoria</label>
                  <select name="categoria" class="w-full border bg-white rounded px-3 py-2 outline-none">
                  
                  @foreach($categorias as $categoria)
                      <option value="{{$categoria->id}}" class="py-1" @if(isset($produto)) @if(isset($produto->categoria)) @if($produto->categoria->id ===$categoria->id) selected @endif @endif @endif >{{$categoria->name}}</option>
                  @endforeach
                  </select>
               </div>
            @endif
                <div class="flex items-center space-x-4">
              <div class="flex flex-col">
                <label class="leading-loose">SKU</label>
                <div class="relative focus-within:text-gray-600 text-gray-400">
                  <input type="text" name="sku" class="@error('sku') border-red-600 @enderror  pr-4 pl-10 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600" placeholder="BR_123-000" value="{{isset($produto) ? $produto->sku: '' }}" required>
                  <div class="absolute left-3 top-2">
               
<svg  class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
  <path fillRule="evenodd" d="M18 8a6 6 0 01-7.743 5.743L10 14l-1 1-1 1H6v2H2v-4l4.257-4.257A6 6 0 1118 8zm-6-4a1 1 0 100 2 2 2 0 012 2 1 1 0 102 0 4 4 0 00-4-4z" clipRule="evenodd" />
</svg>
                   </div>
                   @error('sku')
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">

  <span class="block sm:inline">{{ $message }}</span>
  
</div>
   
@enderror
                </div>
              </div>
              <div class="flex flex-col">
                <label class="leading-loose">Código de Barras / QRCODE</label>
               
                <div class="relative focus-within:text-gray-600 text-gray-400">
                  <input type="text" name="cod_barras" class="@error('cod_barras') border-red-600 @enderror pr-4 pl-10 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600" placeholder="1289BBBF0" value="{{isset($produto) ? $produto->cod_barras: '' }}" required> 
                  <div class="absolute left-3 top-2">
                 
<svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
  <path fillRule="evenodd" d="M3 4a1 1 0 011-1h3a1 1 0 011 1v3a1 1 0 01-1 1H4a1 1 0 01-1-1V4zm2 2V5h1v1H5zM3 13a1 1 0 011-1h3a1 1 0 011 1v3a1 1 0 01-1 1H4a1 1 0 01-1-1v-3zm2 2v-1h1v1H5zM13 3a1 1 0 00-1 1v3a1 1 0 001 1h3a1 1 0 001-1V4a1 1 0 00-1-1h-3zm1 2v1h1V5h-1z" clipRule="evenodd" />
  <path d="M11 4a1 1 0 10-2 0v1a1 1 0 002 0V4zM10 7a1 1 0 011 1v1h2a1 1 0 110 2h-3a1 1 0 01-1-1V8a1 1 0 011-1zM16 9a1 1 0 100 2 1 1 0 000-2zM9 13a1 1 0 011-1h1a1 1 0 110 2v2a1 1 0 11-2 0v-3zM7 11a1 1 0 100-2H4a1 1 0 100 2h3zM17 13a1 1 0 01-1 1h-2a1 1 0 110-2h2a1 1 0 011 1zM16 17a1 1 0 100-2h-3a1 1 0 100 2h3z" />
</svg>
                   </div>
                   @error('cod_barras')
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">

  <span class="block sm:inline">{{ $message }}</span>
  
</div>
   
@enderror
                </div>
              </div>
            </div> 
            <div class="flex flex-col">
              <label class="leading-loose">Estoque Disponível para vendas?</label>
              <select name="status_estoque" class="w-full border bg-white rounded px-3 py-2 outline-none">
          
    <option class="py-1" @if(isset($produto)) @if($produto->status_estoque ==='disponivel') selected="selected" @endif @endif>disponivel</option>
    <option class="py-1"@if(isset($produto)) @if($produto->status_estoque ==='indisponivel') selected="selected" @endif @endif>indisponivel</option>
</select>
@error('status_estoque')
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">

  <span class="block sm:inline">{{ $message }}</span>
  
</div>
   
@enderror
              </div> 
              <div class="flex flex-col">
              <label class="leading-loose">Quantidade em Estoque</label>
              <input type="number" step="0"  min="{{isset($produto) ? 0 : 1 }}" name="quantidade_estoque" class="@error('quantidade_estoque') border-red-600 @enderror px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600" placeholder="20" value="{{isset($produto) ? $produto->quantidade_estoque: '' }}" required>
              @error('quantidade_estoque')
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">

  <span class="block sm:inline">{{ $message }}</span>
  
</div>
   
@enderror
            </div> 
          </div>
          <div class="pt-4 flex items-center space-x-4">
              
              <button type="submit" class="bg-blue-500 flex justify-center items-center w-full text-white px-4 py-3 rounded-md focus:outline-none">{{isset($produto) ? 'Editar Produto': 'Criar Produto' }}</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</form>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous"></script>
<script>

  $('#nome_produto').on('keyup',function(e) {
     var slug = $('#nome_produto').val();
     var txt = convertToSlug(slug);
     $('#slug_input').val(txt);
     
  });
  $('#slug_input').on('keyup',function(e) {
     var slug = $('#slug_input').val();
     var txt = convertToSlug(slug);
     $('#slug_input').val(txt);
     
  });
  function convertToSlug(Text)
{
    return Text
        .toLowerCase()
        .replace(/ /g,'-')
        .replace(/[^\w-]+/g,'')
        ;
}

$('#imagem').change(function() {
       var filename = $('input[type=file]').val().split('\\').pop();
       $('#bloco_upload').show();
        
        let progress = 0;
        let invervalSpeed = 10;
        let incrementSpeed = 1;
       let bar = document.getElementById('bar');
            progressInterval = setInterval(function(){
                progress += incrementSpeed;
                bar.style.width = progress + "%";
                if(progress >= 100){
                    clearInterval(progressInterval);
                    setTimeout(function() { 
                      $('#txt_carrega').text(filename);
    }, 1000);
                   
                }
            }, invervalSpeed);
      
    });
    
</script>
@include('notify::messages')
@endsection
