<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>CRUD</title>
</head>

<body>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
    <header class="w-full">
        <nav class="bg-white shadow-lg">
            <div class="md:flex items-center justify-between py-2 px-8 md:px-12">
                <div class="flex justify-between items-center">
                    <div class="text-2xl font-bold text-gray-800 md:text-3xl">
                        <a href="{{ route('home') }}">TesteJR</a>
                    </div>
                    <div class="md:hidden">
                        <button type="button"
                            class="block text-gray-800 hover:text-gray-700 focus:text-gray-700 focus:outline-none">
                            <svg class="h-6 w-6 fill-current" viewBox="0 0 24 24">
                                <path class="hidden"
                                    d="M16.24 14.83a1 1 0 0 1-1.41 1.41L12 13.41l-2.83 2.83a1 1 0 0 1-1.41-1.41L10.59 12 7.76 9.17a1 1 0 0 1 1.41-1.41L12 10.59l2.83-2.83a1 1 0 0 1 1.41 1.41L13.41 12l2.83 2.83z" />
                                <path
                                    d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z" />
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="flex flex-col md:flex-row hidden md:block -mx-2">
                    <a href="{{ route('home') }}"
                        class="text-gray-800 rounded hover:bg-gray-900 hover:text-gray-100 hover:font-medium py-2 px-2 md:mx-2">Home</a>
                    @if (Auth::user())
                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();"
                            class="text-gray-800 rounded hover:bg-gray-900 hover:text-gray-100 hover:font-medium py-2 px-2 md:mx-2">Logout</a>
                        <a href="{{ route('product.index') }}"
                            class="text-gray-800 rounded hover:bg-gray-900 hover:text-gray-100 hover:font-medium py-2 px-2 md:mx-2">Produtos</a>
                        <a href="{{ route('orders.index') }}"
                            class="text-gray-800 rounded hover:bg-gray-900 hover:text-gray-100 hover:font-medium py-2 px-2 md:mx-2">Ver
                            compras</a>
                        <a href="{{ route('ver.index') }}"
                            class="text-gray-800 rounded hover:bg-gray-900 hover:text-gray-100 hover:font-medium py-2 px-2 md:mx-2">Minhas
                            compras</a>
                    @else
                        <a href="{{ route('login') }}"
                            class="text-gray-800 rounded hover:bg-gray-900 hover:text-gray-100 hover:font-medium py-2 px-2 md:mx-2">Login</a>
                        <a href="{{ route('register') }}"
                            class="text-gray-800 rounded hover:bg-gray-900 hover:text-gray-100 hover:font-medium py-2 px-2 md:mx-2">Cadastro</a>
                    @endif
                </div>
            </div>
        </nav>
    </header>
    @yield('content')
    <footer class="bg-gray-100">
        <div class="max-w-6xl m-auto text-gray-800 flex flex-wrap justify-center">
            <div class="p-5 w-48 ">
                <div class="text-xs uppercase text-gray-500 font-medium">Home</div>
                <a class="my-3 block" href="/#">Serviços <span class="text-teal-600 text-xs p-1"></span></a><a
                    class="my-3 block" href="/#">Produtos <span class="text-teal-600 text-xs p-1"></span></a><a
                    class="my-3 block" href="/#">Sobre nós <span class="text-teal-600 text-xs p-1"></span></a><a
                    class="my-3 block" href="/#">Preços <span class="text-teal-600 text-xs p-1"></span></a><a
                    class="my-3 block" href="/#">Patrocinadores <span class="text-teal-600 text-xs p-1">Novo</span></a>
            </div>
            @if (!Auth::user())
                <div class="p-5 w-48 ">
                    <div class="text-xs uppercase text-gray-500 font-medium">Usuário</div>
                    <a class="my-3 block" href="{{ route('login') }}">Login <span
                            class="text-teal-600 text-xs p-1"></span></a>
                    <a class="my-3 block" href="{{ route('register') }}">Cadastrar <span
                            class="text-teal-600 text-xs p-1"></span></a>
                </div>
            @endif
            <div class="p-5 w-48 ">
                <div class="text-xs uppercase text-gray-500 font-medium">Recursos</div>
                <a class="my-3 block" href="/#">Documentação <span class="text-teal-600 text-xs p-1"></span></a><a
                    class="my-3 block" href="/#">Tutoriais <span class="text-teal-600 text-xs p-1"></span></a><a
                    class="my-3 block" href="/#">Suporte <span class="text-teal-600 text-xs p-1">Novo</span></a>
            </div>
            <div class="p-5 w-48 ">
                <div class="text-xs uppercase text-gray-500 font-medium">Produto</div>
                <a class="my-3 block" href="/#">Nossos produtos <span class="text-teal-600 text-xs p-1"></span></a><a
                    class="my-3 block" href="/#">Analytics <span class="text-teal-600 text-xs p-1"></span></a><a
                    class="my-3 block" href="/#">Mobile <span class="text-teal-600 text-xs p-1"></span></a>
            </div>
            <div class="p-5 w-48 ">
                <div class="text-xs uppercase text-gray-500 font-medium">Suporte</div>
                <a class="my-3 block" href="/#">Central de ajuda <span class="text-teal-600 text-xs p-1"></span></a><a
                    class="my-3 block" href="/#">Políticas de privacidade <span
                        class="text-teal-600 text-xs p-1"></span></a><a class="my-3 block" href="/#">Condições <span
                        class="text-teal-600 text-xs p-1"></span></a>
            </div>
            <div class="p-5 w-48 ">
                <div class="text-xs uppercase text-gray-500 font-medium">Contato</div>
                <a class="my-3 block" href="/#">contato@devJR.com<span class="text-teal-600 text-xs p-1"></span></a><a
                    class="my-3 block" href="/#">contato@laravel.com
                    <span class="text-teal-600 text-xs p-1"></span></a>
            </div>
        </div>
        </div>

        <div class="bg-gray-100 pt-2 ">
            <div class="flex pb-5 px-3 m-auto pt-5 border-t text-gray-800 text-sm flex-col
           md:flex-row max-w-6xl">
                <div class="md:flex-auto md:flex-row-reverse mt-2 flex-row flex">
                    <a href="https://www.linkedin.com/in/felipe-luz-oliveira/" class="w-6 mx-1">
                        <svg class="fill-current cursor-pointer text-gray-500 hover:text-gray-400" width="100%"
                            height="100%" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve"
                            xmlns:serif="http://www.serif.com/"
                            style="fill-rule: evenodd; clip-rule: evenodd; stroke-linejoin: round; stroke-miterlimit: 2;">
                            <path id="Shape" d="M7.3,0.9c1.5,-0.6 3.1,-0.9 4.7,-0.9c1.6,0 3.2,0.3 4.7,0.9c1.5,0.6 2.8,1.5
                       3.8,2.6c1,1.1 1.9,2.3 2.6,3.8c0.7,1.5 0.9,3 0.9,4.7c0,1.7 -0.3,3.2
                       -0.9,4.7c-0.6,1.5 -1.5,2.8 -2.6,3.8c-1.1,1 -2.3,1.9 -3.8,2.6c-1.5,0.7
                       -3.1,0.9 -4.7,0.9c-1.6,0 -3.2,-0.3 -4.7,-0.9c-1.5,-0.6 -2.8,-1.5
                       -3.8,-2.6c-1,-1.1 -1.9,-2.3 -2.6,-3.8c-0.7,-1.5 -0.9,-3.1 -0.9,-4.7c0,-1.6
                       0.3,-3.2 0.9,-4.7c0.6,-1.5 1.5,-2.8 2.6,-3.8c1.1,-1 2.3,-1.9
                       3.8,-2.6Zm-0.3,7.1c0.6,0 1.1,-0.2 1.5,-0.5c0.4,-0.3 0.5,-0.8 0.5,-1.3c0,-0.5
                       -0.2,-0.9 -0.6,-1.2c-0.4,-0.3 -0.8,-0.5 -1.4,-0.5c-0.6,0 -1.1,0.2
                       -1.4,0.5c-0.3,0.3 -0.6,0.7 -0.6,1.2c0,0.5 0.2,0.9 0.5,1.3c0.3,0.4 0.9,0.5
                       1.5,0.5Zm1.5,10l0,-8.5l-3,0l0,8.5l3,0Zm11,0l0,-4.5c0,-1.4 -0.3,-2.5
                       -0.9,-3.3c-0.6,-0.8 -1.5,-1.2 -2.6,-1.2c-0.6,0 -1.1,0.2 -1.5,0.5c-0.4,0.3
                       -0.8,0.8 -0.9,1.3l-0.1,-1.3l-3,0l0.1,2l0,6.5l3,0l0,-4.5c0,-0.6 0.1,-1.1
                       0.4,-1.5c0.3,-0.4 0.6,-0.5 1.1,-0.5c0.5,0 0.9,0.2 1.1,0.5c0.2,0.3 0.4,0.8
                       0.4,1.5l0,4.5l2.9,0Z"></path>
                        </svg>
                    </a>
                    <a href="https://github.com/felipebrsk" class="w-6 mx-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            class="fill-current cursor-pointer text-gray-500 hover:text-gray-400">
                            <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 
                                1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 
                                0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 
                                3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 
                                .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z" />
                        </svg>
                    </a>
                </div>
            </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" defer></script>
</body>

</html>
