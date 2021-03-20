<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cadastrar novo Pedido') }}
        </h2>
        <nav class="bg-grey-light rounded font-sans">
            <ol class="list-reset flex text-grey-dark">
              <li><a href="{{ route('dashboard') }}" class="text-indigo-500 font-bold">Dashboard</a></li>
              <li><span class="mx-2">/</span></li>
              <li><a href="{{ route('order.index') }}" class="text-indigo-500 font-bold">Pedidos</a></li>
              <li><span class="mx-2">/</span></li>
              <li class="text-indigo-400">Cadastrar Pedido</li>
            </ol>
          </nav>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if ($errors->any())
                    <div class="text-white px-6 py-4 border-0 rounded relative mb-4 bg-red-500 flex flex-col">
                        <span class="text-xl">
                            <i class="fas fa-exclamation-circle"></i>
                            <b class="capitalize">Erro!</b> os seguintes erros foram encontrados:
                        </span>
                        <ul class="ml-5 list-disc list-outside ">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" class="flex flex-col space-y-3" action="{{ route('order.store') }}">
                        @csrf
                        <div id="prod-div" class="w-full flex flex-row mb-2 flex-wrap">
                            <select class="w-1/2 my-1" name="products[]">
                                <option disabled value="">Selecione o Produto</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                            <input class="w-1/2 my-1" placeholder="Quantidade do produto" type="number" name="quantities[]">
                        </div>
                        <button id="add-prod" class="bg-green-500 hover:bg-green-600 px-3 py-2 rounded text-white focus:outline-none">Adicionar Produto</button>

                        <input placeholder="Data do pedido" type="date" name="date">
                        <select name="status">
                            <option disabled value="">Selecione o Status</option>
                            <option value="opened">Em Aberto</option>
                            <option value="paid_out">Pago</option>
                            <option value="canceled">Cancelado</option>
                        </select>
                        <select name="client_id">
                            <option disabled value="">Selecione o Cliente</option>
                            @foreach ($clients as $client)
                                <option value="{{ $client->id }}">{{ $client->name }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="bg-indigo-500 hover:bg-indigo-600 px-3 py-2 rounded text-white focus:outline-none">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <x-slot name="scripts">
        <script>
            const generateSelect = () => {
                const select = document.createElement("select")
                const products = JSON.parse("{{ $products ? $products->toJson() : [] }}".replaceAll("&quot;", "\""))

                select.classList.add("w-1/2")
                select.classList.add("my-1")
                select.name = "products[]"
                const defaultOption = document.createElement("option")
                defaultOption.text = "Selectione o produto"
                defaultOption.disabled = true
                select.appendChild(defaultOption)

                products.forEach( (item) => {
                    const option = document.createElement("option")
                    option.value = item.id
                    option.text = item.name
                    select.appendChild(option)
                })

                return select
            }

            const generateQuantity = () => {
                const input = document.createElement("input")
                input.classList.add("w-1/2")
                input.classList.add("my-1")
                input.placeholder = "Quantidade do produto"
                input.type = "number"
                input.name = "quantities[]"

                return input
            }

            const addProduct = (event) => {
                event.preventDefault()
                const prodDiv = document.getElementById("prod-div")

                const select  = generateSelect()
                const quantity = generateQuantity()

                prodDiv.appendChild(select)
                prodDiv.appendChild(quantity)
            }
            document.getElementById("add-prod").addEventListener("click", addProduct)
        </script>
    </x-slot>
</x-app-layout>