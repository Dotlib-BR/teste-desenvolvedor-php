@props([
    'route_name' => 'createCustomer',
    'route_params' => [],
    'name' => '',
    'cpf' => '',
    'email' => ''
])

<form class="needs-validation" novalidate action="{{ route($route_name, $route_params) }}" method="POST">
    @csrf

    {{ $slot }}

    @if ($errors->any())
        <div class="alert alert-danger">
            <p>Erro no envio das informações. Tente de novo!</p>
        </div>
    @endif

    <div class="mb-3">
        <label for="name" class="form-label">Nome</label>
        <div class="input-group has-validation">
            <input type="text" name="name" class="form-control"value="{{ $name }}" id="name" aria-describedby="Name to costumer" required />
            <div class="invalid-feedback">
            Nome invalido
            </div>
        </div>
    </div>

    <div class="mb-3">
        <label for="cpf" class="form-label">
            CPF
            <small>(somente números)</small>
        </label>
        <div class="input-group has-validation">
            <input type="cpf" name="cpf" class="form-control" value="{{ $cpf }}" id="cpf" aria-describedby="cpf to costumer" required max="11" min="11" pattern="[0-9]{11}" />
            <div class="invalid-feedback">
            CPF Invalido
            </div>
        </div>
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <div class="input-group">
            <input type="email" name="email" value="{{ $email }}" class="form-control" id="email" aria-describedby="Email to costumer" />
            <div class="invalid-feedback">
            Selecione um email válido.
            </div>
        </div>
    </div>

    <button type="submit" class="btn w-100 btn-primary">Adicionar Cliente</button>
</form>
