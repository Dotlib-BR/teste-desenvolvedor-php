<x-app-layout pageName="Clientes">
    <x-slot name="buttons">
        <x-link-button url="clients/create">Novo cliente</x-link-button>
    </x-slot>

    <x-table.table
        :pagination="$clients->links('pagination::tailwind')"
        :per-page="$per_page"
        :search-params="$search_params"
        :searchable="true"
        >
        <x-slot name="header">
            <tr>
                <x-table.head-row order-by="name">Nome</x-table.head-row>
                <x-table.head-row order-by="cpf">CPF</x-table.head-row>
                <x-table.head-row order-by="email">E-mail</x-table.head-row>
                <x-table.head-row> </x-table.head-row>
            </tr>
        </x-slot>

        <x-slot name="body">
            @foreach ($clients as $client)
                <tr>
                    <x-table.body-row>
                        <a href="{{ url(route("clients.edit", ['client' => $client])) }}">
                            {{ $client->name }}</x-table.body-row> 
                        </a>
                    <x-table.body-row>{{ $client->cpf }}</x-table.body-row> 
                    <x-table.body-row>{{ $client->email }}</x-table.body-row>
                    <x-table.body-row>
                        <a href="{{ url("/clients/$client->id/edit") }}" class="text-green-600 font-medium hover:text-green-500 text-sm">Editar</a>
                    </x-table.body-row>
                </tr>
            @endforeach
        </x-slot>
    </x-table.table>
</x-app-layout>
