<x-app-layout pageName="Clientes">
    <x-table.table searchable='true' :pagination="$clients->links()">
        <x-slot name="header">
            <tr>
                <x-table.head-row>Nome</x-table.head-row>
                <x-table.head-row>CPF</x-table.head-row>
                <x-table.head-row>E-mail</x-table.head-row>
                <x-table.head-row> </x-table.head-row>
            </tr>
        </x-slot>

        <x-slot name="body">
            @foreach ($clients as $client)
                <tr>
                    <x-table.body-row>{{ $client->name }}</x-table.body-row> 
                    <x-table.body-row>{{ $client->cpf }}</x-table.body-row> 
                    <x-table.body-row>{{ $client->email }}</x-table.body-row>
                    <x-table.body-row>
                        <a href="{{ url("/clients/$client->id") }}" class="text-green-600 font-medium hover:text-green-500 text-sm">Editar</a>
                    </x-table.body-row>
                </tr>
            @endforeach
        </x-slot>
    </x-table.table>
</x-app-layout>
