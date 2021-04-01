@extends('layouts.masterAdmin')
@section('title', 'Admin - Products')
@section('content')

    <section class="container mt-5 products">
        <h2 class="products__title">All Products</h2>
        <a class="btn btn-dark" href="{{route('registerView')}}">Add Product</a>
        <form action="#filter" method="get" class="mb-5" id="#filter">
            <input type="hidden" name="page" value="{{ $filter['page'] }}">
            <div class="row">
                <div class="col-md-2">
                    <select class="form-control" onchange="this.form.submit()" name="perPage">
                        <option @if (!empty($filter['perPage']) && $filter['perPage'] === '20') selected @endif value="10">10 per Page</option>
                        <option @if (!empty($filter['perPage']) && $filter['perPage'] === '20') selected @endif value="20">20 per Page</option>
                        <option @if (!empty($filter['perPage']) && $filter['perPage'] === '30') selected @endif value="30">30 per Page</option>
                        <option @if (!empty($filter['perPage']) && $filter['perPage'] === '40') selected @endif value="40">40 per Page</option>
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <select class="form-control" onchange="this.form.submit()" name="filter" id="">
                        <option value="">Sort By</option>
                        <option @if (!empty($filter['filter']) && $filter['filter'] === 'name') selected @endif value="name">Name</option>
                        <option @if (!empty($filter['filter']) && $filter['filter'] === 'low') selected @endif value="low">Low value</option>
                        <option @if (!empty($filter['filter']) && $filter['filter'] === 'high') selected @endif value="high">High value</option>
                    </select>
                </div>
            </div>
        </form>
        @if (!empty($products))
            <div class="row">
                @foreach ($products as $product)
                    <div class="product__item col-md-3 mt-3 mb-3">
                        <input type="checkbox" class="mass__deletion--product" name="product[]" value="{{$product->id}}">
                        <span data-product-id="{{ $product->id }}" class="product__delete">
                            <svg height="329pt" viewBox="0 0 329.26933 329" width="329pt"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="m194.800781 164.769531 128.210938-128.214843c8.34375-8.339844 8.34375-21.824219 0-30.164063-8.339844-8.339844-21.824219-8.339844-30.164063 0l-128.214844 128.214844-128.210937-128.214844c-8.34375-8.339844-21.824219-8.339844-30.164063 0-8.34375 8.339844-8.34375 21.824219 0 30.164063l128.210938 128.214843-128.210938 128.214844c-8.34375 8.339844-8.34375 21.824219 0 30.164063 4.15625 4.160156 9.621094 6.25 15.082032 6.25 5.460937 0 10.921875-2.089844 15.082031-6.25l128.210937-128.214844 128.214844 128.214844c4.160156 4.160156 9.621094 6.25 15.082032 6.25 5.460937 0 10.921874-2.089844 15.082031-6.25 8.34375-8.339844 8.34375-21.824219 0-30.164063zm0 0" />
                            </svg>
                        </span>
                        <a href="{{ route('editProduct', $product->id) }}">
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
                                <p class="product__price">Was <span
                                        class="h6 format__money product__price--line">{{ $product->price }}</span> now
                                    only
                                    <span class="format__money text-danger h6 product__discount">{{ $finalPrice }}</span>
                                </p>
                            @else
                                <p class="format__money product__price"><span class="h6">{{ $product->price }}</span> </p>
                            @endif
                        </a>
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
                        $filter['perPage'] = (int) $filter['perPage'];
                    }
                    
                    if (!empty($filter['filter'])) {
                        $nextPage .= '&filter=' . $filter['filter'];
                        $previousPage .= '&filter=' . $filter['filter'];
                    }
                    
                    $nextPage .= '#filter';
                    $previousPage .= '#filter';
                    $filter['page'] = (int) $filter['page'];
                    $last = $products->lastPage();
                @endphp
                <div class="pagination">
                    @if ($last === $filter['page'] && $filter['page'] > 1)
                        <a class="pagination__link" href="{{ url(route('productAdmin') . $previousPage) }}">Prev</a>
                        <span class="pagination__link">Next</span>
                    @elseif($last > $filter['page'] && $filter['page'] > 1)
                        <a class="pagination__link" href="{{ url(route('productAdmin') . $previousPage) }}">Prev</a>
                        <a class="pagination__link" href="{{ url(route('productAdmin') . $nextPage) }}">Next</a>
                    @elseif($filter['page'] === 1 && $last > 1)
                        <span class="pagination__link">Prev</span>
                        <a class="pagination__link" href="{{ url(route('productAdmin') . $nextPage) }}">Next</a>
                    @endif
                </div>
            </div>
        @endif
    </section>
    <div class="finish delete__products--btn hidden">
        <button class="btn btn-danger delete__all--product">Delete Selected</button>
    </div>
    @csrf
@endsection
@section('page', url('js/pages/productAdmin.js'))
