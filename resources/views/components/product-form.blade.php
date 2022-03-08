@props([
    'route_name' => 'storeProduct',
    'route_params' => [],
    'code' => '',
    'name' => '',
    'warehouse_quantity' => '',
    'value' => '',
    'submit_button_text' => 'Adicionar Produto'
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
        <label for="code" class="form-label">Código</label>
        <div class="input-group has-validation">
            <input type="text" name="code" class="form-control"value="{{ $code }}" id="code" aria-describedby="Code to product" required />
            <div class="invalid-feedback">
            Código invalido
            </div>
        </div>
    </div>

    <div class="mb-3">
        <label for="name" class="form-label">Nome</label>
        <div class="input-group has-validation">
            <input type="text" name="name" class="form-control"value="{{ $name }}" id="name" aria-describedby="Name to product" required />
            <div class="invalid-feedback">
            Nome invalido
            </div>
        </div>
    </div>

    <div class="mb-3">
        <label for="warehouse_quantity" class="form-label">
            Quantidade
        </label>
        <div class="input-group has-validation">
            <input type="number" name="warehouse_quantity" class="form-control" value="{{ $warehouse_quantity }}" id="warehouse_quantity" aria-describedby="warehouse_quantity to product" required  step="0" min="0" />
            <div class="invalid-feedback">
            Quantidade Invalido
            </div>
        </div>
    </div>

    <div class="mb-3">
        <label for="value" class="form-label">Valor</label>
        <div class="input-group">
            <input type="number" name="value" value="{{ $value }}" class="form-control" id="value" aria-describedby="Value to product" step="0.01" min="0"/>
            <div class="invalid-feedback">
            Selecione um valor válido.
            </div>
        </div>
    </div>

    <button type="submit" class="btn w-100 btn-primary">{{ $submit_button_text}}</button>
</form>
