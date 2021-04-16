
@if(!is_null($carrinho))
@if(!is_null(Cart::content()))
@php
$contador = Cart::count();
$taxa = Cart::tax();
@endphp
@if($contador > 0)
<div >
<table  class="w-full text-sm lg:text-base" cellspacing="0">
        <thead>
          <tr class="h-12 uppercase">
            <th class="hidden md:table-cell"></th>
            <th class="text-left">Produto</th>
            <th class="lg:text-right text-left pl-5 lg:pl-0">
              <span class="lg:hidden" title="Quantidade">Qtd</span>
              <span class="hidden lg:inline">Quantidade</span>
            </th>
            <th class="hidden text-right md:table-cell">Valor Unitário</th>
            <th class="hidden text-right md:table-cell">Total</th>
            
          </tr>
        </thead>
        <tbody>
        @foreach(Cart::content() as $produto)
        
          <tr>
            <td class="hidden pb-4 md:table-cell">
              <a href="#">
                <img src="{{asset('imagens/fake_produtos')}}/{{$produto->options->size}}" class="w-20 rounded" alt="Thumbnail">
              </a>
            </td>
            <td>
              <a href="#">
                <p class="mb-2 md:ml-4">{{$produto->name}}</p>
                </a>
                @php
                    $identificador = (int)$produto->id;
                @endphp
                  <button type="submit" wire:click="removerDoCarrinho({{$identificador}})" class="text-gray-700 md:ml-4">
                    <small>(Remover item)</small>
                  </button>
              
             
            </td>
            <td class="justify-center md:justify-end md:flex mt-6">
              <div class="w-20 h-10">
              <div class="relative flex flex-row w-full h-8">
             
                <button id="diminui{{$produto->id}}" class="bg-gray-300 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-20 rounded-l cursor-pointer outline-none">
      <span class="m-auto text-2xl font-thin">−</span>
    </button>
    @php 
               $iddd = strval($produto->id);
              
              @endphp
              
    <input id="ocultoQtd{{$produto->id}}" type="hidden" wire:model="identificador2" >
      <input type="number"  id="qtdcart{{$produto->id}}" value="{{$produto->qty}}" 
                  class="w-full font-semibold text-center text-gray-700 bg-gray-200 outline-none focus:outline-none hover:text-black focus:text-black" min="1" disabled />
                  <button id="aumenta{{$produto->id}}"   class="bg-gray-300 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-20 rounded-r cursor-pointer">
    <span class="m-auto text-2xl font-thin">+</span>
  </button>
 
<!--   Objetivo do Script abaixo: Aumentar/Diminuir quantidade do produto e setar 
  o valor do input em um novo input hidden onde o wire:model é chamado.  -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous"></script>
  <script>
  $( document ).ready(function() {
     var produtoIDD = <?php echo json_encode($produto->id); ?>;
  var inputVisivel = "qtdcart"+produtoIDD;
  var diminui = "diminui"+produtoIDD;
  var disparaEvento = "disparaEvento"+produtoIDD;
  var aumenta = "aumenta"+produtoIDD;
  var ocultoQtd = "ocultoQtd"+produtoIDD;
  var ocultoQtd2 = 'ocultoQtd'+produtoIDD;
  
  $('#'+diminui).click(function(){
          var valor = $('#'+inputVisivel).val();
          
          if(valor ==1){
              //se valor do input é um, nao será mais diminuido.
            $('#'+inputVisivel).val(valor);
           }else{
               //caso contrário, diminuia um
            $('#'+inputVisivel).val(--valor);
           }
          //pega  o valor novamente do input
	      var valor2 = $('#'+inputVisivel).val();
          //insere no input tipo hidden, onde o wire:model está setado
          //foi preciso essa gambi pke não é possivel deixar um valor default setado no input
          // o livewire automaticamente apaga o valor, pois a variavel da quantidade do produto não está 
          //vindo diretamente do componente. 
          $('#'+ocultoQtd).val(valor2);
          //o wire:model só aceita valores quando o input é atualizado manualmente,
          //caso contrário retornará sempre null. Para contornar, o trecho abaixo 
          //dipara uma atualização do input, fazendo o wire:model pensar que ocorreu uma 
          //digitacao manual
          var element = document.getElementById(ocultoQtd2);
          element.dispatchEvent(new Event('input'));
          //fim do trecho
          //Um temporizador para retardar a chamada da função para o livewire e
          // dar tempo dos valores serem setados no hidden input
          setTimeout(function() { 
            $('#'+disparaEvento).click();
    }, 1000);
	    });
        //Mesmo Procedimento acima 
	    $('#'+aumenta).click(function(){
           
          var valor = $('#'+inputVisivel).val();
          $('#'+inputVisivel).val(++valor);
          var valor2 = $('#'+inputVisivel).val();
          $('#'+ocultoQtd).val(valor2);
          var element = document.getElementById(ocultoQtd2);
          element.dispatchEvent(new Event('input'));
          setTimeout(function() { 
            $('#'+disparaEvento).click();
    }, 1000);
	    });



});

   
 
  </script>
                </div>
                <div wire:loading wire:target="atualizaProdutoQtdSubt">
       Reajustando o carrinho...
    </div>
                <button id="disparaEvento{{$produto->id}}" wire:click="atualizaProdutoQtdSubt({{$identificador}})" style="display:none;" ></button>
               
              </div>
            </td>
            
            <td class="hidden text-right md:table-cell">
              <span class="text-sm lg:text-base font-medium">
             R$: {{$produto->price}}
              </span>
            </td>
            <td class="hidden text-right md:table-cell">
              <span class="text-sm lg:text-base font-medium">
              @php 
               $idProd2 = strval($produto->id);
               $idz = strval($produto->id);
               $rows  = Cart::content();
               $objProduto = $rows->where('id', $idProd2)->first();
               $total = $objProduto->price * $objProduto->qty;
              @endphp
              {{$produto->price}} x @if(is_null($qtd[$idz])|| $qtd[$idz] < 1) {{$produto->qty}} @else  @php echo $qtd[$produto->id]; @endphp  @endif = R$ @if(is_null($somaProduto[$produto->id]) || $somaProduto[$produto->id] < 1 ) {{$total}} @else  @php echo $somaProduto[$produto->id]; @endphp @endif 
              </span>
            </td>
          </tr> 
        @endforeach
        </tbody>
      </table>
      
      <div  class="my-4 mt-6 -mx-2 lg:flex">
      @php
$contador = Cart::count();
$taxa = Cart::tax();
@endphp
@if($contador > 0)
      <div class="lg:px-2 lg:w-1/2">
          <div class="p-4 bg-gray-100 rounded-full">
            <h1 class="ml-2 font-bold uppercase">Cupom Promocional</h1>
          </div>
          <div class="p-4">
            <p class="mb-4 italic">Caso você possua um código de cupom, por favor insira no campo abaixo</p>
            <div class="justify-center md:flex">
       
                  <div class="flex items-center w-full h-13 pl-3 bg-white bg-gray-100 border rounded-full">
                    <input type="coupon" name="code" id="coupon" wire:model="cupomInput" placeholder="Aplicar  Cupom"
                            class="w-full bg-gray-100 outline-none appearance-none focus:outline-none active:outline-none"/>
                            @if (Auth::check())
                      <button type="buttom"  wire:click="aplicarCupom"  class="text-sm flex items-center px-3 py-1 text-white bg-gray-800 rounded-full outline-none md:px-4 hover:bg-gray-700 focus:outline-none active:outline-none">
                        <svg aria-hidden="true" data-prefix="fas" data-icon="gift" class="w-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M32 448c0 17.7 14.3 32 32 32h160V320H32v128zm256 32h160c17.7 0 32-14.3 32-32V320H288v160zm192-320h-42.1c6.2-12.1 10.1-25.5 10.1-40 0-48.5-39.5-88-88-88-41.6 0-68.5 21.3-103 68.3-34.5-47-61.4-68.3-103-68.3-48.5 0-88 39.5-88 88 0 14.5 3.8 27.9 10.1 40H32c-17.7 0-32 14.3-32 32v80c0 8.8 7.2 16 16 16h480c8.8 0 16-7.2 16-16v-80c0-17.7-14.3-32-32-32zm-326.1 0c-22.1 0-40-17.9-40-40s17.9-40 40-40c19.9 0 34.6 3.3 86.1 80h-86.1zm206.1 0h-86.1c51.4-76.5 65.7-80 86.1-80 22.1 0 40 17.9 40 40s-17.9 40-40 40z"/></svg>
                        <span class="font-medium">Aplicar cupom</span>
                      </button>
                      @else
                      <button type="buttom"  wire:click="aplicarCupomCheck(1)"  class="text-sm flex items-center px-3 py-1 text-white bg-gray-800 rounded-full outline-none md:px-4 hover:bg-gray-700 focus:outline-none active:outline-none">
                        <svg aria-hidden="true" data-prefix="fas" data-icon="gift" class="w-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M32 448c0 17.7 14.3 32 32 32h160V320H32v128zm256 32h160c17.7 0 32-14.3 32-32V320H288v160zm192-320h-42.1c6.2-12.1 10.1-25.5 10.1-40 0-48.5-39.5-88-88-88-41.6 0-68.5 21.3-103 68.3-34.5-47-61.4-68.3-103-68.3-48.5 0-88 39.5-88 88 0 14.5 3.8 27.9 10.1 40H32c-17.7 0-32 14.3-32 32v80c0 8.8 7.2 16 16 16h480c8.8 0 16-7.2 16-16v-80c0-17.7-14.3-32-32-32zm-326.1 0c-22.1 0-40-17.9-40-40s17.9-40 40-40c19.9 0 34.6 3.3 86.1 80h-86.1zm206.1 0h-86.1c51.4-76.5 65.7-80 86.1-80 22.1 0 40 17.9 40 40s-17.9 40-40 40z"/></svg>
                        <span class="font-medium">Aplicar cupom</span>
                      </button>
                      <div wire:loading wire:target="aplicarCupomCheck(1)">
      Calculando Cupom...
    </div>
                      @endif 
                    
                      <div wire:loading wire:target="aplicarCupom">
      Calculando Cupom...
    </div>
    <div>
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        @if (session()->has('error'))
            <div class="alert alert-success">
                {{ session('error') }}
            </div>
        @endif
    </div>
                  </div>
             
            </div>
            @if($cupomLogado ===1)
                      <div class="bg-blue-100 border-t border-b border-blue-500 text-blue-700 px-4 py-3" role="alert">
  <p class="font-bold">Importante</p>
  <p class="text-sm">Para aplicar o cupom de desconto, por favor, realize o login.</p>
</div>
@endif
          </div>
          <div class="p-4 mt-6 bg-gray-100 rounded-full">
            <h1 class="ml-2 font-bold uppercase">Instrução ao vendedor</h1>
          </div>
          <div class="p-4">
            <p class="mb-4 italic">Caso você possua alguma informação adicional a acrescentar, por favor, deixe sua mensagem no campo abaixo</p>
            <textarea wire:model="nota_vendedor" class="w-full h-24 p-2 bg-gray-100 rounded"></textarea>
          </div>
        </div>
     
        @endif
        <hr class="pb-6 mt-6">
      
      @include('livewire.detalhes-pedido-carrinho2')
      @else
      <h1>Carrinho Vazio</h1>
      @endif
     @else
     <h1>Carrinho Vazio</h1>
      @endif @endif