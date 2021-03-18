<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <title>TesteJR - Cadastro</title>
</head>

<body>

    <div class="container max-w-full mx-auto py-24 px-6">
        @if (count($errors) > 0)
            <div role="alert" class="p-8">
                <div class="bg-red-500 text-white font-bold rounded-t px-4 py-2">
                    Ops! Há algo errado.
                </div>
                <div class="border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            </div>
        @endif
        <div class="font-sans">
            <div class="max-w-sm mx-auto px-6">
                <div class="relative flex flex-wrap">
                    <div class="w-full relative">
                        <div class="mt-6">
                            <div class="text-center font-semibold text-black">
                                TesteJR - CADASTRO
                            </div>

                            <form class="mt-8" action="{{ route('register') }}" method="POST">
                                @csrf
                                <div class="mx-auto max-w-lg">
                                    <div class="py-2">
                                        <span class="px-1 text-sm text-gray-600">Usuário</span>
                                        <input placeholder="Insira um nome de usuário" type="text" name="name" value="{{ old('name') }}"
                                            class="text-md block px-3 py-2  rounded-lg w-full 
                              bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none">
                                    </div>
                                    <div class="py-2">
                                        <span class="px-1 text-sm text-gray-600">E-mail</span>
                                        <input placeholder="Insira um e-mail" type="email" name="email" value="{{ old('email') }}"
                                            class="text-md block px-3 py-2  rounded-lg w-full 
                              bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none">
                                    </div>
                                    <div class="py-2" x-data="{ show: true }">
                                        <span class="px-1 text-sm text-gray-600">Senha</span>
                                        <div class="relative">
                                            <input placeholder="Insira sua senha" type="password" name="password" class="text-md block px-3 py-2 rounded-lg w-full 
                              bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md
                              focus:placeholder-gray-500
                              focus:bg-white 
                              focus:border-gray-600  
                              focus:outline-none">
                                        </div>
                                    </div>
                                    <div class="py-2" x-data="{ show: true }">
                                        <span class="px-1 text-sm text-gray-600">Senha</span>
                                        <div class="relative">
                                            <input placeholder="Confirme a sua senha" type="password"
                                                name="password_confirmation" class="text-md block px-3 py-2 rounded-lg w-full 
                              bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md
                              focus:placeholder-gray-500
                              focus:bg-white 
                              focus:border-gray-600  
                              focus:outline-none">
                                        </div>
                                    </div>
                                    <button class="mt-3 text-lg font-semibold 
                              bg-gray-800 w-full text-white rounded-lg
                              px-6 py-3 block shadow-xl hover:text-white hover:bg-black">
                                        Cadastrar
                                    </button>

                                    <label class="block text-gray-500 font-bold my-4"><a href="#"
                                            class="cursor-pointer tracking-tighter text-black border-b-2 border-gray-200 hover:border-gray-400"><a
                                                href="{{ route('login') }}">Já possui uma conta?</a></a></label>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
