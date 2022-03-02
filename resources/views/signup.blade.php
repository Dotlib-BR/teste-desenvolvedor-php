@extends('layouts.main')

@section ('content')
<section class="signup-content container-sm w-100 h-100 d-flex mt-5 flex-column">
    <header>
        <h1>Criar conta</h1>
    </header>
    <main>
        <form class="needs-validation" novalidate action="{{ route('signupAction') }}" method="POST">
            @csrf

            @if ($errors->any())
                <div class="alert alert-danger">
                    <p>Erro no envio das informações. Tente de novo!</p>
                </div>
            @endif

            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <div class="input-group has-validation">
                    <input type="text" name="name" class="form-control" id="name" aria-describedby="Name to signup" required />
                    <div class="invalid-feedback">
                    Digite seu nome
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <div class="input-group has-validation">
                    <input type="email" name="email" class="form-control"1 id="email" aria-describedby="Email to signup" required />
                    <div class="invalid-feedback">
                    Selecione um email válido.
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Senha</label>
                <div class="input-group has-validation">
                    <input type="password" name="password" class="form-control" id="password" aria-describedby="password to signup" required />
                    <div class="invalid-feedback">
                    Digite sua senha
                    </div>
                </div>
            </div>

            <div class="d-flex flex-row justify-content-between align-items-center mb-3">
                <small>
                    <a href="{{ route('login') }}" class="link-primary">
                        Já tem conta? Faça o Login
                    </a>
                </small>
            </div>

            <button type="submit" class="btn w-100 btn-primary">Criar conta</button>
          </form>
    </main>
</section>
@endsection
