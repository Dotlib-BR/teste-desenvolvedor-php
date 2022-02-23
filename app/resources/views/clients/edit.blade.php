<x-app-layout 
    page-detail="Edição"
    :page-name="$client->name">
        <x-slot name="buttons">
            <form action="{{ url(route("clients.destroy", ['client' => $client])) }}" method="POST">
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
                    <form id="client-form" method="POST" action="{{ url("clients/$client->id") }}" class="grid grid-cols-2 gap-6">
                        @method('PUT')
                        @csrf
    
                        <input type="hidden" id="">

                        <div class="flex flex-col space-y-2">
                            <label for="name" class="text-sm font-medium text-gray-700">Nome</label>
                            <input type="text" name="name" value="{{ $client->name }}"
                                class="py-2 px-3 border rounded-lg placeholder:text-slate-400 w-full
                                transition-all
                                focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500">
                            <x-error-message for="name" />
                        </div>
    
                        <div class="flex flex-col space-y-2">
                            <label for="email" class="text-sm font-medium text-gray-700">Email</label>
                            <input type="text" name="email" value="{{ $client->email }}"
                                class="py-2 px-3 border rounded-lg placeholder:text-slate-400 w-full
                                transition-all
                                focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500">
                            <x-error-message for="email" />
                        </div>
    
                        <div class="flex flex-col space-y-2">
                            <label for="cpf" class="text-sm font-medium text-gray-700">CPF</label>
                            <input type="text" name="cpf" value="{{ $client->cpf }}"
                                class="py-2 px-3 border rounded-lg placeholder:text-slate-400 w-full
                                transition-all
                                focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500">
                            <x-error-message for="cpf" />
                        </div>
    
    
                    </form>
                </x-card>
            </div>
            <div class="w-1/3">
                <x-card>
                    <div class="flex flex-col gap-6">
                        <div class="flex flex-col space-y-2">
                            <label for="created_at" class="text-sm font-medium text-gray-700">Criado em</label>
                            <span class="capitalize" id="created_at">{{ $client->created_at->diffForHumans() }}</span>
                        </div>
                        <div class="flex flex-col space-y-2">
                            <label for="created_at" class="text-sm font-medium text-gray-700">Editado em</label>
                            <span class="capitalize" id="created_at">{{ $client->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
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