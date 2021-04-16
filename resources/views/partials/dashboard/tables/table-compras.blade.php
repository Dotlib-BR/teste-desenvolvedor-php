<!-- component -->
@if(!is_null($pedidos))
<table class="border-collapse w-full">
    <thead>
        <tr>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Ref.Pedido</th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Comprado em</th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Status</th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Valor Total do Pedido</th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Ações</th>
        </tr>
    </thead>
    <tbody>
    @foreach($pedidos as $pedido)
        <tr class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
            <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Ref.Pedido</span>
                {{$pedido->identificador}}
            </td>
            <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Comprado em</span>
                {{isset($pedido->created_at) ?  \Carbon\Carbon::parse($pedido->created_at)->format('d/m/Y  H:i:s') : ''}}
            </td>
          	<td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Status</span>
                <span class="rounded @if($pedido->status_pedido ==='cancelado') bg-red-400 @elseif($pedido->status_pedido ==='pendente') bg-blue-400 @else bg-green @endif py-1 px-3 text-xs font-bold">
                @if($pedido->status_pedido ==='cancelado') Pedido Cancelado @elseif($pedido->status_pedido ==='pendente') Pedido em Processamento @else Pedido Finalizado(Produto Entegue) @endif
                </span>
          	</td>
             
            <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Valor Total do Pedido</span>
                {{$pedido->valor_total_pedido}}
            </td>
            <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Valor Total do Pedido</span>
                <a href="{{route('compra',$pedido->id)}}" class="text-blue-400 hover:text-blue-600 underline">Ver Recibo</a>
            </td>
        </tr>
    @endforeach

    </tbody>
</table>
@else
<h1>Você ainda não efetuou compras</h1>
@endif