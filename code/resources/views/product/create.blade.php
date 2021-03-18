<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos</title>
</head>
<body>
    <form method="POST" action="{{ route('client.create') }}">
        <input type="text" name="name">
        <input type="number" name="quantity">
        <input type="number" name="price">
        <input type="text" name="bar_code">
        <button type="submit">Enviar</button>
    </form>
</body>
</html>