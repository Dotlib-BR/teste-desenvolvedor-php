<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Produtos') }}
      </h2>
      <nav class="bg-grey-light rounded font-sans">
        <ol class="list-reset flex text-grey-dark">
          <li><a href="{{ route('dashboard') }}" class="text-indigo-500 font-bold">Dashboard</a></li>
          <li><span class="mx-2">/</span></li>
          <li class="text-indigo-400">Produtos</li>
        </ol>
      </nav>
  </x-slot>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6 bg-white border-b border-gray-200 flex flex-col">
                  <div class="w-full flex flex-row-reverse mb-2.5">
                      <a href="{{ route('product.create') }}" class="bg-blue-500 hover:bg-blue-600 px-3 py-2 rounded text-white focus:outline-none">Cadastrar novo Produto</a>
                      <button
                        disabled
                        id="button-mult" 
                        onclick="event.preventDefault(); if(confirm('Tem certeza que deseja deletar os clientes selecionados?')) { document.getElementById('destroy-form-mult').submit(); }"
                        class="mx-1 bg-red-400 hover:bg-red-600 px-3 py-1 rounded text-white focus:outline-none"
                        >Deletar Selecionados
                      </button>
                      <form id="destroy-form-mult" action="{{ route('product.multDestroy') }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                      </form>  
                  </div>
                  <div class="w-full py-1">
                    <table id="table" class="stripe hover">
                      <thead>
                        <tr>
                          <th data-priority="1" class="text-center">#</th>
                          <th data-priority="2" class="text-center">Nome</th>
                          <th data-priority="3" class="text-center">Quantidade</th>
                          <th data-priority="4" class="text-center">Proço unitario</th>
                          <th class="text-center">Ação</th>
                          <th class="text-center">Selecionar</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse ($products as $product)
                          <tr class="{{ $loop->index % 2 != 0 ? 'bg-gray-100' : '' }}">
                              <td class="text-center">{{ $product->id }}</td>
                              <td class="text-center"><a class="hover:text-blue-600" href="{{ route('product.show', $product) }}">{{ $product->name }}</a></td>
                              <td class="text-center">{{ $product->quantity }}</td>
                              <td class="text-center">{{ $product->price }}</td>
                              <td class="text-center">
                                  <a href="{{ route("product.edit", $product) }}" class="bg-yellow-400 hover:bg-yellow-600 px-3 py-1 rounded text-white focus:outline-none">Editar</a>
                                  <button
                                   class="bg-red-400 hover:bg-red-600 px-3 py-1 rounded text-white focus:outline-none"
                                   onclick="event.preventDefault(); if(confirm('Tem certeza que deseja deletar o produto {{ $product->name }}?')) { document.getElementById('destroy-form-{{$product->id}}').submit(); }"
                                   >Deletar</button>
                                  <form id="destroy-form-{{$product->id}}" action="{{ route('product.destroy',$product->id) }}" method="POST" style="display: none;">
                                      @csrf
                                      @method('DELETE')
                                  </form>
                              </td>
                              <td class="text-center">
                                <input value="{{ $product->id }}" m-type="product" class="checkbox" type="checkbox">  
                              </td>
                          </tr>
                        @empty
                          <tr>
                              <td class="text-center" colspan="6">Sem Ps cadastrados</td>
                          </tr>
                        @endforelse
                      </tbody>
                    </table>
                  </div>
              </div>
          </div>
      </div>
  </div>
</x-app-layout>
