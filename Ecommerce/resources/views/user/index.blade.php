@extends('layouts.master')
@section('title', 'Home')
@section('content')
    <section class="container">
        <div class="mt-5">
            <p class="welcome">
                Olá <b>{{ ucwords($currentUser['name'] . ' ' . $currentUser['last_name']) }}</b>, seja bem vindo!
            </p>
        </div>
    </section>
    <section class="container mt-5 products">
        <h2 class="products__title">Produtos</h2>
        <form action="#filter" method="get" class="mb-5" id="#filter">
            <input type="hidden" name="page" value="{{ $filter['page'] }}">
            <div class="row">
                <div class="col-md-2">
                    <select class="form-control" onchange="this.form.submit()" name="perPage">
                        <option @if (!empty($filter['perPage']) && $filter['perPage'] === '20') selected @endif value="10">10 por página</option>
                        <option @if (!empty($filter['perPage']) && $filter['perPage'] === '20') selected @endif value="20">20 por página</option>
                        <option @if (!empty($filter['perPage']) && $filter['perPage'] === '30') selected @endif value="30">30 por página</option>
                        <option @if (!empty($filter['perPage']) && $filter['perPage'] === '40') selected @endif value="40">40 por página</option>
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <select class="form-control" onchange="this.form.submit()" name="filter" id="">
                        <option value="">Classificar por</option>
                        <option @if (!empty($filter['filter']) && $filter['filter'] === 'name') selected @endif value="name">Nome</option>
                        <option @if (!empty($filter['filter']) && $filter['filter'] === 'low') selected @endif value="low">Menor preço</option>
                        <option @if (!empty($filter['filter']) && $filter['filter'] === 'high') selected @endif value="high">Maior Preço</option>
                    </select>
                </div>
            </div>
        </form>
        @if (!empty($products))
            <div class="row">
                @foreach ($products as $product)
                    <div class="product__item col-md-3 mt-3 mb-3">
                        <span data-product-id="{{ $product->id }}" class="product__bascket">
                            <svg id="Capa_1" enable-background="new 0 0 512 512" height="512" viewBox="0 0 512 512"
                                width="512" xmlns="http://www.w3.org/2000/svg">
                                <g>
                                    <path
                                        d="m472 452c0 11.046-8.954 20-20 20h-20v20c0 11.046-8.954 20-20 20s-20-8.954-20-20v-20h-20c-11.046 0-20-8.954-20-20s8.954-20 20-20h20v-20c0-11.046 8.954-20 20-20s20 8.954 20 20v20h20c11.046 0 20 8.954 20 20zm0-312v192c0 11.046-8.954 20-20 20s-20-8.954-20-20v-172h-40v60c0 11.046-8.954 20-20 20s-20-8.954-20-20v-60h-192v60c0 11.046-8.954 20-20 20s-20-8.954-20-20v-60h-40v312h212c11.046 0 20 8.954 20 20s-8.954 20-20 20h-232c-11.046 0-20-8.954-20-20v-352c0-11.046 8.954-20 20-20h60.946c7.945-67.477 65.477-120 135.054-120s127.109 52.523 135.054 120h60.946c11.046 0 20 8.954 20 20zm-121.341-20c-7.64-45.345-47.176-80-94.659-80s-87.019 34.655-94.659 80z" />
                                </g>
                            </svg>
                        </span>
                        <figure>
                            @php
                                $url = 'storage/img/product/';
                                $url .= $product->product_image ? $product->product_image : 'default-placeholder.png';
                                
                                $price = $product->price;
                                $discount = $product->discount_status === '1' ? $product->discount / 100 : '';
                                $finalPrice = !empty($discount) ? $price - $price * $discount : '';
                                
                            @endphp
                            <img class="product__image" src="{{ url($url) }}">
                        </figure>
                        <p class="product__name">
                            {{ $product->name_product }}
                        </p>
                        @if (!empty($finalPrice))
                            <p class="product__price">De <span
                                    class="h6 product__price--line">R${{ $product->price }}</span> por apenas <span
                                    class=" text-danger h6 product__discount">R${{ $finalPrice }}</span></p>
                        @else
                            <p class="product__price">Por apenas <span class="h6">R${{ $product->price }}</span> </p>
                        @endif
                    </div>
                @endforeach

                @php
                    $next = $filter['page'] <= 1 ? 2 : $filter['page'] + 1;
                    $previous = $filter['page'] <= 1 ? 1 : $filter['page'] - 1;
                    
                    $nextPage = '?page=' . $next;
                    $previousPage = '?page=' . $previous;
                    
                    if (!empty($filter['perPage'])) {
                        $nextPage .= '&perPage=' . $filter['perPage'];
                        $previousPage .= '&perPage=' . $filter['perPage'];
                    }
                    
                    if (!empty($filter['filter'])) {
                        $nextPage .= '&filter=' . $filter['filter'];
                        $previousPage .= '&filter=' . $filter['filter'];
                    }
                    
                    $nextPage .= '#filter';
                    $previousPage .= '#filter';
                @endphp
                <div class="pagination">
                    <a class="pagination__link" href="/{{ $previousPage }}">Anterior</a>
                    <a class="pagination__link" href="/{{ $nextPage }}">Proximo</a>
                </div>
            </div>
        @endif
    </section>
    <div class="finish">
        <a class="finish__link flutuation hidden" href="{{route('finishOrder')}}">
            <svg id="Capa_1" enable-background="new 0 0 512 512" height="512" viewBox="0 0 512 512" width="512"
                xmlns="http://www.w3.org/2000/svg">
                <g>
                    <path d="m419.68 163.97v223.03h-371.71v-223.03l185.86-111.51z" fill="#ffa001" />
                    <path d="m419.68 163.97v223.03h-185.85v-334.54z" fill="#f87f02" />
                    <path d="m0 163.971 47.968-111.515h185.858l-47.968 111.515z" fill="#ffda2d" />
                    <path d="m467.651 163.971-47.968-111.515h-185.857l47.968 111.515z" fill="#fcbe00" />
                    <path d="m107.714 293.542h30v30h-30z" fill="#ffda2d" />
                    <path
                        d="m512 349.834c0 60.59-49.12 109.71-109.71 109.71-60.6 0-109.72-49.12-109.72-109.71 0-60.6 49.12-109.72 109.72-109.72 60.59 0 109.71 49.119 109.71 109.72z"
                        fill="#83e470" />
                    <path d="m512 349.834c0 60.59-49.12 109.71-109.71 109.71v-219.43c60.59 0 109.71 49.119 109.71 109.72z"
                        fill="#01b763" />
                    <path
                        d="m459.7 332.064-57.41 57.409-9.95 9.951-47.47-47.471 21.22-21.21 26.25 26.25 9.95-9.949 36.19-36.19z"
                        fill="#f3fdff" />
                    <path d="m459.7 332.064-57.41 57.409v-42.429l36.19-36.19z" fill="#d7f3f7" />
                </g>
            </svg>
        </a>
    </div>
    @csrf
@endsection
