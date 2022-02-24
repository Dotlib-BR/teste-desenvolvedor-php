<section id="sidebar" class="w-[320px] h-full relative">
    <div class="absolute w-full h-full bg-white z-50" style="box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px;">
        <div class="border-b h-[4rem] flex items-center px-6">
            <div>
                <span class="text-green-500 text-3xl font-bold tracking-tight">dot.</span><span class="text-black text-3xl font-bold tracking-tight">lib</span>
            </div>
        </div>
        <div class="px-10 mt-4 flex flex-col">
            <span class="tracking-wide text-xs text-gray-600 font-bold mb-4">LOJA</span>
            <div class="flex flex-col gap-5">
                <x-sidebar.item url="clients" icon="user-group">Clientes</x-sidebar.item>
                    
                <x-sidebar.item url="products" icon="box">Produtos</x-sidebar>
                    
                <x-sidebar.item url="orders" icon="bag-shopping">Pedidos</x-sidebar>

                <x-sidebar.item url="discounts" icon="percent">Descontos</x-sidebar>
            </div>
        </div>
    </div>
</section>