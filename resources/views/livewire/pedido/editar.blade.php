<div wire:poll.150ms>
<h2><span class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-indigo-100 
			@if($pedido->status_pedido ==='pendente') bg-indigo-700 @elseif($pedido->status_pedido === 'cancelado') bg-red-700 @else bg-green-700 @endif rounded">
			@if($pedido->status_pedido ==='pendente') PEDIDO EM PROCESSAMENTO @elseif($pedido->status_pedido ==='cancelado') PEDIDO CANCELADO @else PEDIDO ENCERRADO (ENTREGUE) @endif </span></h2>
<span class="text-gray-700">Alterar Status</span>
  <div class="mt-2">
    <div>
      <label class="inline-flex items-center">
        <input type="radio" wire:model="modelo" class="form-radio" name="radio" value="1" checked>
        <span class="ml-2">Concluir Pedido(Cliente Recebeu o Produto)</span>
      </label>
    </div>
    <div>
      <label class="inline-flex items-center">
        <input type="radio" wire:model="modelo" class="form-radio" name="radio" value="2">
        <span class="ml-2">Manter em Processamento</span>
      </label>
    </div>
    <div>
      <label class="inline-flex items-center">
        <input type="radio" wire:model="modelo" class="form-radio" name="radio" value="3">
        <span class="ml-2">Cancelar Pedido(Rejeita Compra)</span>
      </label>
    </div>
  </div>
  <div class="inline-block mr-2 mt-2">
                   <button wire:click="editarPedido({{$idP}})" type="button" class="focus:outline-none text-white text-sm py-2.5 px-5 rounded-md bg-blue-500 hover:bg-blue-600 hover:shadow-lg">Alterar Status do Pedido</button>
                </div>
                <div wire:loading wire:target="editarPedido">
       Editando Status do Pedido...
    </div>
</div>