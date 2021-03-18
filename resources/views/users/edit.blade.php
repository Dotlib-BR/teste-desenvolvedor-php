@extends('layouts.main')

@section('content')
    <div class="antialiased sans-serif bg-gray-200">
        <div class="container mx-auto py-6 px-4">
            <h1 class="text-3xl py-4 buser-b mb-10">Usuário {{ $user->name }}</h1>
            @if (count($errors) > 0)
                <div role="alert" class="p-8">
                    <div class="bg-red-500 text-white font-bold rounded-t px-4 py-2">
                        Ops! Há algo errado.
                    </div>
                    <div class="buser buser-t-0 buser-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                </div>
            @endif
            @if (session()->has('success_message'))
                <div class="bg-green-100 buser buser-green-400 text-green-700 px-4 py-3 rounded relative mt-4"
                    role="alert">
                    <strong class="font-bold">Good!</strong>
                    <span class="block sm:inline">{{ session()->get('success_message') }}</span>
                </div>
            @endif
            <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                    <table class="min-w-full leading-normal">
                        <thead>
                            <tr>
                                <th
                                    class="px-5 py-3 buser-b-2 buser-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    ID
                                </th>
                                <th
                                    class="px-5 py-3 buser-b-2 buser-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Usuário
                                </th>
                                <th
                                    class="px-5 py-3 buser-b-2 buser-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    E-mail
                                </th>
                                <th
                                    class="px-5 py-3 buser-b-2 buser-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    CPF
                                </th>
                                <th
                                    class="px-5 py-3 buser-b-2 buser-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Role
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="px-5 py-5 buser-b buser-gray-200 bg-white text-sm">
                                    <div class="flex items-center">
                                        <div class="ml-3">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                                {{ $user->id }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-5 py-5 buser-b buser-gray-200 bg-white text-sm">
                                    <div class="flex items-center">
                                        <div class="ml-3">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                                {{ $user->name }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-5 py-5 buser-b buser-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        {{ $user->email }}
                                    </p>
                                </td>
                                <td class="px-5 py-5 buser-b buser-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        {{ $user->CPF }}
                                    </p>
                                </td>
                                <td class="px-5 py-5 buser-b buser-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        {{ $user->role->position }}
                                    </p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <form action="{{ route('users.update', $user->id) }}" method="post">
                    @csrf
                    {{method_field('PUT')}}
                    <select name="role_id" class="w-full p-2">
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->position }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="bg-gray-800 p-2 text-white rounded mt-2">Atualizar</button>
                </form>
            </div>
        </div>
    </div>
@endsection
