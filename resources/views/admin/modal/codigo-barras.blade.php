<!--Modal-->

<div class="modal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center">
  <div class="modal-overlay absolute w-full h-full bg-white opacity-95"></div>

  <div class="modal-container bg-white fixed w-full h-full z-50 overflow-y-auto ">
    
	<div class="modal-close absolute top-0 right-0 cursor-pointer flex flex-col items-center mt-4 mr-4 text-black text-sm z-50">
      <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
        <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
      </svg>
      (Esc)
    </div>

    <!-- Add margin if you want to see grey behind the modal-->
    <div class="modal-content container mx-auto h-auto text-left p-4">
     
	  <!--Title-->
      <div class="flex justify-between items-center pb-2">
        <p class="text-2xl font-bold">Código de barras para Impressão!</p>
      </div>

      <!--Body-->
      <section class="text-gray-600 body-font">
  <div class="container px-5 py-24 mx-auto flex flex-wrap">
    <div class="flex flex-wrap -m-4">
      <div class="p-4 lg:w-1/2 md:w-full">
        <div class="flex border-2 rounded-lg border-gray-200 border-opacity-50 p-8 sm:flex-row flex-col">
          
          <div class="flex-grow">
            <h2 class="text-gray-900 text-lg title-font font-medium mb-3">QRCODE</h2>
            <p class="leading-relaxed text-base"> @php echo DNS2D::getBarcodeHTML($produto->cod_barras, 'QRCODE'); @endphp</p>
            <a class="mt-3 text-indigo-500 inline-flex items-center">IMPRIMIR
              <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">
                <path d="M5 12h14M12 5l7 7-7 7"></path>
              </svg>
            </a>
          </div>
        </div>
      </div>

      <div class="p-4 lg:w-1/2 md:w-full">
        <div class="flex border-2 rounded-lg border-gray-200 border-opacity-50 p-8 sm:flex-row flex-col">
          
          <div class="flex-grow">
            <h2 class="text-gray-900 text-lg title-font font-medium mb-3">RMS4CC</h2>
            <p class="leading-relaxed text-base"> @php echo DNS1D::getBarcodeHTML($produto->cod_barras, 'RMS4CC'); @endphp</p>
            <a class="mt-3 text-indigo-500 inline-flex items-center">IMPRIMIR
              <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">
                <path d="M5 12h14M12 5l7 7-7 7"></path>
              </svg>
            </a>
          </div>
        </div>
      </div>

      <div class="p-4 lg:w-1/2 md:w-full">
        <div class="flex border-2 rounded-lg border-gray-200 border-opacity-50 p-8 sm:flex-row flex-col">
          
          <div class="flex-grow">
            <h2 class="text-gray-900 text-lg title-font font-medium mb-3">C39+</h2>
            <p class="leading-relaxed text-base"> @php echo DNS1D::getBarcodeHTML($produto->cod_barras, 'C39+'); @endphp</p>
            <a class="mt-3 text-indigo-500 inline-flex items-center">IMPRIMIR
              <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">
                <path d="M5 12h14M12 5l7 7-7 7"></path>
              </svg>
            </a>
          </div>
        </div>
      </div>

      <div class="p-4 lg:w-1/2 md:w-full">
        <div class="flex border-2 rounded-lg border-gray-200 border-opacity-50 p-8 sm:flex-row flex-col">
          
          <div class="flex-grow">
            <h2 class="text-gray-900 text-lg title-font font-medium mb-3">EAN13</h2>
            <p class="leading-relaxed text-base"> @php echo DNS1D::getBarcodeHTML($produto->cod_barras, 'EAN13'); @endphp</p>
            <a class="mt-3 text-indigo-500 inline-flex items-center">IMPRIMIR
              <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">
                <path d="M5 12h14M12 5l7 7-7 7"></path>
              </svg>
            </a>
          </div>
        </div>
      </div>

      <div class="p-4 lg:w-1/2 md:w-full">
        <div class="flex border-2 rounded-lg border-gray-200 border-opacity-50 p-8 sm:flex-row flex-col">
          
          <div class="flex-grow">
            <h2 class="text-gray-900 text-lg title-font font-medium mb-3">PHARMA</h2>
            <p class="leading-relaxed text-base"> @php echo DNS1D::getBarcodeHTML($produto->cod_barras, 'PHARMA'); @endphp</p>
            <a class="mt-3 text-indigo-500 inline-flex items-center">IMPRIMIR
              <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">
                <path d="M5 12h14M12 5l7 7-7 7"></path>
              </svg>
            </a>
          </div>
        </div>
      </div>

      <div class="p-4 lg:w-1/2 md:w-full">
        <div class="flex border-2 rounded-lg border-gray-200 border-opacity-50 p-8 sm:flex-row flex-col">
          
          <div class="flex-grow">
            <h2 class="text-gray-900 text-lg title-font font-medium mb-3">S25</h2>
            <p class="leading-relaxed text-base"> @php echo DNS1D::getBarcodeHTML($produto->cod_barras, 'S25'); @endphp</p>
            <a class="mt-3 text-indigo-500 inline-flex items-center">IMPRIMIR
              <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">
                <path d="M5 12h14M12 5l7 7-7 7"></path>
              </svg>
            </a>
          </div>
        </div>
      </div>


    </div>
  </div>
</section>
      
      
      <!--Footer-->
      <div class="flex justify-end pt-2">
        <button class="px-4 bg-transparent p-3 rounded-lg text-indigo-500 hover:bg-gray-100 hover:text-indigo-400 mr-2">Imprimir Todos</button>
        <button class="modal-close px-4 bg-indigo-500 p-3 rounded-lg text-white hover:bg-indigo-400">Sair</button>
      </div>

    </div>
  </div>
</div>

<script>
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