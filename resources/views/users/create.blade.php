@extends('layouts.main')

@section('content')
    <div class="container mx-auto py-6 px-4">
        <h1 class="font-bold text-5xl flex justify-center mt-4">
            Cadastrar usuário
        </h1>
        <div class="p-5">
            <div class="mt-2">
                @if (isset($findUser))
                    <form action="{{ route('update.user', $findUser->id) }}" method="POST">
                        <input type="hidden" name="_method" value="PUT">
                    @else
                        <form method="POST" action="{{ route('store.user') }}">
                @endif
                @csrf
                @if (session()->has('success_message'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                        role="alert">
                        <strong class="font-bold">Good!</strong>
                        <span class="block sm:inline">{{ session()->get('success_message') }}</span>
                    </div>
                @endif
                @if (count($errors) > 0)
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">Ops!</strong>
                        @foreach ($errors->all() as $error)
                            <span class="block sm:inline">{{ $error }}</span>
                        @endforeach
                    </div>
                @endif
                <div class="flex flex-col md:flex-row border-b border-gray-200 pb-4 mb-4">
                    <div class="w-64 font-bold h-6 mx-2 mt-3 text-gray-800">Informações pessoais</div>
                    <div class="flex-1 flex flex-col md:flex-row">
                        <div class="w-full flex-1 mx-2">
                            <div class="my-2 p-1 bg-white flex border border-gray-200 rounded">
                                <input placeholder="Nome do usuário" type="text" name="name"
                                    class="p-1 px-2 appearance-none outline-none w-full text-gray-800 "
                                    value="{{ isset($findUser->name) ? $findUser->name : old('name') }}"
                                    autocomplete="off">
                            </div>
                        </div>
                        <div class="w-full flex-1 mx-2">
                            <div class="my-2 p-1 bg-white flex border border-gray-200 rounded">
                                <input placeholder="Email do usuário" type="text" name="email"
                                    class="p-1 px-2 appearance-none outline-none w-full text-gray-800 "
                                    value="{{ isset($findUser->email) ? $findUser->email : old('email') }}"
                                    autocomplete="off">
                            </div>
                        </div>
                        <div class="w-full flex-1 mx-2">
                            <div class="my-2 p-1 bg-white flex border border-gray-200 rounded">
                                <input placeholder="CPF do usuário" type="text" name="CPF"
                                    class="p-1 px-2 appearance-none outline-none w-full text-gray-800 "
                                    value="{{ isset($findUser->CPF) ? $findUser->CPF : old('CPF') }}" autocomplete="off"
                                    maxlength="11">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col md:flex-row pb-4 mb-4">
                    <div class="w-64 font-bold h-6 mx-2 mt-3 text-gray-800">Segurança do usuário
                        <div class="text-xs font-normal leading-none text-gray-500">
                        </div>
                    </div>
                    <div class="flex-1">
                        <div class="flex-1">
                            <div class="flex flex-col md:flex-row">
                                <div class="w-full flex-1 mx-2">
                                    <div class="my-2 p-1 bg-white flex border border-gray-200 rounded">
                                        <input placeholder="Senha" name="password" type="password"
                                            class="p-1 px-2 appearance-none outline-none w-full text-gray-800 ">
                                    </div>
                                </div>
                                <div class="w-full flex-1 mx-2">
                                    <div class="my-2 p-1 bg-white flex border border-gray-200 rounded">
                                        <input placeholder="Confirme a senha" name="password_confirmation" type="password"
                                            class="p-1 px-2 appearance-none outline-none w-full text-gray-800 ">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col md:flex-row">
                    <div class="w-64 mx-2 font-bold h-6 mt-3 text-gray-800"></div>
                    <div class="flex-1 flex flex-col md:flex-row">
                        <button class="text-sm  mx-2 w-32 focus:outline-none flex justify-center px-4 py-2 rounded font-bold cursor-pointer 
                hover:bg-green-700 hover:text-green-100 
                bg-green-100 
                text-green-700 
                border duration-200 ease-in-out 
                border-green-600 transition">Salvar</button>
                        <a href="{{ route('home') }}" class="text-sm  mx-2 w-32 focus:outline-none flex justify-center px-4 py-2 rounded font-bold cursor-pointer 
                hover:bg-green-700 hover:text-green-100 
                bg-green-100 
                text-green-700 
                border duration-200 ease-in-out 
                border-green-600 transition">Voltar</a>
                    </div>
                </div>
                </form>
                </form>
            </div>
        </div>
    </div>
@endsection
