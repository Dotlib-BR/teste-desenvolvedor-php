@extends('modelos.acessoLivre.modeloPagina')

@section('conteudo')
    <div class="my-4 container">
        <div class="row background-4 rounded">
            <div class="col-6 d-grid">
                <div>
                    <div class="my-4 col-6 w-75">
                        <span>
                            Nome
                        </span>
                        <small class="p-2 form-control">
                            {{ $dadosLista->cadastroNome }}
                        </small>
                    </div>
                    <div class="my-3 col-6 w-50">
                        <span>
                            CPF
                        </span>
                        <small class="p-2 form-control">
                        {{ $dadosLista->cadastroCpf }}
                        </small>
                    </div>
                </div>

                <div class="my-3">
                    <div>
                        <span>
                            <strong>Nível de autoridade :</strong>
                        </span>
                    </div>
                    <div class="my-3">
                        <span class="form-control w-fit-content fs-12 text-uppercase">
                            <?php
                                if ($dadosLista->cadastroAutoridade == true) {
                                    echo 'Administrador';
                                } else {echo 'Cliente';}
                            ?>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-6 d-grid">
                <div>
                    <div class="my-4 col-6 w-75">
                        <span>
                            Email
                        </span>
                        <small class="p-2 form-control">
                            {{ $dadosLista->cadastroEmail }}
                        </small>
                    </div>
                    <div class="my-3 col-6 w-75">
                        <span>
                            Senha
                        </span>
                        <small class="p-2 form-control">
                            ####
                        </small>
                    </div>
                </div>

                
                <div class="my-3 d-flex">
                    <div class="col-6">
                        <div>
                            <span><strong>Conta criada em:</strong></span>
                        </div>
                        <div class="my-3">
                            <span class="form-control w-fit-content fs-09 text-uppercase">
                                {{ $dadosLista->created_at }}
                            </span>
                        </div>
                    </div>

                    <div class="col-6">
                        <div>
                            <span><strong>Última atualização na conta:</strong></span>
                        </div>
                        <div class="my-3">
                            <span class="form-control w-fit-content fs-09 text-uppercase">
                                {{ $dadosLista->updated_at }}
                            </span>
                            <small class="text-danger fs-07">
                                Caso não tenha sido você, <u>entre em contato conosco</u>
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
