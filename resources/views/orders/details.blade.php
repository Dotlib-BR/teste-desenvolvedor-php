@extends('layouts.main')

@section('content')
    <div class="antialiased sans-serif bg-gray-200">
        <div class="container mx-auto py-6 px-4">
            <h1 class="text-3xl py-4 border-b mb-10">CRUD de Clientes</h1>
            <div class="mb-4 flex justify-between items-center">
                <div class="flex-1 pr-4">
                    <div class="relative md:w-1/3">
                        <form action="{{ route('details.search') }}" method="GET">
                            <input type="search" name="query"
                                class="w-full pl-10 pr-4 py-2 rounded-lg shadow focus:outline-none focus:shadow-outline text-gray-600 font-medium"
                                placeholder="Buscar..." autocomplete="off" />

                            <input type="number" name="perPage"
                                class="w-full mt-1 pl-10 pr-4 py-2 inline-flex rounded-lg shadow focus:outline-none focus:shadow-outline text-gray-600 font-medium"
                                placeholder="Resultados por página" autocomplete="off" />

                            <div class="absolute top-0 left-0 inline-flex items-center p-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-400" viewBox="0 0 24 24"
                                    stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <rect x="0" y="0" width="24" height="24" stroke="none"></rect>
                                    <circle cx="10" cy="10" r="7" />
                                    <line x1="21" y1="21" x2="15" y2="15" />
                                </svg>
                            </div>
                            <div>
                                <select name="order_by"
                                    class="w-full pl-10 pr-4 py-2 rounded-lg shadow focus:outline-none focus:shadow-outline text-gray-600 font-medium mt-2">
                                    <option disabled selected value>Selecione a ordem</option>
                                    <option value="asc">Crescente</option>
                                    <option value="desc">Decrescente</option>
                                </select>
                            </div>
                    </div>
                </div>
                <div class="text-gray-600 text-center">
                    <input type="checkbox" name="check_date">
                    Filtrar por data
                    <div class="rounded-lg flex">
                        <div class="relative">
                            <input type="date"
                                class="rounded-lg inline-flex items-center bg-white hover:text-blue-500 focus:outline-none 
                                                                                                focus:shadow-outline text-gray-500 font-semibold py-2 px-2 md:px-4"
                                name="start_date" />
                            <input type="date"
                                class="rounded-lg inline-flex items-center bg-white hover:text-blue-500 focus:outline-none 
                                                                                                focus:shadow-outline text-gray-500 font-semibold py-2 px-2 md:px-4"
                                name="end_date" />
                        </div>
                    </div>
                    <button type="submit"
                        class="bg-gray-800 text-white rounded-full p-2 flex hover:bg-gray-700 mt-2">Filtrar
                        resultados</button>
                    </form>
                </div>
            </div>

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
            @if (session()->has('success_message'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mt-4"
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
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Número do pedido
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Produto
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Custo
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Desconto
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Status
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Data da compra
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($myOrderResults))
                                @foreach ($myOrderResults as $filter)
                                <tr>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <div class="flex items-center">
                                            <div class="ml-3">
                                                <p class="text-gray-900 whitespace-no-wrap">
                                                    {{ $filter->id }}
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        {{ Str::limit($filter->product, 30, '') }}
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap">
                                            R${{ $filter->cost }}
                                        </p>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap">
                                            R${{ $filter->discount }}
                                        </p>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap">
                                            {{ $filter->status }}
                                        </p>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap">
                                            {{ $filter->created_at->format('d-m-Y') }}, às
                                            {{ $filter->created_at->format('H:i:s') }}
                                        </p>
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                <div>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                <div class="flex items-center">
                                                    <div class="ml-3">
                                                        <p class="text-gray-900 whitespace-no-wrap">
                                                            {{ $order->id }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                {{ Str::limit($order->product, 30, '') }}
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                <p class="text-gray-900 whitespace-no-wrap">
                                                    R${{ $order->cost }}
                                                </p>
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                <p class="text-gray-900 whitespace-no-wrap">
                                                    R${{ $order->discount }}
                                                </p>
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                <p class="text-gray-900 whitespace-no-wrap">
                                                    {{ $order->status }}
                                                </p>
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                <p class="text-gray-900 whitespace-no-wrap">
                                                    {{ $order->created_at->format('d-m-Y') }}, às
                                                    {{ $order->created_at->format('H:i:s') }}
                                                </p>
                                            </td>
                                        </tr>
                                    @endforeach
                            @endif
                        </tbody>
                    </table>
                    @if (isset($myOrderResults))
                        <div
                            class="px-5 py-5 bg-white border-t flex flex-col xs:flex-row items-center xs:justify-between          ">
                            <span class="text-xs xs:text-sm text-gray-900">
                                Mostrando {{ $myOrderResults->count() }} de
                                {{ $myOrderResults->total() }} resultados
                            </span>
                            <div class="inline-flex mt-2 xs:mt-0">
                                @if ($myOrderResults->previousPageUrl() != null)
                                    <a href="{{ $myOrderResults->appends(Request::all())->previousPageUrl() }}"
                                        class="text-sm bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-r">
                                        Anterior
                                    </a>
                                @else

                                @endif
                                @if ($myOrderResults->nextPageUrl() != null)
                                    <a href="{{ $myOrderResults->appends(Request::all())->nextPageUrl() }}"
                                        class="text-sm bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-r">
                                        Próxima
                                    </a>
                                @else

                                @endif
                            </div>
                        </div>
                    @else
                        <div
                            class="px-5 py-5 bg-white border-t flex flex-col xs:flex-row items-center xs:justify-between          ">
                            <span class="text-xs xs:text-sm text-gray-900">
                                Mostrando {{ $orders->count() }} de
                                {{ $orders->total() }} resultados
                            </span>
                            <div class="inline-flex mt-2 xs:mt-0">
                                @if ($orders->previousPageUrl() != null)
                                    <a href="{{ $orders->previousPageUrl() }}"
                                        class="text-sm bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-r">
                                        Anterior
                                    </a>
                                @else

                                @endif
                                @if ($orders->nextPageUrl() != null)
                                    <a href="{{ $orders->nextPageUrl() }}"
                                        class="text-sm bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-r">
                                        Próxima
                                    </a>
                                @else

                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
