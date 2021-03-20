<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Pedido') }}
        </h2>
        <nav class="bg-grey-light rounded font-sans">
            <ol class="list-reset flex text-grey-dark">
              <li><a href="{{ route('dashboard') }}" class="text-indigo-500 font-bold">Dashboard</a></li>
              <li><span class="mx-2">/</span></li>
              <li><a href="{{ route('order.index') }}" class="text-indigo-500 font-bold">Pedidos</a></li>
              <li><span class="mx-2">/</span></li>
              <li class="text-indigo-400">Editar Pedido</li>
            </ol>
          </nav>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex flex-col space-y-3" >
                        @foreach ($order->products as $item)
                            <div class="w-full flex flex-row mb-2 flex-wrap">
                                <input class="w-1/2 my-1" type="text" disabled value="{{ $item->name }}">
                                <input disabled class="w-1/2 my-1" type="number" value="{{ $item->pivot->quantity }}">
                            </div>
                        @endforeach

                        <input disabled value="{{ $order->date->format("Y-m-d") }}" type="date">
                        <input type="text" disabled value="{{ $order->status_formated }}">  
                        <input type="text" disabled value="{{ $order->client->name ?? "Usuário inexistente" }}">  
                        <a href="{{ route('order.edit', $order) }}" class="text-center bg-yellow-500 hover:bg-yellow-600 px-3 py-2 rounded text-white focus:outline-none">Editar</a>               
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>