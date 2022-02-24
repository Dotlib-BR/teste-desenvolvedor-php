<x-app-layout pageName="Descontos">
    <x-slot name="buttons">
        <x-link-button url="discounts/create">Novo produto</x-link-button>
    </x-slot>

    <x-table.table
        :pagination="$discounts->links('pagination::tailwind')"
        :per-page="$per_page"
        :search-params="$search_params"
        :searchable="true"
        >
        <x-slot name="header">
            <tr>
                <x-table.head-row>Código</x-table.head-row>
                <x-table.head-row>% OFF</x-table.head-row>
                <x-table.head-row>Valor OFF</x-table.head-row>
                <x-table.head-row></x-table.head-row>
            </tr>
        </x-slot>

        <x-slot name="body">
            @foreach ($discounts as $discount)
                <tr>
                    <x-table.body-row>{{ $discount->code }}</x-table.body-row> 
                    <x-table.body-row>{{ $discount->percent_off ?? '-' }}</x-table.body-row>
                    <x-table.body-row>{{ $discount->value_off ? App\Services\HelperService::numberToMoney($discount->value_off) : '-'}}</x-table.body-row> 
                    <x-table.body-row>
                        <a href="{{ url("/discounts/$discount->id/edit") }}" class="text-green-600 font-medium hover:text-green-500 text-sm">Editar</a>
                    </x-table.body-row>
                </tr>
            @endforeach
        </x-slot>
    </x-table.table>
</x-app-layout>
