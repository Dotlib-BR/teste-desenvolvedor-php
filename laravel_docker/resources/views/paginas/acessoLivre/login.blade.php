<!DOCTYPE html>
<html lang='pt-BR'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Login</title>

        <!-- Dependências -->
        <link rel='stylesheet' type='text/css' href='css\reset.css'>
        <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3' crossorigin='anonymous'>
        <script src="https://kit.fontawesome.com/af5cc2ff3a.js" crossorigin="anonymous"></script>
        
        <!-- Arquivos de estilo -->
        <link rel='stylesheet' type='text/css' href='css\main.css'>
    </head>



    <body class="background-1">
        <main>
            <div class="d-flex justify-content-start">
                <div class="my-1 w-25 text-center">
                    <a href="/" class="mx-3">
                        <img class="w-50" src="https://dotlib.com/theme/img/logos/logo.png" alt="logo">
                    </a>
                </div>
            </div>

            <section>
                <div class="d-flex">


                    <div class="col w-25"></div>

                    <div class="col">
                        <div class="d-flex justify-content-center">
                            <img src="/ArquivosDoSite/FlippingBook.gif" style="
                                width: 60%;
                                border-radius: 29%;
                                border: 0.6em solid #51b4bf33;
                                outline: 0.6em solid #08515805;
                            ">
                        </div>
                    </div>

                    <div class="col w-25"></div>


                </div>

                
                <div class="d-flex">


                    <div class="col"></div>

                    <div class="col-5">
                        <form method="POST">
                            @csrf
                            <div class="my-2 form-group">
                                <label class="mx-2 my-2" for="input-email">Email</label>
                                <input id="input-email" class="form-control" type="email" name="email_usuario" placeholder="compradoresDotLib@dotlib.com" required>
                                
                                <div class="text-end">
                                    <small class="form-text text-white">
                                        Nós nunca iremos pedir nenhuma informação sensível a você.
                                    </small>
                                </div>
                            </div>

                            <div class="my-2 form-group">
                                <label class="mx-2 my-2" for="input-senha">Senha</label>
                                <input id="input-senha" class="form-control" type="password" name="senha_usuario" placeholder="sempreQueroMais123" required>
                            </div>

                            <div class="my-3 mx-3 text-end">
                                <button type="submit" class="btn btn-success">
                                    Conecte-se
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="col"></div>


                </div>
            </section>
        </main>
    </body>
</html>