@extends('layouts.main')

@section('content')
    <section class="text-gray-700 body-font overflow-hidden bg-white">
        <div class="container px-5 py-24 mx-auto">
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
            <div class="lg:w-4/5 mx-auto flex flex-wrap">
                <img alt="ecommerce" class="lg:w-1/2 w-full object-cover object-center rounded border border-gray-200"
                    src="https://www.whitmorerarebooks.com/pictures/medium/2465.jpg">
                <div class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
                    <form action="{{ route('orders.store') }}" method="POST" id="buy_form">
                        @csrf
                        <h2 class="text-sm title-font text-gray-500 tracking-widest">{{ $findProduct->bar_code }}</h2>
                        <h1 class="text-gray-900 text-3xl title-font font-medium mb-1">{{ $findProduct->product }}</h1>
                        <div class="flex mb-4">
                            <span class="flex items-center">
                                <svg fill="currentColor" stroke="currentColor" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-width="2" class="w-4 h-4 text-red-500"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z">
                                    </path>
                                </svg>
                                <svg fill="currentColor" stroke="currentColor" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-width="2" class="w-4 h-4 text-red-500"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z">
                                    </path>
                                </svg>
                                <svg fill="currentColor" stroke="currentColor" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-width="2" class="w-4 h-4 text-red-500"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z">
                                    </path>
                                </svg>
                                <svg fill="currentColor" stroke="currentColor" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-width="2" class="w-4 h-4 text-red-500"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z">
                                    </path>
                                </svg>
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" class="w-4 h-4 text-red-500" viewBox="0 0 24 24">
                                    <path
                                        d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z">
                                    </path>
                                </svg>
                                <span class="text-gray-600 ml-3">4 avaliações</span>
                            </span>
                        </div>
                        <p class="leading-relaxed">Fam locavore kickstarter distillery. Mixtape chillwave tumeric sriracha
                            taximy chia microdosing tilde DIY. XOXO fam indxgo juiceramps cornhole raw denim forage
                            brooklyn.
                            Everyday carry +1 seitan poutine tumeric. Gastropub blue bottle austin listicle pour-over,
                            neutra
                            jean shorts keytar banjo tattooed umami cardigan.</p>
                        <div class="mt-6 items-center justify-between pb-5 border-b-2 border-gray-200 mb-5">
                            <div class="items-center">
                                <div class="flex">
                                    <span class="mr-3">Qty</span>
                                    <div class="relative">
                                        <select name="qty"
                                            class="rounded border appearance-none border-gray-400 py-2 focus:outline-none focus:border-red-500 text-base pl-3 pr-10">
                                            <option selected value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                        </select>
                                        <span
                                            class="absolute right-0 top-0 h-full w-10 text-center text-gray-600 pointer-events-none flex items-center justify-center">
                                            <svg fill="none" stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="2" class="w-4 h-4"
                                                viewBox="0 0 24 24">
                                                <path d="M6 9l6 6 6-6"></path>
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex">
                            @if (session()->has('cupom'))
                                <span class="title-font font-medium text-2xl text-gray-900">R${{ $newSubtotal }}</span>
                            @else
                                <span
                                    class="title-font font-medium text-2xl text-gray-900">R${{ $findProduct->price }}</span>
                            @endif
                            <input type="hidden" name="cost" value="{{ $newSubtotal }}" />
                            <input type="hidden" name="product_name" value="{{ $findProduct->product }}" />
                            <input type="hidden" name="product_id" value="{{ $findProduct->id }}" />
                            <button form="buy_form" type="submit"
                                class="flex ml-auto text-white bg-red-500 border-0 py-2 px-6 focus:outline-none hover:bg-red-600 rounded">Comprar</button>
                            <button type="submit"
                                class="rounded-full w-10 h-10 bg-gray-200 p-0 border-0 inline-flex items-center justify-center text-red-500 ml-4">
                                <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    class="w-5 h-5" viewBox="0 0 24 24">
                                    <path
                                        d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z">
                                    </path>
                                </svg>
                            </button>
                        </div>
                    </form>
                    <div class="rounded text-black focus:outline-none focus:ring-purple-300 mt-6">
                        @if (session()->has('cupom'))
                            <form action="{{ route('discount.destroy', session()->get('cupom')) }}" method="POST">
                                @csrf
                                {{ method_field('DELETE') }}
                                <label for="coupon_code">Desconto: </label>
                                <span>{{ session()->get('cupom')['discount'] }}
                                    {{ session()->get('cupom')['name'] }}</span>
                                <button type="submit" class="rounded bg-gray-800 text-white p-1">Remover</button>
                            </form>
                        @else
                            <form action="{{ route('discount.store') }}" method="post" id="coupon_form">
                                @csrf
                                <label for="coupon_code">Código de cupom: </label>
                                <input type="text" name="coupon_code" class="outline-black ml-1" required
                                    id="coupon_code" />
                                <input type="hidden" name="cost" value="{{ $newSubtotal }}" />
                                <button type="submit" form="coupon_form"
                                    class="rounded bg-gray-800 text-white p-1">Aplicar</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
