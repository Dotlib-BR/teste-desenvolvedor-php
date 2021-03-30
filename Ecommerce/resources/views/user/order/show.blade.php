@extends('layouts.master')
@section('title', 'Order - ' . $products['order']->n_order)
@section('content')
    <section class="orders container">
        <h3 class="h3 mt-3">My order</h3>
        {{-- @dd($products['order']) --}}
        <div class="row">
            <div class="col-md-7 order__product--container single" data-product-id="{{$products['order']->id}}">
                @php
                    $subTotal = 0;
                    $subTotalDiscount = 0;
                @endphp
                @if (count($products['products']['data']))
                    @foreach ($products['products']['data'] as $product)
                        @foreach ($products['orderProduct'] as $order)
                            @if ($product->id === $order->id_product)
                                @php
                                    $url = 'storage/img/product/';
                                    $url .= $product->product_image ? $product->product_image : 'default-placeholder.png';
                                @endphp
                                <div class="row order__product--item">
                                    <div class="col-md-4">
                                        <figure class="order__product--img-container">
                                            <img class="order__product--img" src="{{ url($url) }}" alt="">
                                        </figure>
                                    </div>
                                    <div class="col-md-4 order__product--info">
                                        <p class="order__product--name">{{ $product->name_product }}</p>
                                        <p class="order__product--price">
                                            <span
                                                class="order__product--old-price">{{ $order->price / $order->quantity }}</span>
                                        </p>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="order__quantity">
                                            <p>Amount: {{ $order->quantity }}</p>
                                        </div>
                                    </div>
                                </div>
                                @continue
                            @endif
                        @endforeach
                    @endforeach
                @endif
            </div>
            @php
                $status = 'Open';
                $class = 'text-warning';
                if ($products['order']->status === '1') {
                    $status = 'Finished';
                    $class = 'text-success';
                } elseif ($products['order']->status === '2') {
                    $status = 'Canceled';
                    $class = 'text-danger';
                }
                
            @endphp
            <aside class="col-md-5 aside__menu">
                <div class="order__price--info">
                    <p class="order__number">Order Number: <span>{{ $products['order']->n_order }}</span></p>
                    <p class="order__status">Status: <span class="{{ $class }}">{{ $status }}</span></p>
                    <p class="order__product--total">Total: <span>{{ $products['order']->total_price }}</span></p>
                </div>
                @if ($products['order']->status === '0')
                    <div class="order__actions">
                        <button class="btn btn-success pay__order">Pay</button>
                        <button class="btn btn-danger cancel__order">Cancel</button>
                    </div>
                @endif
            </aside>
        </div>
    </section>
    @csrf
@endsection
@section('page', url('js/pages/singleOrder.js'))