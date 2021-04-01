@extends('layouts.masterAdmin')
@section('title', 'Order - ' . $products['order']->n_order)
@section('content')

<section class="orders container ">
        <p class="user__order--text mt-5">User: <b>{{$products['user']->name . ' ' . $products['user']->last_name}}</b></p>
        <p class="user__order--text mb-4">E-mail: <b>{{$products['user']->email}}</b></p>
        <div class="row">
            <div class="col-md-7 order__product--container single" data-product-id="{{ $products['order']->id }}">
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
                $orderStatus = (int) ($products['order']->status + 1);
                $orderStatus = (string) $orderStatus;
            @endphp
            <aside class="col-md-5 aside__menu">
                <div class="order__price--info">
                    <p class="order__number">Order Number: <span>{{ $products['order']->n_order }}</span></p>
                    <p class="order__status">Status: <span class="{{ $class }}">{{ $status }}</span></p>
                    <p class="order__product--total">Total: <span>{{ $products['order']->total_price }}</span></p>
                </div>
                <form action="{{ route('updateOrderAdmin', $products['order']->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <select name="status" class="form-control change__status" onchange="this.form.submit()">
                        <option @if ($orderStatus === '1') selected @endif value="1">Open</option>
                        <option @if ($orderStatus === '2') selected @endif value="2">Finished</option>
                        <option @if ($orderStatus === '3') selected @endif value="3">Cancel</option>
                    </select>
                </form>
                <button class="delete__order btn btn-danger">Delete</button>
            </aside>
        </div>
    </section>
    @csrf
@endsection
@section('page', url('js/pages/singleOrder.js'))
