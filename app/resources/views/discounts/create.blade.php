<x-app-layout 
    page-name="Novo desconto">

        <div class="flex flex-col md:flex-row md:justify-between gap-6">
            <div class="w-full md:w-2/3">
                <x-card>
                    <form id="client-form" method="POST" action="{{ route('discounts.store') }}" class="grid grid-cols-2 gap-6">
                        @csrf

                        <div class="flex flex-col space-y-2">
                            <label for="code" class="text-sm font-medium text-gray-700">Código</label>
                            <input type="text" name="code" id="code"
                                class="py-2 px-3 border rounded-lg placeholder:text-slate-400 w-full
                                transition-all
                                @error('code')
                                border-red-500
                                @enderror
                                focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500">
                            <x-error-message for="code" />
                        </div>
    
                        <div class="flex flex-col space-y-2">
                            <label for="percent_off" class="text-sm font-medium text-gray-700">% OFF</label>
                            <input type="number" name="percent_off" min="0" max="100"
                                class="border rounded-lg placeholder:text-slate-400 w-full
                                py-2 px-3 transition-all
                                @error('percent_off')
                                border-red-500
                                @enderror
                                focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500">
                            <x-error-message for="percent_off" />    
                        </div>

                        <div class="flex flex-col space-y-2">
                            <label for="value_off" class="text-sm font-medium text-gray-700">Valor OFF</label>
                            <div class="relative">
                                <span class="absolute h-full w-9 pl-2 flex justify-center items-center font-light text-gray-600">R$</span>
                                <input type="text" name="value_off"
                                    class="py-2 pl-9 border rounded-lg placeholder:text-slate-400 w-full
                                    transition-all
                                    focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500">
                            </div>
                            <x-error-message for="value_off" />
                        </div>
    
    
                    </form>
                </x-card>
            </div>
        </div>

        <div class="mt-6 space-x-2">
            <button type="submit" form="client-form" class="bg-green-500 rounded-lg py-1.5 px-3
                text-md font-bold text-white">Salvar</button>
            <a href="{{ url(route('discounts.index')) }}" class="bg-white border border-gray-300 rounded-lg py-1.5 px-3
                text-gray-700 text-md font-bold">Cancelar</a>
        </div>
</x-app-layout>