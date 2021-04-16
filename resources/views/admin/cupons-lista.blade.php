@extends('layouts.dashboard')
@section('content')
<!-- component -->
<div class="antialiased sans-serif bg-gray-200 min-h-screen h-full dark:border-primary-darker dark:bg-darker h-full">

<style>
[x-cloak] {
    display: none;
}
</style>
<div class="container mx-auto py-6 px-4"  x-cloak>
<h1 class="text-3xl py-1 border-b mb-10 dark:text-light">Lista de Cupons</h1>
<a href="{{route('cupons-create')}}" class="bg-blue-500 hover:bg-blue-400 mr-3 text-white font-bold py-2 px-4 my-3 border-b-4 border-blue-700 hover:border-blue-500 rounded">
  Criar Novo Cupom
</a>
@if(!is_null($cupons))
<table class="border-collapse w-full">
    <thead>
        <tr>
            <th  class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Códigos Disponiveis</th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Vinculado ao Produto</th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Tipo de Desconto</th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Status</th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Cupons Criados</th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Cupons Regatados</th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Cupons Restantes</th>
            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Ações</th>
        </tr>
    </thead>
    <tbody>
    @php 
    $arrayContador=array();
    
    $resgatado=null;
     @endphp
    @foreach($unique as $unico)
        <tr class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
            <td  class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                <span  class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Códigos Disponiveis</span>
                <button id="abrir-codigos{{$unico->model_id}}" class="abrir-codigos{{$unico->model_id}} text-blue-400 hover:text-blue-600 underline pl-6">Ver Códigos</button>
            </td>
            <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Company name</span>
                @php 
                $produto = \App\Models\Produto::find($unico->model_id);
                @endphp {{$produto->nome_produto}}
            </td>
            <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Country</span>
                Desconto
            </td>
            <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Status</span>
                <span class="rounded bg-green-400 py-1 px-3 text-xs font-bold">Ativo</span>
          	</td>
            <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Country</span>
                @php $conta = \App\Models\Voucher::where('model_id',$produto->id)->count(); @endphp {{$conta}}
            </td>
            <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Country</span>
              
                   

            @php 
                $codigosR = \App\Models\Voucher::where('model_id','=',$produto->id)->get();
            @endphp
    
           @foreach($codigosR as $codigo)
             @php
               
               $comparaCupom = \DB::table('user_voucher')->where('voucher_id','=',$codigo->id)->first();
             @endphp
             
            @if(!is_null($comparaCupom))
           
                 @php
                 $usuarioResgate = \App\Models\User::find($comparaCupom->user_id);
                 @endphp
                 @if(!is_null($usuarioResgate))
                    @php $arrayContador[$produto->id][] = 1; @endphp
                  
                 @endif
            @else
               @php  $arrayContador[$produto->id][] = 0; @endphp
               
               
            @endif

             
        @endforeach
        @php  
         echo count(array_keys($arrayContador[$produto->id], 1));
        @endphp
        
               
            </td>
            <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Country</span>
                @php  echo count(array_keys($arrayContador[$produto->id], 0)); @endphp
            </td>
          
            <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Actions</span>
                
                <a href="#" class="text-blue-400 hover:text-blue-600 underline pl-6">Remover</a>
            </td>
        </tr>
        
    @php 
            $codigos = \App\Models\Voucher::where('model_id','=',$produto->id)->get();
           
           @endphp
    
     

          
           @foreach($codigos as $codigo)
           <tr class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0 codigos{{$produto->id}}"  id="codigos{{$produto->id}}" style="display:none;">
         
        
         
              <td  colspan="8" class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Country</span>
               @php
               
               $comparaCupom = \DB::table('user_voucher')->where('voucher_id','=',$codigo->id)->first();
               @endphp
               @if(!is_null($comparaCupom))
                 @php
                 $usuarioResgate = \App\Models\User::find($comparaCupom->user_id);
                 @endphp
                 @if(!is_null($usuarioResgate))
                 
                 <strike> {{$codigo->code}} </strike> <br/> 
                 <p>Resgatado por: {{$usuarioResgate->name}} - ID: {{$usuarioResgate->id}}</p>
                 <p>
                 @php $porcentagem = json_decode($codigo->data);
                 @endphp 
                 <span class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-indigo-100 @if($porcentagem->desconto_porcentagem <=10) bg-red-700 @elseif($porcentagem->desconto_porcentagem > 10 && $porcentagem->desconto_porcentagem <= 50  ) bg-indigo-700  @elseif($porcentagem->desconto_porcentagem > 50 &&  $porcentagem->desconto_porcentagem <= 70  ) bg-blue-700 @elseif($porcentagem->desconto_porcentagem > 70) bg-green-700 @endif rounded">
                 
                  {{$porcentagem->desconto_porcentagem}} % de desconto </span>
                 </p>
                <p>
                <span class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-indigo-100 bg-yellow-500 rounded">
                 
                @if($porcentagem->condicao_cupom ==="0") Condição: Nenhuma Condicao Aplicada @else Condicao: Compra Mínima de R$100 @endif</span>
                </p>
                 @endif
                @else
               {{$codigo->code}}
               
                 <p>
                 @php $porcentagem = json_decode($codigo->data);@endphp 
                 <span class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-indigo-100 @if($porcentagem->desconto_porcentagem <=10) bg-red-700 @elseif($porcentagem->desconto_porcentagem > 10 && $porcentagem->desconto_porcentagem <= 50  ) bg-indigo-700  @elseif($porcentagem->desconto_porcentagem > 50 &&  $porcentagem->desconto_porcentagem <= 70  ) bg-blue-700 @elseif($porcentagem->desconto_porcentagem > 70) bg-green-700 @endif rounded">
                 
                  {{$porcentagem->desconto_porcentagem}} % de desconto </span>
                 </p>
                 <p>
                <span class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-indigo-100 bg-yellow-500 rounded">
                 
                @if($porcentagem->condicao_cupom ==="0") Condição: Nenhuma Condicao Aplicada @else Condicao: Compra Mínima de R$100 @endif</span>
                </p>
                @endif

              </td>
        
        
             </tr> 
        @endforeach
        
       
      
    
   
      @endforeach
    </tbody>
</table>
@endif
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous"></script>
<script>
 $( document ).ready(function() {
var produtos = <?php echo json_encode($unique); ?>;  
console.log(produtos);
$.each( produtos, function( key, produto ) {
    
    var abrirCodigos = "abrir-codigos"+produto.model_id;
    var codigos = "codigos"+produto.model_id;

    $('#'+abrirCodigos).click(function() {
      console.log("XRP :)");  
       
    $('.'+codigos).slideToggle('fast');
        if ($(this).text() == "Ver Códigos")
            $(this).text("Ocultar")
        else
            $(this).text("Ver Códigos");
  
    });
 });

 });
  
</script>
</div>
</div>

@endsection