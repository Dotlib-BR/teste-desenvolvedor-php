<x-app-layout 
    page-name="Novo pedido">
        <div class="grid grid-cols-3 md:flex-row md:justify-between gap-6">
            <div class="w-full col-span-3 md:col-span-2">
                <x-card>
                    <form id="orders-form" method="POST" action="{{ url(route('orders.store')) }}" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @csrf
                        
                        <div class="flex flex-col space-y-2">
                            <label for="client" class="text-sm font-medium text-gray-700">Cliente</label>
                            <livewire:autocomplete-search :model="App\Models\Client::class" form='client_id' />
                        </div>

                        <div class="flex flex-col space-y-2">
                            <label for="status" class="text-sm font-medium text-gray-700">Status</label>
                            <select name="status" id="status"
                                class="py-2 px-3 border rounded-lg w-full bg-white
                                focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500
                            ">
                                @foreach (App\Enums\OrderStatus::getInstances() as $status)
                                <option value="{{ $status->value }}">{{ $status->description }}</option>
                                @endforeach
                            </select>
                        </div>
                    <input type="text" name="client_id" id="client_id" class="hidden">
                    </form>
                </x-card>
            </div>
                
            <div class="mt-6 flex flex-row gap-2 items-center justify-end md:justify-start col-start-1 col-span-3 md:col-span-3">
                <button type="submit" form="orders-form"
                class="bg-green-500 rounded-lg py-1.5 px-3
                text-md font-bold text-white hover:bg-green-400
                transition ease-in-out
                ">Salvar</button>
                
                <x-link-button bg-color="white" text-color="gray-600" class="font-bold text-md py-1.5 border border-gray-300 hover:bg-gray-100" url="{{ route('orders.index') }}">Cancelar</x-link-button>
            </div>
        </div>  

        <script>
            let client_id_input = document.getElementById('client_id')

            window.addEventListener('selected', event => {
                client_id_input.value = event.detail
            })
        </script>
</x-app-layout>