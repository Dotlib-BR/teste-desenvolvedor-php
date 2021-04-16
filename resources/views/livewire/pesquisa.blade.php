
        <section
          x-transition:enter="transition duration-300 ease-in-out transform sm:duration-500"
          x-transition:enter-start="-translate-x-full"
          x-transition:enter-end="translate-x-0"
          x-transition:leave="transition duration-300 ease-in-out transform sm:duration-500"
          x-transition:leave-start="translate-x-0"
          x-transition:leave-end="-translate-x-full"
          x-show="isSearchPanelOpen"
          @keydown.escape="isSearchPanelOpen = false"
          class="fixed inset-y-0 z-20 w-full max-w-xs bg-white shadow-xl dark:bg-darker dark:text-light sm:max-w-md focus:outline-none"
        >
          <div class="absolute right-0 p-2 transform translate-x-full">
            <!-- Close button -->
            <button @click="isSearchPanelOpen = false" class="p-2 text-white rounded-md focus:outline-none focus:ring">
              <svg
                class="w-5 h-5"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
              >
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
              </svg>
            </button>
          </div>

          <h2 class="sr-only">Painel de Pesquisa</h2>
          <!-- Panel content -->
          <div class="flex flex-col h-screen">
            <!-- Panel header (Search input) -->
            <div
              class="relative flex-shrink-0 px-4 py-8 text-gray-400 border-b dark:border-primary-darker dark:focus-within:text-light focus-within:text-gray-700"
            >
              <span class="absolute inset-y-0 inline-flex items-center px-4">
                <svg
                  class="w-5 h-5"
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                  />
                </svg>
              </span>
              <input
                x-ref="searchInput"
                type="text"
                class="w-full py-2 pl-10 pr-4 border rounded-full dark:bg-dark dark:border-transparent dark:text-light focus:outline-none focus:ring"
                placeholder="Pesquisar..."
                wire:model="pesquisa" wire:keydown.escape="reset"
              />
            </div>

            <!-- Panel content (Search result) -->
            <div class="flex-1 px-4 pb-4 space-y-4 overflow-y-hidden h hover:overflow-y-auto">
            <div class="mb-3" wire:loading>Pesquisando ...</div>
        <div wire:loading.remove>
           
           
            
        @if(!empty($pesquisa))
            
            @if($resultados->isEmpty())
           
            <h3 class="py-2 text-sm font-semibold text-gray-600 dark:text-light">Nenhum Produto Encontrado</h3>
           
            @else
            <h3 class="py-2 text-sm font-semibold text-gray-600 dark:text-light">Exibindo Produtos Encontrados</h3>
                @foreach($resultados as $row)
            
              <a href="#" class="flex space-x-4">
                <div class="flex-shrink-0">
                  <img class="w-10 h-10 rounded-lg" src="{{asset('imagens/fake_produtos')}}/{{$row->imagem}}" alt="imagem de {{$row->nome_produto}}" />
                </div>
                <div class="flex-1 max-w-xs overflow-hidden">
                  <h4 class="text-sm font-semibold text-gray-600 dark:text-light">Produto: {{$row->nome_produto}}</h4>
                  <p class="text-sm font-normal text-gray-400 truncate dark:text-primary-lighter">
                  <a href="{{ route('produtos.show', $row->slug) }}" class="bg-blue-500 px-4 py-2 text-xs font-semibold tracking-wider text-white rounded hover:bg-blue-600">detalhar</a>
         Valor Unitário: R$: {{$row->valor_unitario}} - Preço de Venda: R$ {{$row->valor_promocional}}
         <a href="{{ route('produtos.show', $row->slug) }}" class="bg-blue-500 px-4 py-2 text-xs font-semibold tracking-wider text-white rounded hover:bg-blue-600">detalhar</a>

                  </p>
               <br/>
                </div>
              </a>
              <hr>
              @endforeach
            @endif
            @if(Auth::user()->utype ==="ADM")
            @if($resultadosUser->isEmpty())
           
            <h3 class="py-2 text-sm font-semibold text-gray-600 dark:text-light">Nenhum Usuário Encontrado</h3>
               
            @else
            <h3 class="py-2 text-sm font-semibold text-gray-600 dark:text-light">Exibindo Usuários Encontrados</h3>
                @foreach($resultadosUser as $row)
            
              <a href="#" class="flex space-x-4">
                <div class="flex-shrink-0">
                  <img class="w-10 h-10 rounded-lg" src="{{isset($row->profile_photo_url) ? $row->profile_photo_url : 'https://placehold.co/300x300/e2e8f0/e2e8f0'}}" alt="imagem de {{$row->name}}" />
                </div>
                <div class="flex-1 max-w-xs overflow-hidden">
                  <h4 class="text-sm font-semibold text-gray-600 dark:text-light">Nome: {{$row->name}}</h4>
                  <p class="text-sm font-normal text-gray-400 truncate dark:text-primary-lighter">
                  <a href="{{ route('interno.clientes.show', $row->id) }}" class="bg-blue-500 px-4 py-2 text-xs font-semibold tracking-wider text-white rounded hover:bg-blue-600">detalhar</a>
         Email:{{$row->email}} - CPF:{{!is_null($row->cpf) ? $row->cpf: 'Não Informado'}}
       
                  </p>
               <br/>
                </div>
              </a>
              <hr>
              @endforeach
         @endif
              @if($resultadosVoucher->isEmpty())
             
              <h3 class="py-2 text-sm font-semibold text-gray-600 dark:text-light">Nenhum Cupom Encontrado</h3>
        
            @else
            <h3 class="py-2 text-sm font-semibold text-gray-600 dark:text-light">Exibindo Cupons Encontrados</h3>
                @foreach($resultadosVoucher as $row)
            
              <a href="#" class="flex space-x-4">
                <div class="flex-shrink-0">
                  <img class="w-10 h-10 rounded-lg" src="https://placehold.co/300x300/e2e8f0/e2e8f0" alt="codigo" />
                </div>
                <div class="flex-1 max-w-xs overflow-hidden">
                  <h4 class="text-sm font-semibold text-gray-600 dark:text-light">Código de Cupom: {{$row->code}}</h4>
                  <p class="text-sm font-normal text-gray-400 truncate dark:text-primary-lighter">
                  <a href="{{ route('cupons-lista') }}" class="bg-blue-500 px-4 py-2 text-xs font-semibold tracking-wider text-white rounded hover:bg-blue-600">detalhar</a>
       
                  </p>
               <br/>
                </div>
              </a>
              <hr>
              @endforeach
            @endif
            @endif
        @endif
        
            </div>
          </div></div>
        </section>