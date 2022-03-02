@extends('layouts.main')

@section ('content')
<section class="login-content container-sm w-100 h-100 d-flex mt-5 flex-column">
    <header>
        <h1>Entrar</h1>
    </header>
    <main>
        <form class="needs-validation" novalidate action="{{ route('loginAction') }}" method="POST">
            @csrf

            @if ($errors->any())
                <div class="alert alert-danger">
                    <p>Erro no envio das informações. Tente de novo!</p>
                </div>
            @endif

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <div class="input-group has-validation">
                    <input type="email" name="email" class="form-control" id="email" aria-describedby="Email to login" required />
                    <div class="invalid-feedback">
                    Selecione um email válido.
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Senha</label>
                <div class="input-group has-validation">
                    <input type="password" name="password" class="form-control" id="password" aria-describedby="Password to login" required />
                    <div class="invalid-feedback">
                    Digite sua senha
                    </div>
                </div>
            </div>

            <div class="d-flex flex-row justify-content-between align-items-center mb-3">
                <small>
                    <a href="{{ route('signup') }}" class="link-primary">
                        Criar conta
                    </a>
                </small>
            </div>

            <button type="submit" class="btn w-100 btn-primary">Entrar</button>
          </form>
    </main>
</section>
@endsection
