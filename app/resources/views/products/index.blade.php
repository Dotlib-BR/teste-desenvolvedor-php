<x-app-layout pageName="Produtos">
    <x-slot name="buttons">
        <x-link-button url="products/create">Novo produto</x-link-button>
    </x-slot>

    <x-table.table
        :pagination="$products->links('pagination::tailwind')"
        :per-page="$per_page"
        :search-params="$search_params"
        :searchable="true"
        >
        <x-slot name="header">
            <tr>
                <x-table.head-row>Nome</x-table.head-row>
                <x-table.head-row>Preço</x-table.head-row>
                <x-table.head-row>Código de barras</x-table.head-row>
                <x-table.head-row></x-table.head-row>
            </tr>
        </x-slot>

        <x-slot name="body">
            @foreach ($products as $product)
                <tr>
                    <x-table.body-row>{{ $product->name }}</x-table.body-row> 
                    <x-table.body-row>{{ App\Services\HelperService::numberToMoney($product->price) }}</x-table.body-row> 
                    <x-table.body-row>{{ $product->barcode }}</x-table.body-row>
                    <x-table.body-row>
                        <a href="{{ url("/products/$product->id/edit") }}" class="text-green-600 font-medium hover:text-green-500 text-sm">Editar</a>
                    </x-table.body-row>
                </tr>
            @endforeach
        </x-slot>
    </x-table.table>
</x-app-layout>
