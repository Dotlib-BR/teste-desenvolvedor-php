<div class="flex flex-col gap-4">
    @foreach($products as $product)
        <x-card class="border border-gray-100 grid grid-cols-10 gap-6 items-center">
            <div class="col-span-5">
                <span for="created_at" class="text-sm font-medium text-gray-700">Produto</span>
                <input type="text" name="client" value="{{ $product->product->name }}" disabled
                class="py-2 px-3 border rounded-lg disabled:text-slate-700 select-none w-full">
            </div>
            <div class="col-span-2">
                <span for="quantity" class="text-sm font-medium text-gray-700">Quantidade</span>
                <input type="text" name="quantity" value="{{ $product->quantity }}" disabled
                class="py-2 px-3 border rounded-lg outline-none focus:border-green-500 text-slate-700 select-none w-full">
            </div>
            <div class="col-span-2">
                <span for="total" class="text-sm font-medium text-gray-700">Total</span>
                <div class="relative">
                    <span class="absolute h-full w-9 font-light text-slate-700 select-none
                    flex justify-center items-center
                    ">R$</span>
                    <input type="text" name="total" value="{{ $product->unit_price * $product->quantity }}" disabled
                    class="py-2 px-3 border rounded-lg disabled:text-slate-700 select-none pl-9 w-full outline-none focus:border-green-500">
                </div>
            </div>
            <div class="h-full flex items-end">
                <div class="col-span-1 flex justify-center items-center">
                    <button id="{{ $product->id }}" wire:click="delete({{ $product->id }})" class="bg-white hover:bg-gray-100 hover:cursor-pointer focus:scale-95
                        transition shadow-sm rounded-lg border h-12 w-12 flex justify-center items-center">
                        <i class="fa-solid fa-trash-can fa-xl text-red-600"></i>
                    </button>
                </div>
            </div>
        </x-card>
    @endforeach
    @if($newProduct)
        <x-card class="border border-gray-100 grid grid-cols-10 gap-6 items-center">



            <div class="col-span-5 flex flex-col">
                <span class="text-sm font-medium text-gray-700">Produto</span>
                <div class="relative">
                    <span class="absolute w-full h-full flex items-center justify-end pr-4 pointer-events-none
                        text-sm text-slate-400 tracking-tight font-medium
                    ">{{ App\Services\HelperService::numberToMoney($newProduct->unit_price ?: 0) }}</span>

                    <div class="w-full h-full">
                        <livewire:autocomplete-search
                            :model="App\Models\Product::class"/>
                    </div>
                    <div class="absolute">
                        <x-error-message for="newProduct.product_id"/>
                    </div>
                </div>
            </div>



            <div class="col-span-2">
                <span for="quantity" class="text-sm font-medium text-gray-700">Quantidade</span>
                <input type="number" name="quantity" wire:model="newProduct.quantity"
                    class="py-2 px-3 border rounded-lg text-slate-400 w-full
                    outline-none focus:border-green-500
                ">
                <div class="absolute">
                    <x-error-message for="newProduct.quantity"/>
                </div>
            </div>
            <div class="col-span-2">
                <span for="discount" class="text-sm font-medium text-gray-700">Total</span>
                <div class="relative">
                    <span class="absolute h-full w-9 font-light text-slate-400 select-none 
                    flex justify-center items-center 
                    ">R$</span>
                    <input type="text" disabled name="discount" value="{{ $newProduct->quantity ? $newProduct->unit_price * $newProduct->quantity : $newProduct->unit_price }}"
                        class="py-2 px-3 border rounded-lg pl-9 w-full
                        outline-none focus:border-green-500 text-slate-400 select-none
                    ">
                </div>
            </div>
            <div class="h-full flex items-end">
                <div class="col-span-1 flex justify-center items-center">
                    <button wire:click="create" class="bg-white hover:bg-gray-100 hover:cursor-pointer focus:scale-95
                        transition shadow-sm rounded-lg border h-12 w-12 flex justify-center items-center">
                        <i class="fa-solid fa-check fa-xl text-green-600"></i>
                    </button>
                </div>
            </div>

        </x-card>
    @else
        <button class="border-gray-100 border rounded-lg p-1 w-full 
            hover:bg-gray-100 hover:border-gray-200 shadow transition
            text-md font-medium text-gray-800
            flex items-center justify-center gap-2"
        wire:click="makeNewOrderProduct">
            <i class="fas fa-plus"></i>
            <span>Adicionar produto</span>
        </button>
    @endif
</div>