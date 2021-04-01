@extends('layouts.masterAdmin')
@section('title', 'Admin - Update Product')
@section('content')
    <section class="container">
        <h3 class="card-title product__update--title h3">Update Product</h3>
        <div class="row">
            @if (Session::get('error'))
                <h3 class="text-danger">{{ Session::get('error') }}</h3>
            @endif
            @if (Session::get('success'))
                <h3 class="text-success">{{ Session::get('success') }}</h3>
            @endif
            <div class="col-md-6">
                <form action="{{ route('updateProduct', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div>
                        <label for="productName" class="form-label">Product Name</label>
                        <input id="productName" class="form-control" type="text" name="name_product"
                            value="{{ $product->name_product }}" placeholder="Product Name">
                        <p class="text-warning">@error('name_product') {{ $message }} @enderror</p>
                    </div>
                    <div>
                        <label for="price" class="form-label">Price</label>
                        <input id="price" type="number" class="form-control" name="price" value="{{ $product->price }}"
                            placeholder="Price">
                        <p>@error('price') {{ $message }} @enderror</p>
                    </div>
                    <div>
                        <label for="code" class="form-label">Bar Code</label>
                        <input id="code" type="number" maxlength="10" class="form-control" name="code"
                            value="{{ $product->code }}" placeholder="Bar Code">
                        <p>@error('code') {{ $message }} @enderror</p>
                    </div>
                    <div>
                        <label for="dicount" class="form-label">Discount</label>
                        <input id="dicount" type="number" min="0" max="100" name="discount" class="form-control"
                            value="{{ $product->discount }}" placeholder="Discount">
                        <p>@error('discount') {{ $message }} @enderror</p>
                    </div>
                    <div>
                        <label for="have" class="form-label mr-1">Have Discount: </label>
                        <input id="have" type="checkbox" @if ($product->discount_status === '1') checked @endif name="discount_status">
                    </div>
                    <div>
                        <label for="image" class="form-label">Product Photo</label>
                        <input class="form-control" type="file" id="image" name="image">
                        <p class="text-warning">@error('image') {{ $message }} @enderror</p>
                    </div>
                    <button class="btn btn-dark" type="submit">
                        Update
                    </button>
                    <button class="btn btn-danger">Delete</button>
                </form>
            </div>
            @php
                $photo = $product->product_image ?? 'default-placeholder.png';
            @endphp
            <div class="col-md-6">
                <figure class="user__image--container">
                    <img class="render__image" src="{{ url('storage/img/product/' . $photo) }}" alt="">
                </figure>
            </div>
        </div>
    </section>
@endsection
@section('page', url('js/utilities.js'))
