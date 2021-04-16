


        <div  class="lg:px-2 lg:w-1/2">
        @php
$contador = Cart::count();
$descontos = Cart::discount();
$taxa = Cart::tax();
@endphp
@if($contador > 0)
      
          <div class="p-4 bg-gray-100 rounded-full">
            <h1 class="ml-2 font-bold uppercase">Detalhes do Pedido</h1>
          </div>
          <div class="p-4">
            <p class="mb-6 italic">Descontos e Taxas serão exibidos abaixo</p>
              <div class="flex justify-between border-b">
                <div class="lg:px-4 lg:py-2 m-2 text-lg lg:text-xl font-bold text-center text-gray-800">
                  Subtotal(@php echo Cart::count(); @endphp itens) 
                </div>
                <div class="lg:px-4 lg:py-2 m-2 lg:text-lg font-bold text-center text-gray-900">
                @if($descontos > 0)
                R$ @php echo Cart:: priceTotal(); @endphp
                @else
                R$ @php echo Cart::subtotal(); @endphp
                @endif
               
                </div>
              </div>
              @if($descontos > 0)
                <div class="flex justify-between pt-4 border-b" style="">
                  <div class="flex lg:px-4 lg:py-2 m-2 text-lg lg:text-xl font-bold text-gray-800">
                 
                      <button type="buttom" class="mr-2 mt-1 lg:mt-2">
                     
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 text-red-600 hover:text-red-800"  viewBox="0 0 20 20" fill="currentColor">
  <path d="M4 3a2 2 0 100 4h12a2 2 0 100-4H4z" />
  <path fill-rule="evenodd" d="M3 8h14v7a2 2 0 01-2 2H5a2 2 0 01-2-2V8zm5 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z" clip-rule="evenodd" />
</svg>
                      </button>
                
                    @if($descontex ===1)
                    Cupom "{{$cupomInput}}"
                    @else
                    Desconto
                    @endif
                  </div>
                  <div class="lg:px-4 lg:py-2 m-2 lg:text-lg font-bold text-center text-green-700">
                
                   R$ - @php echo Cart:: discount(); @endphp
                  
                  </div>
                </div>
                @endif
                @if($descontos >0)
                <div class="flex justify-between pt-4 border-b" >
                  <div class="lg:px-4 lg:py-2 m-2 text-lg lg:text-xl font-bold text-center text-gray-800">
                    Novo Subtotal
                  </div>
                  <div class="lg:px-4 lg:py-2 m-2 lg:text-lg font-bold text-center text-gray-900">
                 
                  R$ @php echo Cart::subtotal(); @endphp
                
                  </div>
                </div>
                @endif
                <div class="flex justify-between pt-4 border-b">
                  <div class="lg:px-4 lg:py-2 m-2 text-lg lg:text-xl font-bold text-center text-gray-800">
                    Taxa
                  </div>
                  <div class="lg:px-4 lg:py-2 m-2 lg:text-lg font-bold text-center text-gray-900">
                    R$ @if($taxa >0) {{$taxa}} @else 0 @endif
                  </div>
                </div>
                <div class="flex justify-between pt-4 border-b">
                  <div class="lg:px-4 lg:py-2 m-2 text-lg lg:text-xl font-bold text-center text-gray-800">
                    Total a pagar
                  </div>
                  <div class="lg:px-4 lg:py-2 m-2 lg:text-lg font-bold text-center text-gray-900">
                  R$ @php echo Cart::total(); @endphp
                  </div>
                </div>
                @if (Auth::check())
          
                <button id="modal_click" class="modal-open flex justify-center w-full px-10 py-3 mt-6 font-medium text-white uppercase bg-gray-800 rounded-full shadow item-center hover:bg-gray-700 focus:shadow-outline focus:outline-none">
                  <svg aria-hidden="true" data-prefix="far" data-icon="credit-card" class="w-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M527.9 32H48.1C21.5 32 0 53.5 0 80v352c0 26.5 21.5 48 48.1 48h479.8c26.6 0 48.1-21.5 48.1-48V80c0-26.5-21.5-48-48.1-48zM54.1 80h467.8c3.3 0 6 2.7 6 6v42H48.1V86c0-3.3 2.7-6 6-6zm467.8 352H54.1c-3.3 0-6-2.7-6-6V256h479.8v170c0 3.3-2.7 6-6 6zM192 332v40c0 6.6-5.4 12-12 12h-72c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h72c6.6 0 12 5.4 12 12zm192 0v40c0 6.6-5.4 12-12 12H236c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h136c6.6 0 12 5.4 12 12z"/></svg>
                  <span class="ml-2 mt-5px">Proceder para o checkout</span>
                </button>
              @include('partials.frontend.checkout.card')
            
              @else
            
                <button wire:click="aplicarCupomCheck(0)"  class="flex justify-center w-full px-10 py-3 mt-6 font-medium text-white uppercase bg-gray-800 rounded-full shadow item-center hover:bg-gray-700 focus:shadow-outline focus:outline-none">
                  <svg aria-hidden="true" data-prefix="far" data-icon="credit-card" class="w-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M527.9 32H48.1C21.5 32 0 53.5 0 80v352c0 26.5 21.5 48 48.1 48h479.8c26.6 0 48.1-21.5 48.1-48V80c0-26.5-21.5-48-48.1-48zM54.1 80h467.8c3.3 0 6 2.7 6 6v42H48.1V86c0-3.3 2.7-6 6-6zm467.8 352H54.1c-3.3 0-6-2.7-6-6V256h479.8v170c0 3.3-2.7 6-6 6zM192 332v40c0 6.6-5.4 12-12 12h-72c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h72c6.6 0 12 5.4 12 12zm192 0v40c0 6.6-5.4 12-12 12H236c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h136c6.6 0 12 5.4 12 12z"/></svg>
                  <span class="ml-2 mt-5px">Proceder para o checkout</span>
                </button>
                <div wire:loading wire:target="aplicarCupomCheck(0)">
      Verificando restrições...
    </div>
   
              @if($checkoutLogado ===1)
                      <div class="bg-blue-100 border-t border-b border-blue-500 text-blue-700 px-4 py-3" role="alert">
  <p class="font-bold">Importante</p>
  <p class="text-sm">Realize o login para ir para o checkout.</p>
</div>


@endif
              @endif
          </div>
          @endif
        </div>
        
      </div></div>