@extends('layouts.dashboard')
@section('content')
<form  action="{{route('cupom-store')}}" method="POST" enctype="multipart/form-data">
 
            @method('POST')
        
           
<div class="min-h-screen bg-gray-100 py-6 flex flex-col justify-center sm:py-12">
  <div class="relative py-3 sm:max-w-xl sm:mx-auto">
    <div class="relative px-4 py-10 bg-white mx-8 md:mx-0 shadow rounded-3xl sm:p-10">
      <div class="max-w-md mx-auto">
        <div class="flex items-center space-x-5">
         
          <div class="block  font-semibold text-xl self-start text-gray-700">
            <h2 class="leading-relaxed">Criar Novo Cupom</h2>
            <p class="text-sm text-gray-500 font-normal leading-relaxed">Crie um código promocional para um produto especifico</p>
            
          </div>
        </div>
        <div class="divide-y divide-gray-200">
          <div class="py-8 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7">
          <div class="flex flex-col">
              <label class="leading-loose">Anexar Cupom ao produto:</label>
              <label class="block mt-4">

  <select name="produto_cupom" class="form-select mt-1 block w-full">
   @foreach($produtos as $produto) <option value="{{$produto->id}}">{{$produto->nome_produto}}</option> @endforeach
  </select>
</label>

            </div>
            <div class="flex flex-col">
              <label class="leading-loose">Quantidade de Cupons a ser criado</label>
              {!! csrf_field() !!}
             <input type="number" min="1" max="100" step="0" name="quantidade_cupom"  class=" px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600"  placeholder="Quantidade de cupons" required>
            
            </div>
            <div class="flex flex-col">
              <label class="leading-loose">Porcentagem de Desconto a ser Aplicado</label>
              <label class="block mt-4">

  <select name="porcentagem_cupom" class="form-select mt-1 block w-full">
    <option value="100">100% de desconto(Produto Grátis)</option> 
    <option value="90">90% de desconto</option> 
    <option value="80">80% de desconto</option> 
    <option value="70">70% de desconto</option> 
    <option value="60">60% de desconto</option> 
    <option value="50">50% de desconto</option> 
    <option value="40">40% de desconto</option> 
    <option value="30">30% de desconto</option> 
    <option value="20">20% de desconto</option> 
    <option value="10">10% de desconto</option>
    <option value="5">5% de desconto</option> 
    <option value="1">1% de desconto</option> 
  </select>
</label>

            </div>
            <div class="flex flex-col">
              <label class="leading-loose">Condição para o Desconto</label>
              <label class="block mt-4">

  <select name="condicao_cupom" class="form-select mt-1 block w-full">
    <option value="0">Sem necessidade de Condição</option> 
    <option value="1">Se Total da compra for superior a R$ 100</option> 
    <option value="0">Se mais de 2 itens desse produto no carrinho(Não implementado)</option> 
    <option value="0">Se for primeira compra(Não implementado)</option> 
    <option value="0">Se for primeira compra deste produto(Não implementado)</option> 
    <option value="0">Se cliente tiver gasto mais de R$100 reais anteriormente(Não implementado)</option> 
    <option value="0">Se cliente nunca comprou este produto antes(Não implementado)</option> 
  </select>
</label>

            </div>
          <div class="pt-4 flex items-center space-x-4">
              
              <button type="submit" class="bg-blue-500 flex justify-center items-center w-full text-white px-4 py-3 rounded-md focus:outline-none">Cadastrar Cupom</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</form>
@include('notify::messages')
@endsection