<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Clientes') }}
        </h2>
        <nav class="bg-grey-light rounded font-sans">
          <ol class="list-reset flex text-grey-dark">
            <li><a href="{{ route('dashboard') }}" class="text-indigo-500 font-bold">Dashboard</a></li>
            <li><span class="mx-2">/</span></li>
            <li class="text-indigo-400">Clientes</li>
          </ol>
        </nav>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 flex flex-col">
                    <div class="w-full flex flex-row-reverse mb-2.5">
                        <a href="{{ route('client.create') }}" class="bg-blue-500 hover:bg-blue-600 px-3 py-2 rounded text-white focus:outline-none">Cadastrar novo Cliente</a>
                    </div>
                    <div class="w-full py-1">
                      <table id="table" class="stripe hover">
                        <thead>
                          <tr>
                            <th data-priority="1" class="text-center">#</th>
                            <th data-priority="2" class="text-center">Name</th>
                            <th data-priority="3" class="text-center">E-mail</th>
                            <th data-priority="4" class="text-center">CPF</th>
                            <th class="text-center">Ação</th>
                          </tr>
                        </thead>
                        <tbody>
                          @forelse ($clients as $client)
                            <tr class="{{ $loop->index % 2 != 0 ? 'bg-gray-100' : '' }}">
                                <td class="text-center">{{ $client->id }}</td>
                                <td class="text-center"><a class="hover:text-blue-600" href="{{ route('client.show', $client) }}">{{ $client->name }}</a></td>
                                <td class="text-center">{{ $client->email }}</td>
                                <td class="text-center">{{ $client->cpf }}</td>
                                <td class="text-center">
                                    <a href="{{ route("client.edit", $client) }}" class="bg-yellow-400 hover:bg-yellow-600 px-3 py-1 rounded text-white focus:outline-none">Editar</a>
                                    <button class="bg-red-400 hover:bg-red-600 px-3 py-1 rounded text-white focus:outline-none">Deletar</button>
                                </td>
                            </tr>
                          @empty
                            <tr>
                                <td class="text-center" colspan="5">Sem clientes cadastrados</td>
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
