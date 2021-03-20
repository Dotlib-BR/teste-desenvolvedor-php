<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Visualizar Produto') }}
        </h2>
        <nav class="bg-grey-light rounded font-sans">
            <ol class="list-reset flex text-grey-dark">
              <li><a href="{{ route('dashboard') }}" class="text-indigo-500 font-bold">Dashboard</a></li>
              <li><span class="mx-2">/</span></li>
              <li><a href="{{ route('product.index') }}" class="text-indigo-500 font-bold">Produtos</a></li>
              <li><span class="mx-2">/</span></li>
              <li class="text-indigo-400">Visualizar Produto</li>
            </ol>
          </nav>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex flex-col space-y-3">
                        <input disabled value="{{ $product->name }}" type="text">
                        <input disabled value="{{ $product->quantity }}" type="number">
                        <input disabled value="{{ $product->price }}" type="number">
                        <input disabled value="{{ $product->bar_code }}" type="text">
                        <a href="{{ route('product.edit', $product) }}" class="text-center bg-yellow-500 hover:bg-yellow-600 px-3 py-2 rounded text-white focus:outline-none">Editar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>