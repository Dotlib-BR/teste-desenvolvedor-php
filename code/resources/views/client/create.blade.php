<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cadastrar novo Cliente') }}
        </h2>
        <nav class="bg-grey-light rounded font-sans">
            <ol class="list-reset flex text-grey-dark">
              <li><a href="{{ route('dashboard') }}" class="text-indigo-500 font-bold">Dashboard</a></li>
              <li><span class="mx-2">/</span></li>
              <li><a href="{{ route('client.index') }}" class="text-indigo-500 font-bold">Clientes</a></li>
              <li><span class="mx-2">/</span></li>
              <li class="text-indigo-400">Cadastrar Cliente</li>
            </ol>
          </nav>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form class="flex flex-col space-y-3" method="POST" action="{{ route('client.store') }}">
                        @csrf
                        <input required placeholder="Nome do cliente" type="text" name="name">
                        <input required placeholder="E-mail do cliente" type="email" name="email">
                        <input required placeholder="CPF do cliente" type="text" name="cpf">
                        <button type="submit" class="bg-indigo-500 hover:bg-indigo-600 px-3 py-2 rounded text-white focus:outline-none">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>