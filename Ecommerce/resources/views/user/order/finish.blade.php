@extends('layouts.master')
@section('title', 'Pedidos')
@section('content')
    {{-- @dd($products); --}}
    <section class="orders container">
        <h3 class="h3 mt-3">Finish Order</h3>

        <p>Products</p>
        <div class="row">
            <div class="col-md-7 order__product--container finish__order">
                @php
                    $subTotal = 0;
                    $subTotalDiscount = 0;
                @endphp
                @if (count($products))
                    @foreach ($products as $product)
                        @php
                            $url = 'storage/img/product/';
                            $url .= $product['product']->product_image ? $product['product']->product_image : 'default-placeholder.png';
                            
                            $price = $product['product']->price;
                            $discount = $product['product']->discount_status === '1' ? $product['product']->discount / 100 : '';
                            $finalPrice = !empty($discount) ? $price - $price * $discount : '';
                            
                            $subTotal += $price * $product['quantity'];
                            
                            $subTotalDiscount += !empty($discount) ? $product['quantity'] * $price * $discount : 0;
                        @endphp
                        <div class="row order__product--item" data-product-id="{{ $product['product']->id }}">
                            <span class="order__product--destroy">x</span>
                            <div class="col-md-4">
                                <figure class="order__product--img-container">
                                    <img class="order__product--img" src="{{ url($url) }}" alt="">
                                </figure>
                            </div>
                            <div class="col-md-4 order__product--info">
                                <p class="order__product--name">{{ $product['product']->name }}</p>
                                <p class="order__product--price"><span
                                        class="order__product--old-price">{{ $price }}</span>
                                    @if (!empty($finalPrice))
                                        - <span class="order__product--discount">{{ $finalPrice }}</span>
                                    @endif
                                </p>
                            </div>
                            <div class="col-md-4">
                                <div class="order__product--quantity">
                                    <span class="order__product--remove text-danger">-</span>
                                    <input class="form-control product__quantity" type="text" name="quantity"
                                        value="{{ $product['quantity'] }}">
                                    <span class="order__product--add text-success">+</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="h4">There are no products. <a href="{{ route('home') }}">Click here</a> to return to home.</p>
                    <div class="empty__cart">
                        <img src="{{ url('storage/img/site/cart.svg') }}" alt="" srcset="">
                    </div>
                @endif
            </div>
            <aside class="col-md-5 aside__menu">
                <div class="order__price--info">
                    <p class="order__product--subtotal">Subtotal:<span>R${{ $subTotal }}</span></p>
                    <p class="order__product--subtotal-discount">Discount:<span>R${{ $subTotalDiscount }}</span></p>
                    <p class="order__product--total">Total:<span>R${{ $subTotal - $subTotalDiscount }}</span></p>
                </div>
                <div class="order__actions">
                    <button @if ($subTotal - $subTotalDiscount === 0) disabled @endif class="btn btn-success order__finish">Finish</button>
                    <button @if ($subTotal - $subTotalDiscount === 0) disabled @endif class="btn btn-danger order__cancel">Cancel</button>
                </div>
            </aside>
        </div>
    </section>
    @csrf
@endsection
@section('page', url('js/pages/order.js'))
