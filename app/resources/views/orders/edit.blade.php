<x-app-layout 
    page-detail="Edição"
    :page-name="'Pedido n. '.$order->id">
        <x-slot name="buttons">
            <form action="{{ url(route("orders.destroy", ['order' => $order])) }}" method="POST">
                @csrf
                @method('DELETE')
                <button
                    type="submit"
                    onclick="return confirm('Tem certeza?')"
                    class="bg-red-600 text-white font-medium tracking-tight rounded-lg px-4 py-1.5
                        transition ease-in-out
                        hover:bg-red-5  00 hover:scale-105 focus:ring-2 ring-red-600 hover:ring-red-500 ring-offset-2
                ">Apagar</button>
            </form>
        </x-slot>

        <div class="grid grid-cols-3 md:flex-row md:justify-between gap-6">
            <div class="w-full col-span-3 md:col-span-2">
                <x-card>
                    <form id="orders-form" method="POST" action="{{ url("orders/$order->id") }}" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @method('PUT')
                        @csrf
    
                        <input type="hidden" id="">

                        <div class="flex flex-col space-y-2 relative">
                            <label for="id" class="text-sm font-medium text-gray-700">Número</label>
                            <input type="text" name="id" value="{{ $order->id }}" disabled
                                class="py-2 px-3 border rounded-lg text-slate-400 w-full">
                            <div class="absolute">
                                <x-error-message for="name" />
                            </div>
                        </div>
    
                        <div class="flex flex-col space-y-2">
                            <label for="client" class="text-sm font-medium text-gray-700">Cliente</label>
                            <input type="text" name="client" value="{{ $order->client->name }}" disabled
                                class="py-2 px-3 border rounded-lg text-slate-400 w-full">
                        </div>

                        <div class="flex flex-col space-y-2 relative">
                            <label for="status" class="text-sm font-medium text-gray-700">Status</label>
                            <select name="status" id="status"
                                class="py-2 px-3 border rounded-lg w-full bg-white
                                focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500
                            ">
                                @foreach (App\Enums\OrderStatus::getInstances() as $status)
                                    <option value="{{ $status->value }}" {{ $status->value === $order->status->value ? "selected" : "" }}>{{ $status->description }}</option>
                                @endforeach
                            </select>
                            <div class="absolute">
                                <x-error-message for="status" />
                            </div>
                        </div>

                        <div class="flex flex-col space-y-2">
                            <label for="discount_id" class="text-sm font-medium text-gray-700">Desconto</label>
                            <select type="text" name="discount_id" value="{{ $order->discount_id }}"
                                class="py-2 px-3 border rounded-lg text-gray-800 w-full bg-white">
                                    <option value="">Nenhum</option>
                                @foreach($discounts as $discount)
                                    <option value="{{ $discount->id }}" {{ $order->discount_id === $discount->id ? 'selected' : '' }}>{{ $discount->code }}</option>
                                @endforeach
                            </select>
                        </div>
    
                    </form>
                </x-card>
            </div>
            <div class="w-full col-span-3 md:col-span-1">
                <x-card>
                    <div class="flex flex-col gap-6">
                        <div class="flex flex-col space-y-2">
                            <label for="created_at" class="text-sm font-medium text-gray-700">Criado em</label>
                            <span class="capitalize" id="created_at">{{ $order->created_at->diffForHumans() }}</span>
                        </div>
                        <div class="flex flex-col space-y-2">
                            <label for="created_at" class="text-sm font-medium text-gray-700">Editado em</label>
                            <span class="capitalize" id="created_at">{{ $order->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </x-card>
            </div>    
            <div class="w-full col-span-3 md:col-span-2">
                <x-card>
                    <span for="created_at" class="text-sm font-medium text-gray-700">Itens</span>                        
                        <livewire:order-products.edition :order="$order" />
                </x-card>
            </div>
            
            <div>
                <livewire:order-products.total :order="$order" />
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
</x-app-layout>