<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seu Título Aqui</title>
    
    <!-- Inclua os arquivos CSS do Bootstrap -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
</head>
<body>
    <!-- Conteúdo da página -->
    @yield('content')

    <!-- Inclua os scripts do Bootstrap e outros scripts necessários -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
</body>
</html>
