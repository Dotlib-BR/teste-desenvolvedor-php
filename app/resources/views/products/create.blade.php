<x-app-layout 
    page-name="Novo produto">

        <div class="flex flex-col md:flex-row md:justify-between gap-6">
            <div class="w-full md:w-2/3">
                <x-card>
                    <form id="client-form" method="POST" action="{{ url("products") }}" class="grid grid-cols-2 gap-6">
                        @csrf

                        <div class="flex flex-col space-y-2">
                            <label for="name" class="text-sm font-medium text-gray-700">Nome</label>
                            <input type="text" name="name" id="name"
                                class="py-2 px-3 border rounded-lg placeholder:text-slate-400 w-full
                                transition-all
                                @error('name')
                                border-red-500
                                @enderror
                                focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500">
                            <x-error-message for="name" />
                        </div>
    
                        <div class="flex flex-col space-y-2">
                            <label for="price" class="text-sm font-medium text-gray-700">Preço</label>
                            <div class="w-full h-full relative">
                                <span class="absolute h-full w-9 pl-2 flex justify-center items-center font-light text-gray-600">R$</span>
                                <input type="text" name="price"
                                    class="py-2 pl-9 border rounded-lg placeholder:text-slate-400 w-full
                                    transition-all
                                    focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500">
                                </div>
                            <x-error-message for="price" />    
                        </div>

                        <div class="flex flex-col space-y-2">
                            <label for="barcode" class="text-sm font-medium text-gray-700">Código de barras</label>
                            <input type="number" name="barcode"
                                class="py-2 px-3 border rounded-lg placeholder:text-slate-400 w-full
                                transition-all
                                focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500">
                            <x-error-message for="barcode" />
                        </div>
    
    
                    </form>
                </x-card>
            </div>
        </div>

        <div class="mt-6 space-x-2">
            <button type="submit" form="client-form" class="bg-green-500 rounded-lg py-1.5 px-3
                text-md font-bold text-white">Salvar</button>
            <a href="{{ url(route('products.index')) }}" class="bg-white border border-gray-300 rounded-lg py-1.5 px-3
                text-gray-700 text-md font-bold">Cancelar</a>
        </div>
</x-app-layout>