<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Clientes</title>
    <link rel="stylesheet" href="{{ asset('site/bootstrap.css') }}">
</head>
<body>
@include('templates.header')

    <table style="width: 85%" class="mx-auto table">
        <thead>
        <tr>
            <th scope="col"><a href="/clients/name" style="color: black; text-decoration: none;">Nome</a></th>
            <th scope="col"><a href="/clients/email" style="color: black; text-decoration: none;">Email</a></th>
            <th scope="col"><a href="/clients/cpf" style="color: black; text-decoration: none;">Cpf</a></th>
            <th scope="col">Ações</th>
        </tr>
        </thead>
        <tbody>
        @foreach($clients as $client)
            <tr>
                <td>{{ $client->name }}</td>
                <td>{{ $client->email }}</td>
                <td>{{ $client->cpf }}</td>
                <td><button class="btn btn-danger" onclick="removeClient({{ $client->id }})">excluir</button></td>
            </tr>
        @endforeach
        </tbody>
        <div class="d-flex justify-content-center">
            {{ $clients->links() }}
        </div>
    </table>

    <script src="{{ asset('site/jquery.js') }}"></script>
    <script src="{{ asset('site/bootstrap.js') }}"></script>
    <script>
        function removeClient(id) {
            $.ajax({
                url: '\\ajax/clients/delete/' + id,
                type: 'get',
                success: function () {
                    window.location.href= '\\clients/' + 'id';
                },
                error: function (err) {
                    console.error(err);
                }
            });
        }
    </script>
</body>
</html>
