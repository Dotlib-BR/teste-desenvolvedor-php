<section class="w-full mx-auto bg-nordic-gray-light flex pt-12 md:pt-0 md:items-center bg-cover bg-right {{isset($pagina) ? 'mb-14' : '' }}" style="max-width:1600px; height: {{isset($pagina) ? '15' : '32' }}rem; background-image: url('{{asset('imagens/header.jpg')}}');">

	<div class="container mx-auto">

		<div class="flex flex-col w-full lg:w-1/2 justify-center items-start  px-6 tracking-wide">
			<h1 class="text-black text-2xl my-4">{{isset($pagina) ? $pagina : 'BEM VINDO A NOSSA LOJA FICTÍCIA' }}</h1>
			
		</div>

	  </div>

</section>