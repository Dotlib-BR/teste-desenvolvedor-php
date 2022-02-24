<x-app-layout pageName="Pedidos">
    <x-slot name="buttons">
        <x-link-button url="orders/create">Novo pedido</x-link-button>
    </x-slot>

    <x-table.table
        :pagination="$orders->links('pagination::tailwind')"
        :per-page="$per_page"
        :search-params="$search_params"
        :searchable="true"
        >
        <x-slot name="header">
            <tr>
                <x-table.head-row>Número</x-table.head-row>
                <x-table.head-row>Cliente</x-table.head-row>
                <x-table.head-row>Status</x-table.head-row>
                <x-table.head-row>Valor Total</x-table.head-row>
                <x-table.head-row>Data de compra</x-table.head-row>
                <x-table.head-row></x-table.head-row>
            </tr>
        </x-slot>

        <x-slot name="body">
            @foreach ($orders as $order)
                <tr>
                    <x-table.body-row>{{ $order->id }}</x-table.body-row>
                    <x-table.body-row>{{ $order->client->name }}</x-table.body-row> 
                    <x-table.body-row>
                        <x-status :status="$order->status" />
                        </x-table.body-row> 
                        <x-table.body-row>{{ App\Services\HelperService::numberToMoney($order->total_discounted) }}</x-table.body-row> 
                    <x-table.body-row>{{ $order->created_at->toFormattedDateString() }}</x-table.body-row>
                    <x-table.body-row>
                        <a href="{{ url("/orders/$order->id/edit") }}" class="text-green-600 font-medium hover:text-green-500 text-sm">Editar</a>
                    </x-table.body-row>
                </tr>
            @endforeach
        </x-slot>
    </x-table.table>
</x-app-layout>
