<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Pedido') }}
        </h2>
        <nav class="bg-grey-light rounded font-sans">
            <ol class="list-reset flex text-grey-dark">
              <li><a href="{{ route('dashboard') }}" class="text-indigo-500 font-bold">Dashboard</a></li>
              <li><span class="mx-2">/</span></li>
              <li><a href="{{ route('product.index') }}" class="text-indigo-500 font-bold">Pedidos</a></li>
              <li><span class="mx-2">/</span></li>
              <li class="text-indigo-400">Editar Pedido</li>
            </ol>
          </nav>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if ($errors->any())
                    <div class="text-white px-6 py-4 border-0 rounded relative mb-4 bg-red-500 flex flex-col">
                        <span class="text-xl">
                            <i class="fas fa-exclamation-circle"></i>
                            <b class="capitalize">Erro!</b> os seguintes erros foram encontrados:
                        </span>
                        <ul class="ml-5 list-disc list-outside ">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" class="flex flex-col space-y-3" action="{{ route('order.update', $order) }}">
                        @csrf
                        @method("PUT")
                        @foreach ($order->products as $item)
                        <div class="w-full flex flex-row mb-2 flex-wrap">
                            <select class="w-1/2 my-1" name="products[]">
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @foreach ($allProducts->filter(fn($product) => $product->id != $item->id) as $productOption)
                                    <option value="{{ $productOption->id }}">{{ $productOption->name }}</option>
                                @endforeach
                            </select>
                            <input class="w-1/2 my-1" type="number" value="{{ $item->pivot->quantity }}" name="quantities[]">
                            </div>
                        @endforeach
                        <input value="{{ $order->date->format("Y-m-d") }}" type="date" name="date">
                        <select name="status">
                            <option {{ $order->status == "opened" ? "selected" : "" }} value="opened">Em Aberto</option>
                            <option {{ $order->status == "paid_out" ? "selected" : "" }} value="paid_out">Pago</option>
                            <option {{ $order->status == "canceled" ? "selected" : "" }} value="canceled">Cancelado</option>
                        </select>
                        <button type="submit" class="bg-indigo-500 hover:bg-indigo-600 px-3 py-2 rounded text-white focus:outline-none">Enviar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>