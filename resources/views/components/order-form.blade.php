@props([
    'route_name' => 'storeOrder',
    'route_params' => [],
    'customers' => [],
    'products'  => [],
    'id_customer' => 0,
    'id_product' => 0,
    'date' => date('Y-m-d'),
    'submit_button_text' => 'Adicionar Pedido'
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
        <label for="date" class="form-label">Data do Pedido</label>
        <div class="input-group has-validation">
            <input type="date" name="date" class="form-control"value="{{ $date }}" id="name" aria-describedby="Date of the order" required />
            <div class="invalid-feedback">
            Data invalida invalido
            </div>
        </div>
    </div>

    <div class="mb-3">
        <label for="id_customer" class="form-label">Cliente</label>
        <select class="form-select" aria-label="Customer to Order" name="id_customer" id="id_customer">
            @foreach ($customers as $customer)
                <option value="{{ $customer->id }}" {{ $id_customer === $customer->id ? 'selected' : '' }}>
                    #{{ $customer->id }} - {{ $customer->cpf }} - {{ $customer->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="id_product" class="form-label">Produto</label>
        <select class="form-select" aria-label="Product to Order" name="id_product" id="id_product">
            @foreach ($products as $product)
                <option value="{{ $product->id }}" {{ $id_product === $product->id ? 'selected' : '' }}>
                    #{{ $product->id }} - {{ $product->code }} - {{ $product->name }} - R$ {{ $product->value }}
                </option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn w-100 btn-primary">{{ $submit_button_text }}</button>
</form>
