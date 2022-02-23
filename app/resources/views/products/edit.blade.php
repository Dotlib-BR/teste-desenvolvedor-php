<x-app-layout 
    page-detail="Edição"
    :page-name="$product->name">
        <x-slot name="buttons">
            <form action="{{ url(route("products.destroy", ['product' => $product])) }}" method="POST">
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



        <div class="flex flex-col md:flex-row md:justify-between gap-6">
            <div class="w-full md:w-2/3">
                <x-card>
                    <form id="products-form" method="POST" action="{{ url("products/$product->id") }}" class="grid grid-cols-2 gap-6">
                        @method('PUT')
                        @csrf
    
                        <input type="hidden" id="">

                        <div class="flex flex-col space-y-2">
                            <label for="name" class="text-sm font-medium text-gray-700">Nome</label>
                            <input type="text" name="name" value="{{ $product->name }}"
                                class="py-2 px-3 border rounded-lg placeholder:text-slate-400 w-full
                                transition-all
                                focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500">
                            <x-error-message for="name" />
                        </div>
    
                        <div class="flex flex-col space-y-2">
                            <label for="price" class="text-sm font-medium text-gray-700">Preço</label>
                            <div class="w-full h-full relative">
                                <span class="absolute h-full w-9 pl-2 flex justify-center items-center font-light text-gray-600">R$</span>
                                <input type="text" name="price" value="{{ $product->price }}"
                                    class="py-2 pl-9 border rounded-lg placeholder:text-slate-400 w-full
                                    transition-all
                                    focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500">
                            </div>
                            <x-error-message for="price" />    
                        </div>

                        <div class="flex flex-col space-y-2">
                            <label for="barcode" class="text-sm font-medium text-gray-700">Código de barras</label>
                            <input type="number" name="barcode" value="{{ $product->barcode }}"
                                class="py-2 px-3 border rounded-lg placeholder:text-slate-400 w-full
                                transition-all
                                focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500">
                            <x-error-message for="barcode" />
                        </div>
    
    
                    </form>
                </x-card>
            </div>
            <div class="w-1/3">
                <x-card>
                    <div class="flex flex-col gap-6">
                        <div class="flex flex-col space-y-2">
                            <label for="created_at" class="text-sm font-medium text-gray-700">Criado em</label>
                            <span class="capitalize" id="created_at">{{ $product->created_at->diffForHumans() }}</span>
                        </div>
                        <div class="flex flex-col space-y-2">
                            <label for="created_at" class="text-sm font-medium text-gray-700">Editado em</label>
                            <span class="capitalize" id="created_at">{{ $product->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </x-card>
            </div>
        </div>

        <div class="mt-6 flex flex-row gap-2 items-center">
            <button type="submit" form="products-form"
                class="bg-green-500 rounded-lg py-1.5 px-3
                text-md font-bold text-white hover:bg-green-400
                transition ease-in-out
            ">Salvar</button>

            <x-link-button bg-color="white" text-color="gray-600" class="font-bold text-md py-1.5 border border-gray-300 hover:bg-gray-100" url="{{ route('products.index') }}">Cancelar</x-link-button>
        </div>

</x-app-layout>