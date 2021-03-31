@extends('layouts.masterOut')

@section('title', 'Registro')
@section('content')
    @if (Session::get('error'))
        <h3>{{ Session::get('error') }}</h3>
    @endif

    <section class="card register__form">
        <div class="card-body">
            <h3 class="card-title text-center">Register</h3>
            <div class="card-text">
                <form action="{{ route('registerValidate') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="nome">Name</label>
                                <input required type="text" name="name" value="{{ old('name') }}"
                                    class="form-control form-control-sm" placeholder="Name">
                                <p class="text-danger">@error('name') {{ $message }} @enderror</p>
                            </div>
                            <div class="form-group">
                                <label for="email">Last Name</label>
                                <input required type="text" name="last_name" value="{{ old('last_name') }}"
                                    class="form-control form-control-sm" placeholder="Last Name">
                                <p class="text-danger">@error('last_name') {{ $message }} @enderror</p>
                            </div>
                            <div class="form-group">
                                <label for="email">E-mail</label>
                                <input required type="email" name="email" value="{{ old('email') }}"
                                    class="form-control form-control-sm" placeholder="E-mail">
                                <p class="text-danger">@error('email') {{ $message }} @enderror</p>
                            </div>
                            <div class="form-group">
                                <label for="senha">Password</label>
                                <input required type="password" name="password" class="form-control form-control-sm"
                                    placeholder="Password">
                                <p class="text-danger">@error('password') {{ $message }} @enderror</p>
                            </div>
                            <div class="form-group">
                                <label for="cpf">CPF</label>
                                <input type="text" required name="document" id="cpf" maxlength="14"
                                    class="form-control form-control-sm" value="{{ old('document') }}" placeholder="CPF">
                                <p class="text-danger">@error('document') {{ $message }} @enderror</p>
                            </div>

                            <div>
                                <label for="imagem" class="form-label">Profile photo</label>
                                <input class="form-control" type="file" id="image" name="image">
                            </div>

                        </div>
                        <div class="col-md-6">
                            <figure class="user__image--container">
                                <img class="render__image user__register--image"
                                src="{{ url('storage/img/users/user.svg') }}" alt="">
                            </figure>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Sign up</button>
                    <div class="sign-up">
                        Already have an account? <a href="{{ route('login') }}">Click here to login</a>
                    </div>

                </form>
            </div>
        </div>
    </section>
@endsection
