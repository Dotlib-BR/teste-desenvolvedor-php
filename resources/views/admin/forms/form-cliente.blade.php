@extends('layouts.dashboard')
@section('content')

<form @if(isset($usuario)) action="{{route('interno.clientes.update',$usuario->id)}}" @else  action="{{route('interno.clientes.store')}}" @endif  method="POST" enctype="multipart/form-data">
@if(isset($usuario))
            @method('PATCH') 
            @else 
            @method('POST')
            @endif   
           
<div class="min-h-screen bg-gray-100 py-6 flex flex-col justify-center sm:py-12 dark:border-primary-darker dark:bg-darker h-full">
  <div class="relative py-3 sm:max-w-xl sm:mx-auto">
    <div class="relative px-4 py-10 bg-white mx-8 md:mx-0 shadow rounded-3xl sm:p-10">
      <div class="max-w-md mx-auto">
        <div class="flex items-center space-x-5">
         
          <div class="block  font-semibold text-xl self-start text-gray-700">
            <h2 class="leading-relaxed">{{isset($usuario) ? 'Editar  Cliente: '.$usuario->name : 'Criar um novo Cliente' }}</h2>
            <p class="text-sm text-gray-500 font-normal leading-relaxed"> {{isset($usuario) ? 'Altere os dados abaixo para editar seu cliente' : 'Preencha os dados abaixo para criar um novo cliente' }} </p>
         
          </div>
        </div>
        <div class="divide-y divide-gray-200">
          <div class="py-8 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7">
            <div class="flex flex-col">
              <label class="leading-loose">Nome do Cliente</label>
              {!! csrf_field() !!}
              <input type="hidden"  name="seguro" value="@if(isset($usuario)){{$encryptado}}@endif">
              <input type="text" name="name" id="name" class="@error('name') border-red-600 @enderror px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600" value="{{isset($usuario) ? $usuario->name : '' }}" placeholder="Nome do cliente" required>
              @error('name')
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">

  <span class="block sm:inline">{{ $message }}</span>
  
</div>
   
@enderror
            </div>
            
            <div class="flex flex-col">
              <label class="leading-loose">Email</label>
              <input type="email" id="slug_input" name="email" class="@error('email') border-red-600 @enderror px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600" placeholder="Insira um email válido" value="{{isset($usuario) ? $usuario->email: '' }}" required>
              @error('email')
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">

  <span class="block sm:inline">{{ $message }}</span>
  
</div>
   
@enderror
            </div>
            <div class="flex flex-col">
              <label class="leading-loose">Cpf</label>
              <input type="number" min="0" id="cpf" name="cpf" class="@error('cpf') border-red-600 @enderror px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600" placeholder="Insira um cpf válido" value="{{isset($usuario) ? $usuario->cpf: '' }}" required>
              <a class="text-indigo-700 underline" target="_blank" href="https://www.geradordecpf.org/">Utilize este site para gerar cpf válidos para teste</a>
              @error('cpf')
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">

  <span class="block sm:inline">{{ $message }}</span>
  
</div>
   
@enderror
            </div>
            
            
           
           
            <div class="mb-2 text-gray-700"> <span>{{isset($usuario) ? 'Avatar' : 'Avatar - Opcional'}} </span>
                        <div class="relative h-40 rounded-lg border-dashed border-2 border-gray-200 bg-white flex justify-center items-center hover:cursor-pointer">
                            <div class="absolute">
                                <div class="flex flex-col items-center "> <i class="fa fa-cloud-upload fa-3x text-gray-200"></i> <span class="block text-gray-400 font-normal">Arraste sua imagem para cá</span> <span class="block text-gray-400 font-normal">ou</span> <span class="block text-blue-400 font-normal">Selecionar  arquivo</span> </div>
                            </div> <input type="file" id="imagem" name="imagem" class="h-full w-full opacity-0" >
                        </div>
                        <div class="flex justify-between items-center text-gray-400"> <span>Tipos de imagem aceitas:.png, .jpg, .gif</span> <span class="flex items-center "><i class="fa fa-lock mr-1"></i> </span>
                         </div>
                        <div id="bloco_upload" style="display:none;">
                        <h1 id="txt_carrega">Carregando...</h1>
                        <div class="h-3 relative max-w-xl rounded-full overflow-hidden">
        <div class="w-full h-full bg-gray-200 absolute"></div>
        <div id="bar" class="transition-all ease-out duration-1000 h-full bg-green-500 relative w-0"></div>
    </div>
</div>
                    </div>
                  
                    <div class="flex flex-col">
                    @if(isset($usuario))
  @if(is_null($usuario->email_verified_at))
                    <label class="flex justify-start items-start">
  <div class="bg-white border-2 rounded border-gray-400 w-6 h-6 flex flex-shrink-0 justify-center items-center mr-2 focus-within:border-blue-500">
  <input type="checkbox" name="verificado" id="chk" class="opacity-0 absolute" value="0" >
  <svg class="fill-current hidden w-4 h-4 text-green-500 pointer-events-none" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg>
  </div>
  <div class="select-none">Marcar email como verificado?</div>
</label>
  @endif
@else
<label class="flex justify-start items-start">
  <div class="bg-white border-2 rounded border-gray-400 w-6 h-6 flex flex-shrink-0 justify-center items-center mr-2 focus-within:border-blue-500">
<input type="checkbox" name="verificado" id="chk" class="opacity-0 absolute" value="0">
<svg class="fill-current hidden w-4 h-4 text-green-500 pointer-events-none" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg>
  </div>
  <div class="select-none">Marcar email como verificado?</div>
</label>

  @endif  
  
@error('verificado')
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">

  <span class="block sm:inline">{{ $message }}</span>
  
</div>
   
@enderror

                    </div>

              <div class="flex flex-col">
              <label class="leading-loose">{{isset($usuario) ? 'Editar senha do Cliente' : 'Crie uma senha'}}</label>
              <div class="py-2" x-data="{ show: true }">
                <span class="px-1 text-sm text-gray-600">{{isset($usuario) ? 'Por razões de segurança não é possivel visualizar a senha previamente salva. Deixe em branco para não alterar' : ''}}</span>
                <div class="relative">
                  <input  placeholder="" :type="show ? 'password' : 'text'" name="password" class="@error('passoword') border-red-600 @enderror text-md block px-3 py-2 rounded-lg w-full 
                bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md
                focus:placeholder-gray-500
                focus:bg-white 
                focus:border-gray-600  
                focus:outline-none"  {{isset($usuario) ? '' : 'required' }}>
                  <div class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5">

                    <svg class="h-6 text-gray-700" fill="none" @click="show = !show"
                      :class="{'hidden': !show, 'block':show }" xmlns="http://www.w3.org/2000/svg"
                      viewbox="0 0 576 512">
                      <path fill="currentColor"
                        d="M572.52 241.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400a144 144 0 1 1 144-144 143.93 143.93 0 0 1-144 144zm0-240a95.31 95.31 0 0 0-25.31 3.79 47.85 47.85 0 0 1-66.9 66.9A95.78 95.78 0 1 0 288 160z">
                      </path>
                    </svg>

                    <svg class="h-6 text-gray-700" fill="none" @click="show = !show"
                      :class="{'block': !show, 'hidden':show }" xmlns="http://www.w3.org/2000/svg"
                      viewbox="0 0 640 512">
                      <path fill="currentColor"
                        d="M320 400c-75.85 0-137.25-58.71-142.9-133.11L72.2 185.82c-13.79 17.3-26.48 35.59-36.72 55.59a32.35 32.35 0 0 0 0 29.19C89.71 376.41 197.07 448 320 448c26.91 0 52.87-4 77.89-10.46L346 397.39a144.13 144.13 0 0 1-26 2.61zm313.82 58.1l-110.55-85.44a331.25 331.25 0 0 0 81.25-102.07 32.35 32.35 0 0 0 0-29.19C550.29 135.59 442.93 64 320 64a308.15 308.15 0 0 0-147.32 37.7L45.46 3.37A16 16 0 0 0 23 6.18L3.37 31.45A16 16 0 0 0 6.18 53.9l588.36 454.73a16 16 0 0 0 22.46-2.81l19.64-25.27a16 16 0 0 0-2.82-22.45zm-183.72-142l-39.3-30.38A94.75 94.75 0 0 0 416 256a94.76 94.76 0 0 0-121.31-92.21A47.65 47.65 0 0 1 304 192a46.64 46.64 0 0 1-1.54 10l-73.61-56.89A142.31 142.31 0 0 1 320 112a143.92 143.92 0 0 1 144 144c0 21.63-5.29 41.79-13.9 60.11z">
                      </path>
                    </svg>

                  </div>
                </div>
              </div>
            
              @error('password')
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">

  <span class="block sm:inline">{{ $message }}</span>
  
</div>
   
@enderror
            </div> 
          </div>
          <div class="pt-4 flex items-center space-x-4">
              
              <button type="submit" class="bg-blue-500 flex justify-center items-center w-full text-white px-4 py-3 rounded-md focus:outline-none">{{isset($usuario) ? 'Editar Cliente': 'Criar Cliente' }}</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</form>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous"></script>
<script>

  

$('#imagem').change(function() {
       var filename = $('input[type=file]').val().split('\\').pop();
       $('#bloco_upload').show();
        
        let progress = 0;
        let invervalSpeed = 10;
        let incrementSpeed = 1;
       let bar = document.getElementById('bar');
            progressInterval = setInterval(function(){
                progress += incrementSpeed;
                bar.style.width = progress + "%";
                if(progress >= 100){
                    clearInterval(progressInterval);
                    setTimeout(function() { 
                      $('#txt_carrega').text(filename);
    }, 1000);
                   
                }
            }, invervalSpeed);
      
    });
    
</script>
@include('notify::messages')
@endsection