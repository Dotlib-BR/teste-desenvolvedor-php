<section id="sidebar" class="w-[320px] h-full bg-white shadow-2xl">
    <div class="border-b h-[4rem] flex items-center px-6">
        <h1 class="font-bold text-xl tracking-tight">Meu Sistema</h1>
    </div>
    <div class="px-6 mt-4 flex flex-col">
        <span class="tracking-wide text-xs text-gray-600 font-bold mb-4">LOJA</span>
        <div class="flex flex-col gap-4">
            <x-sidebar.item url="clients" icon="user-group">Clientes</x-sidebar.item>
                
            <x-sidebar.item url="products" icon="box">Produtos</x-sidebar>
                
            <x-sidebar.item url="orders" icon="bag-shopping">Pedidos</x-sidebar>
        </div>
    </div>
</section>