<x-app-layout 
    page-name="Novo cliente">

        <div class="flex flex-col md:flex-row md:justify-between gap-6">
            <div class="w-full md:w-2/3">
                <x-card>
                    <form id="client-form" method="POST" action="{{ url("clients") }}" class="grid grid-cols-2 gap-6">
                        @csrf
    
                        <input type="hidden" id="">

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
                            <label for="email" class="text-sm font-medium text-gray-700">Email</label>
                            <input type="text" name="email" id="email"
                                class="py-2 px-3 border rounded-lg placeholder:text-slate-400 w-full
                                transition-all
                                @error('email')
                                border-red-500
                                @enderror
                                focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500">
                            <x-error-message for="email" />
                        </div>
    
                        <div class="flex flex-col space-y-2">
                            <label for="cpf" class="text-sm font-medium text-gray-700">CPF</label>
                            <input type="text" name="cpf" id="cpf"
                                class="py-2 px-3 border rounded-lg placeholder:text-slate-400 w-full
                                transition-all
                                @error('cpf')
                                border-red-500
                                @enderror
                                focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500">
                            <x-error-message for="cpf" />
                        </div>
    
    
                    </form>
                </x-card>
            </div>
        </div>

        <div class="mt-6 space-x-2">
            <button type="submit" form="client-form" class="bg-green-500 rounded-lg py-1.5 px-3
                text-md font-bold text-white">Salvar</button>
            <a href="{{ url(route('clients')) }}" class="bg-white border border-gray-300 rounded-lg py-1.5 px-3
                text-gray-700 text-md font-bold">Cancelar</a>
        </div>
</x-app-layout>