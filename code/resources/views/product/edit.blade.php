<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos</title>
</head>
<body>
    <form method="POST" action="{{ route('product.edit', $product) }}">
        <input type="text" value="{{ $product->name }}" name="name">
        <<input type="number" value="{{ $product->quantity }}" name="quantity">
        <input type="number" value="{{ $product->price }}" name="price">
        <input type="text" value="{{ $product->bar_code }}" name="bar_code">
        <button type="submit">Enviar</button>
    </form>
</body>
</html>