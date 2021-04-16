@extends('layouts.dashboard')
@section('content')
@if(Auth::user()->id === $pedido->user_id || Auth::user()->utype ==="ADM" )
<div class="antialiased sans-serif min-h-screen bg-white" style="min-height: 900px">
	<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" defer></script>
	<style>
		[x-cloak] {
			display: none;
		}

		@media print {
			.no-printme  {
				display: none;
			}
			.printme  {
				display: block;
			}
			body {
				line-height: 1.2;
			}
		}

		@page {
			size: A4 portrait;
			counter-increment: page;
		}

		/* Datepicker */
		.date-input {
			background-color: #fff;
			border-radius: 10px;
			padding: 0.5rem 1rem;
			z-index: 2000;
			margin: 3px 0 0 0;
			border-top: 1px solid #eee;
			box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1),
				0 4px 6px -2px rgba(0, 0, 0, 0.05);
		}
		.date-input.is-hidden {
			display: none;
		}
		.date-input .pika-title {
			padding: 0.5rem;
			width: 100%;
			text-align: center;
		}
		.date-input .pika-prev,
		.date-input .pika-next {
			margin-top: 0;
			/* margin-top: 0.5rem; */
			padding: 0.2rem 0;
			cursor: pointer;
			color: #4299e1;
			text-transform: uppercase;
			font-size: 0.85rem;
		}
		.date-input .pika-prev:hover,
		.date-input .pika-next:hover {
			text-decoration: underline;
		}
		.date-input .pika-prev {
			float: left;
		}
		.date-input .pika-next {
			float: right;
		}
		.date-input .pika-label {
			display: inline-block;
			font-size: 0;
		}
		.date-input .pika-select-month,
		.date-input .pika-select-year {
			display: inline-block;
			border: 1px solid #ddd;
			color: #444;
			background-color: #fff;
			border-radius: 10px;
			font-size: 0.9rem;
			padding-left: 0.5em;
			padding-right: 0.5em;
			padding-top: 0.25em;
			padding-bottom: 0.25em;
			appearance: none;
		}
		.date-input .pika-select-month:focus,
		.date-input .pika-select-year:focus {
			border-color: #cbd5e0;
			outline: none;
		}
		.date-input .pika-select-month {
			margin-right: 0.25em;
		}
		.date-input table {
			width: 100%;
			border-collapse: collapse;
			margin-bottom: 0.2rem;
		}
		.date-input table th {
			width: 2em;
			height: 2em;
			font-weight: normal;
			color: #718096;
			text-align: center;
		}
		.date-input table th abbr {
			text-decoration: none;
		}
		.date-input table td {
			padding: 2px;
		}
		.date-input table td button {
			/* border: 1px solid #e2e8f0; */
			width: 1.8em;
			height: 1.8em;
			text-align: center;
			color: #555;
			border-radius: 10px;
		}
		.date-input table td button:hover {
			background-color: #bee3f8;
		}
		.date-input table td.is-today button {
			background-color: #ebf8ff;
		}
		.date-input table td.is-selected button {
			background-color: #3182ce;
		}
		.date-input table td.is-selected button {
			color: white;
		}
		.date-input table td.is-selected button:hover {
			color: white;
		}
	</style>

	<div class="border-t-8 border-gray-700 h-2"></div>
	<div class="container mx-auto py-6 px-4 dark:bg-darker" >
		<div class="flex justify-between">
			<h2 class="text-2xl font-bold mb-6 pb-2 tracking-wider uppercase  dark:text-light">Detalhes do Pedido</h2>
            @if(!isset($editar))       <h2><span class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-indigo-100 
			@if($pedido->status_pedido ==='pendente') bg-indigo-700 @elseif($pedido->status_pedido === 'cancelado') bg-red-700 @else bg-green-700 @endif rounded">
			@if($pedido->status_pedido ==='pendente') PEDIDO EM PROCESSAMENTO @elseif($pedido->status_pedido ==='cancelado') PEDIDO CANCELADO @else PEDIDO ENCERRADO (ENTREGUE) @endif </span></h2> @endif
            <div class="block">
			@php $idd = $pedido->id; @endphp
                @if(isset($editar))
 @livewire('pedido.editar',['id' => $idd])
                @endif
</div>
            <div>
				<div class="relative mr-4 inline-block">
					<div class="text-gray-500 cursor-pointer w-10 h-10 rounded-full bg-gray-100 hover:bg-gray-300 inline-flex items-center justify-center" onclick="printDiv('js-print-template')" >
						<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-printer" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
							<rect x="0" y="0" width="24" height="24" stroke="none"></rect>
							<path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2"></path>
							<path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4"></path>
							<rect x="7" y="13" width="10" height="8" rx="2"></rect>
						</svg>				  
					</div>
					<div  class="z-40 shadow-lg text-center w-32 block absolute right-0 top-0 p-2 mt-12 rounded-lg bg-gray-800 text-white text-xs " style="display: none;">
						Imprimir Pedido
					</div>
				</div>
				
				<div class="relative inline-block">
					<div class="text-gray-500 cursor-pointer w-10 h-10 rounded-full bg-gray-100 hover:bg-gray-300 inline-flex items-center justify-center"   >
						<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-refresh" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
							<rect x="0" y="0" width="24" height="24" stroke="none"></rect>
							<path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -5v5h5"></path>
							<path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 5v-5h-5"></path>
						</svg>	  
					</div>
					<div  class="z-40 shadow-lg text-center w-32 block absolute right-0 top-0 p-2 mt-12 rounded-lg bg-gray-800 text-white text-xs" style="display: none;">
						Reload Page
					</div>
				</div>
			</div>
		</div>

		<div class="flex mb-8 justify-between">
			<div class="w-2/4">
				<div class="mb-2 md:mb-1 md:flex items-center">
					<label class="w-32 text-gray-800 block font-bold text-sm uppercase tracking-wide  dark:text-light">Pedido Ref.Id.</label>
					<span class="mr-4 inline-block hidden md:block">:</span>
					<div class="flex-1">
					<input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-48 py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" id="inline-full-name" type="text"  value="{{isset($pedido->identificador) ? $pedido->identificador : ''}}" disabled>
					</div>
				</div>

				<div class="mb-2 md:mb-1 md:flex items-center">
					<label class="w-32 text-gray-800 block font-bold text-sm uppercase tracking-wide  dark:text-light">Data do Pedido</label>
					<span class="mr-4 inline-block hidden md:block">:</span>
					<div class="flex-1">
					<input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-48 py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500 js-datepicker" type="text" id="datepicker1" value="{{isset($pedido->created_at) ?  \Carbon\Carbon::parse($pedido->created_at)->format('d/m/Y  H:i:s') : ''}}" disabled >
					</div>
				</div>

				
			</div>
			<div>
            @php
                $cliente = \App\Models\User::find($pedido->user_id);
                @endphp
				<div class="w-32 h-32 mb-1 border rounded-lg overflow-hidden relative bg-gray-100">
					<img id="image" class="object-cover w-full h-32" src="{{isset($cliente->profile_photo_url) ? $cliente->profile_photo_url : 'https://placehold.co/300x300/e2e8f0/e2e8f0'}}">
					
				</div>
			
			</div>
		</div>

		<div class="flex flex-wrap justify-between mb-8">
			<div class="w-full md:w-1/3 mb-2 md:mb-0">
				<label class="text-gray-800 block mb-1 font-bold text-sm uppercase tracking-wide  dark:text-light  dark:text-light">Detalhes do Comprador:</label>
                
				<input class="mb-1 bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" id="inline-full-name" type="text" value="{{isset($cliente->name) ? $cliente->name : 'Nome não informado'}}" disabled >
				<input class="mb-1 bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" id="inline-full-name" type="text" value="{{isset($cliente->email) ? $cliente->email : 'Email não informado'}}" disabled >
				<input class="mb-1 bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" id="inline-full-name" type="text" value="CPF: {{isset($cliente->cpf) ? $cliente->cpf : 'CPF não informado'}}" disabled >
				@if(isset($pedido->nota_vendedor))
				<textarea name="textarea" class="mb-1 bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" rows="3" cols="10" disabled>NOTA ADICIONAL:{{$pedido->nota_vendedor}}</textarea>
			@endif
			</div>
			<div class="w-full md:w-1/3">
				<label class="text-gray-800 block mb-1 font-bold text-sm uppercase tracking-wide  dark:text-light">Fornecedor:</label>
				<input class="mb-1 bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" id="inline-full-name" type="text" value="LOJINHA LARAVEL LTDA" disabled>

				<input class="mb-1 bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" id="inline-full-name" type="text" value="lojinha@ficticia.com" disabled>

				<input class="mb-1 bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" id="inline-full-name" type="text" value="CNPJ: 12345678900000" disabled>
			</div>
		</div>

		<div class="flex -mx-1 border-b py-2 items-start">
			<div class="flex-1 px-1">
				<p class="text-gray-800 uppercase tracking-wide text-sm font-bold  dark:text-light">Descrição</p>
			</div>

			<div class="px-1 w-20 text-right">
				<p class="text-gray-800 uppercase tracking-wide text-sm font-bold  dark:text-light">Quantidade</p>
			</div>

			<div class="px-1 w-32 text-right">
				<p class="leading-none">
					<span class="block uppercase tracking-wide text-sm font-bold text-gray-800  dark:text-light">Preço</span>
					<span class="font-medium text-xs text-gray-500  dark:text-light  dark:text-light">(taxas e descontos não incluidos)</span>
				</p>
			</div>

			<div class="px-1 w-32 text-right">
				<p class="leading-none">
					<span class="block uppercase tracking-wide text-sm font-bold text-gray-800  dark:text-light">SKU</span>
				
				</p>
			</div>

		</div>
	    <template>
			<div class="flex -mx-1 py-2 border-b">
				<div class="flex-1 px-1">
					<p class="text-gray-800" ></p>
				</div>

				<div class="px-1 w-20 text-right">
					<p class="text-gray-800" ></p>
				</div>

				<div class="px-1 w-32 text-right">
					<p class="text-gray-800" ></p>
				</div>

				<div class="px-1 w-32 text-right">
					<p class="text-gray-800" ></p>
				</div>

			
			</div>
		</template>
@foreach($pedido->items as $item)
			<div class="flex -mx-1 py-2 border-b">
				<div class="flex-1 px-1">
					<p class="text-gray-800  dark:text-light" >{{$item->produto->nome_produto}}</p>
				</div>

				<div class="px-1 w-20 text-right">
					<p class="text-gray-800  dark:text-light" >{{$item->quantidade_total}}</p>
				</div>

				<div class="px-1 w-32 text-right">
					<p class="text-gray-800  dark:text-light" >R$ {{$item->valor_comprado}}</p>
				</div>

				<div class="px-1 w-32 text-right">
					<p class="text-gray-800   dark:text-light" >SKU: {{$item->produto->sku}} </p>
				</div>

				
			</div>
		@endforeach
			

		<div class="py-2 ml-auto mt-5 w-full sm:w-2/4 lg:w-1/4">
			<div class="flex justify-between mb-3">
				<div class="text-gray-800 text-right flex-1  dark:text-light">Total Bruto</div>
				<div class="text-right w-40">
					<div class="text-gray-800 font-medium  dark:text-light" >R$: {{$pedido->subtotal_pedido}}</div>
				</div>
			</div>
            <div class="flex justify-between mb-4">
				<div class="text-sm text-gray-600 text-right flex-1  dark:text-light">Descontos Aplicados</div>
				<div class="text-right w-40">
					<div class="text-sm text-gray-600  dark:text-light  dark:text-light" >R$: - {{$pedido->desconto_total_pedido}}</div>
				</div>
			</div>
			<div class="flex justify-between mb-4">
				<div class="text-sm text-gray-600 text-right flex-1  dark:text-light">Total com taxas e descontos aplicados</div>
				<div class="text-right w-40">
					<div class="text-sm text-gray-600  dark:text-light" >R$: {{$pedido->valor_total_pedido}}</div>
				</div>
			</div>
		
			<div class="py-2 border-t border-b">
				<div class="flex justify-between">
					<div class="text-xl text-gray-600 text-right flex-1  dark:text-light">Total Pago</div>
					<div class="text-right w-40">
						<div class="text-xl text-gray-800 font-bold  dark:text-light" >R$: {{$pedido->valor_total_pedido}}</div>
					</div>
				</div>
			</div>
		</div>

		

		<!-- Print Template -->
		<div id="js-print-template"  class="hidden">
			<div class="mb-8 flex justify-between">
				<div>
					<h2 class="text-3xl font-bold mb-6 pb-2 tracking-wider uppercase ">Pedido</h2>

					<div class="mb-1 flex items-center">
						<label class="w-32 text-gray-800 block font-bold text-xs uppercase tracking-wide">Pedido Ref.Id.</label>
						<span class="mr-4 inline-block">:</span>
						<div >{{isset($pedido->identificador) ? $pedido->identificador : ''}}</div>
					</div>
		
					<div class="mb-1 flex items-center">
						<label class="w-32 text-gray-800 block font-bold text-xs uppercase tracking-wide">Data da Compra</label>
						<span class="mr-4 inline-block">:</span>
						<div >{{isset($pedido->created_at) ?  \Carbon\Carbon::parse($pedido->created_at)->format('d/m/Y  H:i:s') : ''}}</div>
					</div>
		
					
				</div>
				<div class="pr-5">
					<div class="w-32 h-32 mb-1 overflow-hidden">
						<img id="image2" class="object-cover w-20 h-20" src="{{isset($cliente->profile_photo_url) ? $cliente->profile_photo_url : 'https://placehold.co/300x300/e2e8f0/e2e8f0'}}"> 
					</div>
				</div>
			</div>

			<div class="flex justify-between mb-10">
				<div class="w-1/2">
					<label class="text-gray-800 block mb-2 font-bold text-xs uppercase tracking-wide">Detalhes do Comprador:</label>
					<div>
						<div >{{isset($cliente->name) ? $cliente->name : 'Nome não informado'}}</div>
						<div >{{isset($cliente->email) ? $cliente->email : 'Email não informado'}}</div>
						<div >CPF: {{isset($cliente->cpf) ? $cliente->cpf : 'CPF não informado'}}</div>
					</div>
				</div>
				<div class="w-1/2">
					<label class="text-gray-800 block mb-2 font-bold text-xs uppercase tracking-wide">Fornecedor:</label>
					<div>
						<div >LOJINHA LARAVEL LTDA</div>
						<div >lojinha@ficticia.com</div>
						<div >CNPJ: 12345678900000</div>
					</div>
				</div>
			</div>

			<div class="flex flex-wrap -mx-1 border-b py-2 items-start">
				<div class="flex-1 px-1">
					<p class="text-gray-600 uppercase tracking-wide text-xs font-bold">Descrição</p>
				</div>
	
				<div class="px-1 w-32 text-right">
					<p class="text-gray-600 uppercase tracking-wide text-xs font-bold">Quantidade</p>
				</div>
	
				<div class="px-1 w-32 text-right">
					<p class="leading-none">
						<span class="block uppercase tracking-wide text-xs font-bold text-gray-600">Preço</span>
						<span class="font-medium text-xs text-gray-500">(taxas e descontos não incluidos)</span>
					</p>
				</div>
	
				<div class="px-1 w-32 text-right">
					<p class="leading-none">
						<span class="block uppercase tracking-wide text-xs font-bold text-gray-600">SKU</span>
						
					</p>
				</div>
			</div>
			<template>
				<div class="flex flex-wrap -mx-1 py-2 border-b">
					<div class="flex-1 px-1">
						<p class="text-gray-800" ></p>
					</div>
	
					<div class="px-1 w-32 text-right">
						<p class="text-gray-800" ></p>
					</div>
	
					<div class="px-1 w-32 text-right">
						<p class="text-gray-800" ></p>
					</div>
	
					<div class="px-1 w-32 text-right">
						<p class="text-gray-800" ></p>
					</div>
				</div>
			</template>

			@foreach($pedido->items as $item)
				<div class="flex flex-wrap -mx-1 py-2 border-b">
					<div class="flex-1 px-1">
						<p class="text-gray-800" >{{$item->produto->nome_produto}}</p>
					</div>
	
					<div class="px-1 w-32 text-right">
						<p class="text-gray-800" >{{$item->quantidade_total}}</p>
					</div>
	
					<div class="px-1 w-32 text-right">
						<p class="text-gray-800" >R$ {{$item->valor_comprado}}</p>
					</div>
	
					<div class="px-1 w-32 text-right">
						<p class="text-gray-800" >SKU: {{$item->produto->sku}}</p>
					</div>
				</div>
			@endforeach
			
			<div class="py-2 ml-auto mt-20" style="width: 320px">
				<div class="flex justify-between mb-3">
					<div class="text-gray-800 text-right flex-1">Total Bruto</div>
					<div class="text-right w-40">
						<div class="text-gray-800 font-medium" >R$: {{$pedido->subtotal_pedido}}</div>
					</div>
				</div>
				<div class="flex justify-between mb-4">
					<div class="text-sm text-gray-600 text-right flex-1">Descontos Aplicados</div>
					<div class="text-right w-40">
						<div class="text-sm text-gray-600" >R$: {{$pedido->valor_total_pedido}}</div>
					</div>
				</div>
			
				<div class="py-2 border-t border-b">
					<div class="flex justify-between">
						<div class="text-xl text-gray-600 text-right flex-1">Total Pago</div>
						<div class="text-right w-40">
							<div class="text-xl text-gray-800 font-bold" >R$: {{$pedido->valor_total_pedido}}</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /Print Template -->

	
<script>
    

function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
    </script>
	</div>
	@else
	<h1>Acesso Ilegal</h1>
	@endif 

@endsection