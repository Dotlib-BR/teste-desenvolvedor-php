<div class="carousel relative container mx-auto" style="max-width:1600px;">
        <div class="carousel-inner relative overflow-hidden w-full">
            <!--Slide 1-->
            @foreach($destaques as $destaque)
            <input class="carousel-open" type="radio" id="carousel-{{$loop->index}}" name="carousel" aria-hidden="true" hidden="" checked="checked">
            <div class="carousel-item absolute opacity-0" style="height:50vh;">
                <div class="block h-full w-full mx-auto flex pt-6 md:pt-0 md:items-center bg-cover bg-right" style="background-image: url({{asset('imagens/fake_produtos')}}/{{$destaque->imagem}});">

                    <div class="container mx-auto">
                        <div class="flex flex-col w-full lg:w-1/2 md:ml-16 items-center md:items-start px-6 tracking-wide">
                            <p class="text-black text-2xl my-4">{{$destaque->nome_produto}}</p>
                            <a class="text-xl inline-block no-underline border-b border-gray-600 leading-relaxed hover:text-black hover:border-black" href="{{route('produtos-frontend',$destaque->slug)}}">Ver Produto</a>
                        </div>
                    </div>

                </div>
            </div>
            
          
            @endforeach
            
            
            <!-- Add additional indicators for each slide-->
            <ol class="carousel-indicators">
            @foreach($destaques as $destaque)
                <li class="inline-block mr-3">
                    <label for="carousel-{{$loop->index}}" class="carousel-bullet cursor-pointer block text-4xl text-gray-400 hover:text-gray-900">•</label>
                </li>
            @endforeach
            </ol>

        </div>
    </div>