<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes</title>
</head>
<body>
    <form method="POST" action="{{ route('client.create') }}">
        <input type="text" name="name">
        <input type="email" name="email">
        <input type="text" name="cpf">
        <button type="submit">Enviar</button>
    </form>
</body>
</html>