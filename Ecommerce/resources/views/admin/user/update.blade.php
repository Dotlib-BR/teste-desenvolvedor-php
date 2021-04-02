@extends('layouts.masterAdmin')
@section('title', 'Admin - Update User')
@section('content')

<section class="container">
        <h3 class="card-title h3">Update user</h3>
        <div class="row">
            @if (Session::get('error'))
                <h3 class="text-danger">{{ Session::get('error') }}</h3>
            @endif
            @if (Session::get('success'))
                <h3 class="text-success">{{ Session::get('success') }}</h3>
            @endif
            <div class="col-md-6">
                <form action="{{ route('updateUserAdmin', $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div>
                        <label for="name" class="form-label">Name</label>
                        <input id="name" class="form-control" type="text" name="name" value="{{ old('name') ?? $user->name }}" placeholder="Name">
                        <p class="text-warning">@error('name') {{ $message }} @enderror</p>
                    </div>
                    <div>
                        <label for="last" class="form-label">Last name</label>
                        <input class="form-control" id="last" type="text" name="last_name" value="{{ old('last_name') ?? $user->last_name }}"
                            placeholder="Last Name">
                        <p class="text-warning">@error('last_name') {{ $message }} @enderror</p>
                    </div>
                    <div>
                        <label for="email" class="form-label">E-mail</label>
                        <input class="form-control" id="email" type="email" name="email" value="{{ old('email') ?? $user->email }}"
                            placeholder="E-mail">
                        <p class="text-warning">@error('email') {{ $message }} @enderror</p>
                    </div>
                    <div>
                        <label for="pass" class="form-label">Password</label>
                        <input class="form-control" type="password" id="pass" name="password" placeholder="Password">
                        <p class="text-warning">@error('password') {{ $message }} @enderror</p>
                    </div>
                    <div>
                        <label for="imagem" class="form-label">CPF</label>
                        <input id="cpf" class="form-control cpf" type="text" name="document" value="{{ $user->document }}" placeholder="CPF">
                        <p class="text-warning">@error('cpf') {{ $message }} @enderror</p>
                    </div>
                    <div>
                        <label for="image" class="form-label">Profile photo</label>
                        <input class="form-control" type="file" id="image" name="image">
                        <p class="text-warning">@error('image') {{$message}} @enderror</p>
                    </div>
                    <button class="btn btn-dark" type="submit">
                        Update
                    </button>
                </form>
            </div>
            @php
                $photo = $user->avatar ?? 'user.svg';
            @endphp
            <div class="col-md-6">
                <figure class="user__image--container">
                    <img class="render__image" src="{{url('storage/img/users/' . $photo)}}" alt="">
                </figure>
            </div>
        </div>
    </section>
@endsection
