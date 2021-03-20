<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Pedidos') }}
      </h2>
      <nav class="bg-grey-light rounded font-sans">
        <ol class="list-reset flex text-grey-dark">
          <li><a href="{{ route('dashboard') }}" class="text-indigo-500 font-bold">Dashboard</a></li>
          <li><span class="mx-2">/</span></li>
          <li class="text-indigo-400">Pedidos</li>
        </ol>
      </nav>
  </x-slot>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6 bg-white border-b border-gray-200 flex flex-col">
                  <div class="w-full flex flex-row-reverse mb-2.5">
                      <a href="{{ route('order.create') }}" class="bg-blue-500 hover:bg-blue-600 px-3 py-2 rounded text-white focus:outline-none">Cadastrar novo Pedido</a>
                  </div>
                  <div class="w-full py-1">
                    <table id="table" class="stripe hover">
                      <thead>
                        <tr>
                          <th data-priority="1" class="text-center">#</th>
                          <th data-priority="2" class="text-center">Status</th>
                          <th data-priority="4" class="text-center">Cliente</th>
                          <th data-priority="3" class="text-center">Data</th>
                          <th class="text-center">Ação</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse ($orders as $order)
                          <tr class="{{ $loop->index % 2 != 0 ? 'bg-gray-100' : '' }}">
                              <td class="text-center">{{ $order->id }}</td>
                              <td class="text-center"><a class="hover:text-blue-600" href="{{ route('order.show', $order) }}">{{ $order->status_formated }}</a></td>
                              <td class="text-center">{{ $order->client->name ?? "Usuário inexistente" }}</td>
                              <td class="text-center">{{ $order->date->format("d/m/Y") }}</td>
                              <td class="text-center">
                                  <a href="{{ route("order.edit", $order) }}" class="bg-yellow-400 hover:bg-yellow-600 px-3 py-1 rounded text-white focus:outline-none">Editar</a>
                                  <button
                                   class="bg-red-400 hover:bg-red-600 px-3 py-1 rounded text-white focus:outline-none"
                                   onclick="event.preventDefault(); if(confirm('Tem certeza que deseja deletar o pedido {{ $order->id }}?')) { document.getElementById('destroy-form-{{$order->id}}').submit(); }"
                                   >Deletar</button>
                                  <form id="destroy-form-{{$order->id}}" action="{{ route('order.destroy',$order->id) }}" method="POST" style="display: none;">
                                      @csrf
                                      @method('DELETE')
                                  </form>

                              </td>
                          </tr>
                        @empty
                          <tr>
                              <td class="text-center" colspan="5">Sem Pedidos cadastrados</td>
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
