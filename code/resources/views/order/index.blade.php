<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pedidos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 flex flex-col">
                    <div class="w-full flex flex-row-reverse mb-2.5">
                        <a class="bg-blue-500 hover:bg-blue-600 px-3 py-2 rounded text-white focus:outline-none">Criar novo Pedido</a>
                    </div>
                    <table class="table-auto rounded border-b border-gray-200 min-w-full">
                        <thead class="bg-gray-800 text-white">
                          <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Ação</th>
                          </tr>
                        </thead>
                        <tbody>
                          @forelse ($orders as $order)
                            <tr class="{{ $loop->index % 2 != 0 ? 'bg-gray-100' : '' }}">
                                <td class="text-center">{{ $order->id }}</td>
                                <td class="text-center">
                                    <button class="bg-yellow-400 hover:bg-yellow-600 px-3 py-1 rounded text-white focus:outline-none">Editar</button>
                                    <button class="bg-red-400 hover:bg-red-600 px-3 py-1 rounded text-white focus:outline-none">Deletar</button>
                                </td>
                            </tr>
                          @empty
                            <tr>
                                <td class="text-center" colspan="4">Sem Pedidos cadastrados</td>
                            </tr>
                          @endforelse
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
