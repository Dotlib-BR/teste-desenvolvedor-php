<meta charset='UTF-8'>
<meta name='viewport' content='width=device-width, initial-scale=1.0'>
<!-- Dependências -->
<link rel='stylesheet' type='text/css' href='css\reset.css'>
<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3' crossorigin='anonymous'>
<script src="https://kit.fontawesome.com/af5cc2ff3a.js" crossorigin="anonymous"></script>
<!-- Arquivos de estilo -->
<link rel='stylesheet' type='text/css' href='..\..\css\main.css'>


    <script>
        @foreach ($errors->all() as $error)
            alert('{{ $error }}');
        @endforeach
    </script>

