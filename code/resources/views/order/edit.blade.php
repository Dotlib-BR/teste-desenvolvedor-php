<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos</title>
</head>
<body>
    <form method="POST" action="{{ route('order.update', $order) }}">
        @csrf
        @method("PUT")
        @foreach ($order->products as $item)
        <div>
            <select name="products[]">
                <option value="{{ $item->id }}">{{ $item->name }}</option>
                @foreach ($allProducts->filter(fn($product) => $product->id != $item->id) as $productOption)
                    <option value="{{ $productOption->id }}">{{ $productOption->name }}</option>
                @endforeach
            </select>
            <input type="number" name="quantities[]">
            </div>
        @endforeach
        <input value="{{ $order->date }}" type="date" name="date">
        <select name="status">
            <option selected="{{ $order->status == "opened" }}" value="opened">Em Aberto</option>
            <option selected="{{ $order->status == "paid_out" }}" value="paid_out">Pago</option>
            <option selected="{{ $order->status == "canceled" }}" value="canceled">Cancelado</option>
        </select>
        <button type="submit">Enviar</button>
    </form>
</body>
</html>