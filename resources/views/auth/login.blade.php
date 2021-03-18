<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <title>TesteJR - Login</title>
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
                                TesteJR - LOG IN
                            </div>

                            <form class="mt-8" action="{{ route('login') }}" method="POST">
                                @csrf
                                <div class="mx-auto max-w-lg">
                                    <div class="py-2">
                                        <span class="px-1 text-sm text-gray-600">E-mail</span>
                                        <input placeholder="Insira seu e-mail" type="email" name="email" value="{{ old('email') }}" autocomplete="off"
                                            class="text-md block px-3 py-2  rounded-lg w-full 
                              bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none" required>
                                    </div>
                                    <div class="py-2" x-data="{ show: true }">
                                        <span class="px-1 text-sm text-gray-600">Senha</span>
                                        <div class="relative">
                                            <input placeholder="Insira sua senha" type="password" name="password"
                                                :type="show ? 'password' : 'text'" class="text-md block px-3 py-2 rounded-lg w-full 
                              bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md
                              focus:placeholder-gray-500
                              focus:bg-white 
                              focus:border-gray-600  
                              focus:outline-none" required>
                                            <div
                                                class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5">

                                                <svg class="h-6 text-gray-700" fill="none" @click="show = !show"
                                                    :class="{'hidden': !show, 'block':show }"
                                                    xmlns="http://www.w3.org/2000/svg" viewbox="0 0 576 512">
                                                    <path fill="currentColor"
                                                        d="M572.52 241.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400a144 144 0 1 1 144-144 143.93 143.93 0 0 1-144 144zm0-240a95.31 95.31 0 0 0-25.31 3.79 47.85 47.85 0 0 1-66.9 66.9A95.78 95.78 0 1 0 288 160z">
                                                    </path>
                                                </svg>

                                                <svg class="h-6 text-gray-700" fill="none" @click="show = !show"
                                                    :class="{'block': !show, 'hidden':show }"
                                                    xmlns="http://www.w3.org/2000/svg" viewbox="0 0 640 512">
                                                    <path fill="currentColor"
                                                        d="M320 400c-75.85 0-137.25-58.71-142.9-133.11L72.2 185.82c-13.79 17.3-26.48 35.59-36.72 55.59a32.35 32.35 0 0 0 0 29.19C89.71 376.41 197.07 448 320 448c26.91 0 52.87-4 77.89-10.46L346 397.39a144.13 144.13 0 0 1-26 2.61zm313.82 58.1l-110.55-85.44a331.25 331.25 0 0 0 81.25-102.07 32.35 32.35 0 0 0 0-29.19C550.29 135.59 442.93 64 320 64a308.15 308.15 0 0 0-147.32 37.7L45.46 3.37A16 16 0 0 0 23 6.18L3.37 31.45A16 16 0 0 0 6.18 53.9l588.36 454.73a16 16 0 0 0 22.46-2.81l19.64-25.27a16 16 0 0 0-2.82-22.45zm-183.72-142l-39.3-30.38A94.75 94.75 0 0 0 416 256a94.76 94.76 0 0 0-121.31-92.21A47.65 47.65 0 0 1 304 192a46.64 46.64 0 0 1-1.54 10l-73.61-56.89A142.31 142.31 0 0 1 320 112a143.92 143.92 0 0 1 144 144c0 21.63-5.29 41.79-13.9 60.11z">
                                                    </path>
                                                </svg>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex justify-between"><label
                                            class="block text-gray-500 font-bold my-4"><input type="checkbox"
                                                class="leading-loose text-pink-600"> <span
                                                class="py-2 text-sm text-gray-600 leading-snug"> Lembrar-me
                                            </span></label>
                                        <label class="block text-gray-500 font-bold my-4"><a
                                                href="{{ route('password.request') }}"
                                                class="cursor-pointer tracking-tighter text-black border-b-2 border-gray-200 hover:border-gray-400"><span>Esqueceu
                                                    sua senha?</span></a></label>
                                    </div> <button class="mt-3 text-lg font-semibold 
                              bg-gray-800 w-full text-white rounded-lg
                              px-6 py-3 block shadow-xl hover:text-white hover:bg-black">
                                        Login
                                    </button>
                                    <label class="block text-gray-500 font-bold my-4">
                                        <span>Não possui uma conta?</span>
                                        <a href="{{ route('register') }}"
                                            class="cursor-pointer tracking-tighter text-black border-b-2 border-gray-200 hover:border-gray-400"><span>Cadastro</span></a></label>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" defer></script>
</body>

</html>
