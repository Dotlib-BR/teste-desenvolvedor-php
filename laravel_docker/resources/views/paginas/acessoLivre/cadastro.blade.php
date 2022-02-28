<!DOCTYPE html>
<html lang='pt-BR'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Cadastro</title>

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
                        <img class="w-50" alt="logo" src="https://dotlib.com/theme/img/logos/logo.png">
                    </a>
                </div>
            </div>

            <section>
                <div class="d-flex">


                    <div class="mx-5 my-2 col">
                        <div>
                            <span class="fs-20 fw-bold">Cadastro no site</span>
                        </div>
                    </div>

                
                </div>

                
                <div class="d-flex">


                    <div class="col"></div>

                    <div class="col-10">
                        <form method="POST">
                            @csrf
                            <div class="my-0 mx-2 form-group">
                                <label class="mx-2 my-1" for="input-nome">Nome</label>
                                <input id="input-nome" class="form-control" type="nome" name="nome_usuario" placeholder="José Victor da Oliveira">
                                
                                
                            </div>

                            <div class="my-0 mx-2 form-group">
                                <label class="mx-2 my-1" for="input-cpf">CPF</label>
                                <input id="input-cpf" class="w-25 form-control" type="number" name="cpf_usuario" placeholder="123.456.789-10">
                            </div>

                            <div class="my-0 d-flex form-group">
                                <div class="mx-2 w-50">
                                    <label class="mx-2 my-1" for="input-email">Email</label>
                                    <input id="input-email" class="form-control" type="text" name="email_usuario" placeholder="compradoresDotLib@dotlib.com">
                                </div>
                                
                                
                                <div class="mx-2 w-50">
                                    <label for="input-senha" class="mx-2 my-1">Senha</label>
                                    <input id="input-senha" class="form-control" type="password" name="senha_usuario" placeholder="sempreQueroMais123">
                                </div>
                            </div>

                            <div class="my-2 mx-2 form-group">
                                <label class="mx-2 my-1" for="input-autoridade">Nível de Autoridade</label>
                                <select id="input-autoridade" class="form-select custom-select custom-select-lg w-25" name="autoridade_usuario">
                                    <option selected>Escolha o nível de autoridade</option>
                                    <option value="0">Cliente</option>
                                    <option value="1">Administrador</option>
                                </select>
                            </div>

                            <div class="mx-3 text-end">
                                <small id="emailHelp" class="form-text text-white">
                                    Nós nunca iremos pedir nenhuma informação sensível a você.
                                </small>
                            </div>

                            <div class="my-3 mx-3 text-end">
                                <button class="btn btn-success" type="submit">Cadastre-se</button>
                            </div>
                        </form>
                    </div>

                    <div class="col"></div>


                </div>
            </section>
        </main>
    </body>
</html>