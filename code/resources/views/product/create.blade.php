<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cadastrar novo Produto') }}
        </h2>
        <nav class="bg-grey-light rounded font-sans">
            <ol class="list-reset flex text-grey-dark">
              <li><a href="{{ route('dashboard') }}" class="text-indigo-500 font-bold">Dashboard</a></li>
              <li><span class="mx-2">/</span></li>
              <li><a href="{{ route('product.index') }}" class="text-indigo-500 font-bold">Produtos</a></li>
              <li><span class="mx-2">/</span></li>
              <li class="text-indigo-400">Cadastrar Produto</li>
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
                    <form class="flex flex-col space-y-3" method="POST" action="{{ route('product.store') }}">
                        @csrf
                        <input required placeholder="Nome do produto" type="text" name="name">
                        <input required placeholder="Quantidade do produto" type="number" step="1" name="quantity">
                        <input required placeholder="Preço unitário do produto" type="number" step="0.01" name="price">
                        <input required placeholder="Código de barras do produto" maxlength="20" type="text" name="bar_code">
                        <button type="submit" class="bg-indigo-500 hover:bg-indigo-600 px-3 py-2 rounded text-white focus:outline-none">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>