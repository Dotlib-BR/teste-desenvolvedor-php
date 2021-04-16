
  
  <!--Modal-->
  <div @if($refresh ===0) wire:ignore.self @endif class="modal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center">
    <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>
    
    <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
      
      <div class="modal-close absolute top-0 right-0 cursor-pointer flex flex-col items-center mt-4 mr-4 text-white text-sm z-50">
        <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
          <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
        </svg>
        <span class="text-sm">(Esc)</span>
      </div>

      <!-- Add margin if you want to see some of the overlay behind the modal-->
      <div class="modal-content py-4 text-left px-6">
        <!--Title-->
        <div class="flex justify-between items-center pb-3">
        <div class="mb-1">
            <h1 class="text-center font-bold text-xl uppercase">Pagamento Seguro</h1>
        </div>
          <div class="modal-close cursor-pointer z-50">
            <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
              <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
            </svg>
          </div>
        </div>

        <!--Body-->
        @if (Auth::check())
        @if(!is_null($carrinho))
@if(!is_null(Cart::content()))
@php
$contador = Cart::count();
$totalCompra = Cart::total();
@endphp
@if($contador > 0)
        <div class="min-w-screen bg-white flex items-center justify-center px-5 ">
    <div class="w-full mx-auto rounded-lg bg-white shadow-lg p-5 text-gray-700" style="max-width: 600px">
        
       
        <div class="mb-3 flex -mx-2">
            <div class="px-2">
                <label for="type1" class="flex items-center cursor-pointer">
                    <input type="radio" class="form-radio h-5 w-5 text-indigo-500" name="type" id="type1" checked>
                    <img src="https://leadershipmemphis.org/wp-content/uploads/2020/08/780370.png" class="h-8 ml-3">
                </label>
            </div>
           
        </div>
        <div class="mb-3">
            <label class="font-bold text-sm mb-2 ml-1">CPF do Cliente - Necessário para nota Fiscal</label>
            <div>
                <input type="number" name="cpf" wire:model="cpf" min="0" class="w-full px-3 py-2 mb-1 border-2 border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors" placeholder="00000000000" value="{{{ isset(Auth::user()->cpf) ? Auth::user()->cpf : '' }}}"  />
                @error('cpf') <span class="error">{{ $message }}</span> @enderror
            </div>
        </div>
        
        <div class="mb-3">
            <label class="font-bold text-sm mb-2 ml-1">Nome no Cartão</label>
            <div>
                <input wire:model="titular" class="w-full px-3 py-2 mb-1 border-2 border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors" placeholder="John Smith" type="text"/>
                @error('titular') <span class="error">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="mb-3">
            <label class="font-bold text-sm mb-2 ml-1">Número do Cartão</label>
            <div>
                <input wire:model="numero_cartao" class="w-full px-3 py-2 mb-1 border-2 border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors" placeholder="0000 0000 0000 0000" type="number"  min="0" />
                @error('numero_cartao') <span class="error">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="mb-3 -mx-2 flex items-end">
            <div class="px-2 w-1/2">
                <label class="font-bold text-sm mb-2 ml-1">Data da Expiração</label>
                <div>
                    <select wire:model="data_expiracao" class="form-select w-full px-3 py-2 mb-1 border-2 border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors cursor-pointer">
                        <option value="01" selected="{{(isset($data_expiracao)) ? 'selected' : ''}}">01 - Janeiro</option>
                        <option value="02">02 - Fevereiro</option>
                        <option value="03">03 - Março</option>
                        <option value="04">04 - Abril</option>
                        <option value="05">05 - Maio</option>
                        <option value="06">06 - Junho</option>
                        <option value="07">07 - Julho</option>
                        <option value="08">08 - Agosto</option>
                        <option value="09">09 - Setempro</option>
                        <option value="10">10 - Outubro</option>
                        <option value="11">11 - Novembro</option>
                        <option value="12">12 - Dezembro</option>
                    </select>
                    @error('data_expiracao') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="px-2 w-1/2">
                <select wire:model="data_expiracao_ano" class="form-select w-full px-3 py-2 mb-1 border-2 border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors cursor-pointer">
                    <option value="2021" selected="{{(isset($data_expiracao_ano)) ? 'selected' : ''}}">2021</option>
                    <option value="2022">2022</option>
                    <option value="2023">2023</option>
                    <option value="2024">2024</option>
                    <option value="2025">2025</option>
                    <option value="2026">2026</option>
                    <option value="2027">2027</option>
                    <option value="2028">2028</option>
                    <option value="2029">2029</option>
                    <option value="2030">2030</option>
                </select>
                @error('data_expiracao_ano') <span class="error">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="mb-1">
            <label class="font-bold text-sm mb-2 ml-1">Código de Segurança (CVC)</label>
            <div>
                <input wire:model="codigo_seguranca" class="w-32 px-3 py-2 mb-1 border-2 border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors" placeholder="000" type="text"/>
                @error('codigo_seguranca') <span class="error">{{ $message }}</span> @enderror
            </div>
        </div>
        <div>
            <button wire:click="checkout()" class="block w-full max-w-xs mx-auto bg-indigo-500 hover:bg-indigo-700 focus:bg-indigo-700 text-white rounded-lg px-3 py-3 font-semibold"><i class="mdi mdi-lock-outline mr-1"></i> PAGAR AGORA (R$: {{$totalCompra}})</button>
            <div wire:loading wire:target="checkout">
      processando pagamento...
    </div>
        </div>
      
    </div>
    @else
    <h1>Acesso Ilegal</h1>
    @endif
    @else
    <h1>Acesso Ilegal</h1>
    @endif
    @else
    <h1>Acesso Ilegal</h1>
    
    @endif
    @else
    <h1>Acesso Ilegal</h1>
    
    @endif
</div>


        <!--Footer-->
      
        
      </div>
    </div>
  </div>

  <script>
  window.onload = function(){
    var abrir = <?php echo json_encode($abrir); ?>;
    console.log("Estado Inicial: "+abrir);
    if(abrir >0){
        console.log("Estado Inicial 2: "+abrir);
        var button = document.getElementById('modal_click');
    button.click();
    } 
   
}
    var openmodal = document.querySelectorAll('.modal-open')
    for (var i = 0; i < openmodal.length; i++) {
      openmodal[i].addEventListener('click', function(event){
    	event.preventDefault()
    	toggleModal()
      })
    }
    
    const overlay = document.querySelector('.modal-overlay')
    overlay.addEventListener('click', toggleModal)
    
    var closemodal = document.querySelectorAll('.modal-close')
    for (var i = 0; i < closemodal.length; i++) {
      closemodal[i].addEventListener('click', toggleModal)
    }
    
    document.onkeydown = function(evt) {
      evt = evt || window.event
      var isEscape = false
      if ("key" in evt) {
    	isEscape = (evt.key === "Escape" || evt.key === "Esc")
      } else {
    	isEscape = (evt.keyCode === 27)
      }
      if (isEscape && document.body.classList.contains('modal-active')) {
    	toggleModal()
      }
    };
    
    
    function toggleModal () {
      const body = document.querySelector('body')
      const modal = document.querySelector('.modal')
      modal.classList.toggle('opacity-0')
      modal.classList.toggle('pointer-events-none')
      body.classList.toggle('modal-active')
    }
   
  </script>
   
 
