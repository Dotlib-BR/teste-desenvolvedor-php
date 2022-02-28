<?php
    // Definindo a variável de URL da página
    $urlDaPagina = '/admin/cadastros';
    // Palavras-chave
    $palavraChave = 'cadastros';
?>



@section('ContagemPesquisa')
    <strong>{{ $contagemPesquisa }}</strong> {{ $palavraChave }}
@endsection



@section('ListaDeDados')
    <div class="lista-de-{{ $palavraChave }} fs-08">
        <!-- Utilidades Globais -->
        <div class="d-flex justify-content-end">
            <a class="mx-1 my-2 btn btn-success" href="#cadastro-pessoa" onclick="addInput()">
                <i class="fa-solid fa-plus"></i>
            </a>
           <button class="mx-1 my-2 btn btn-danger" type="button" onclick="deleteAll('{{ $urlDaPagina }}')">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <!-- Lista de dados -->
        @foreach($dadosLista as $cadastros)

            <form method="POST">
                <div class="my-4">
                    <div class="text-end">
                        <button id="button-id-{{$cadastros->cadastroId}}" class="my-1 btn btn-sm btn-outline-secondary" type="button" onclick="openInput({{ $cadastros->cadastroId }})">
                            <i class="fa-solid fa-pencil"></i>
                        </button>
                        <button id="button-confirm-id-{{$cadastros->cadastroId}}" class="my-1 btn btn-sm btn-outline-success" type="submit" onclick="openInput({{ $cadastros->cadastroId }})" hidden>
                            <i class="fa-solid fa-check"></i>
                        </button>
                        <button class="btn btn-sm btn-outline-danger" type="button" onclick="deleteOne('{{ $urlDaPagina }}', '{{$cadastros->cadastroId}}')">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                    
                    <div id="cadastro-pessoa" class="d-flex text-center align-items-center">
                        @csrf
                        <!-- Id -->
                        <div id="#" class="mx-05 col-1">
                            <span>{{$cadastros->cadastroId}}</span>
                            <input type="hidden" name="cadastroId" value="{{$cadastros->cadastroId}}">
                        </div>
                        <!-- Nome -->
                        <div id="#" class="mx-05 col-3">
                            <span id="span-nome-{{$cadastros->cadastroId}}">{{$cadastros->cadastroNome}}</span>
                            <input id="input-nome-{{$cadastros->cadastroId}}" class="form-control fs-09 text-center" name="cadastroNome" value="{{$cadastros->cadastroNome}}" hidden>
            
                        </div>
                        <!-- CPF -->
                        <div id="#" class="mx-05 col-2">
                            <span id="span-cpf-{{$cadastros->cadastroId}}">{{$cadastros->cadastroCpf}}</span>
                            <input id="input-cpf-{{$cadastros->cadastroId}}" class="form-control fs-09 text-center" name="cadastroCpf" value="{{$cadastros->cadastroCpf}}" hidden>
                        </div>
                        <!-- Email -->
                        <div id="#" class="mx-05 col-3">
                            <span id="span-email-{{$cadastros->cadastroId}}">{{$cadastros->cadastroEmail}}</span>
                            <input id="input-email-{{$cadastros->cadastroId}}" class="form-control fs-09 text-center" name="cadastroEmail" value="{{$cadastros->cadastroEmail}}" hidden>
                        </div>
                        <!-- Autoridade -->
                        <div id="autoridade-div-{{$cadastros->cadastroId}}" class="mx-05 col-1" style="position: relative; top: -1.55em;">
            
                            <span id="span-autoridade-{{$cadastros->cadastroId}}">
                                <?php
                                    if ($cadastros->cadastroAutoridade == true) {
                                        echo 'Administrador';
                                    } else {echo 'Cliente';}
                                ?>
                            </span>
                            <small id="input-span-autoridade-{{$cadastros->cadastroId}}" class="fs-08" hidden>
                                1 -> Administrador, 0 -> Cliente
                            </small>
                            <input id="input-autoridade-{{$cadastros->cadastroId}}" class="form-control fs-09 text-center" name="cadastroAutoridade" value="{{$cadastros->cadastroAutoridade}}" hidden>
                            
                        </div>
                        <!-- Data de criação -->
                        <div id="#" class="mx-05 col-2">
                            <span>{{$cadastros->created_at}}</span>
                        </div>
                    </div>
                </div>
            </form>

        @endforeach

        <!-- Para adicionar novos {{ $palavraChave }} manualmente -->
        <form id="cadastro-pessoa-novo" class="my-5" method="POST" style="display: none;" hidden>
            <div class="d-flex text-center align-items-center">
                @csrf
                <!-- Nome -->
                <div id="#" class="mx-05 col-3">
                    <input id="input-nome-novo" class="form-control fs-09 text-center" name="cadastroNome" value="" placeholder="Nome Completo">
                </div>
                <!-- CPF -->
                <div id="#" class="mx-05 col-2">
                    <span id="span-cpf-novo"></span>
                    <input id="input-cpf-novo" class="form-control fs-09 text-center" name="cadastroCpf" value="" placeholder="CPF">
                </div>
                <!-- Email -->
                <div id="#" class="mx-05 col-3">
                    <input id="input-email-novo" class="form-control fs-09 text-center" name="cadastroEmail" value="" placeholder="email@provedor.com">
                </div>
                <!-- Senha -->
                <div id="#" class="mx-05 col-3">
                    <input id="input-senha-novo" class="form-control fs-09 text-center" name="cadastroSenha" value="" placeholder="minha#senha123">
                </div>
                <!-- Autoridade -->
                <div id="autoridade-div-novo" class="mx-05 col-1" style="position: relative; top: -1.5em;">
                    <small id="span-autoridade-novo" class="fs-08">
                        1 -> Administrador, 0 -> Cliente
                    </small>
                    <input id="input-autoridade-novo" class="form-control fs-09 text-center" name="cadastroAutoridade" value="" placeholder="1 ou 0?">
                    
                </div>
            </div>
            <!-- Botão Enviar -->
            <div id="#" class="d-flex text-end">
                <button class="mx-3 my-1 btn btn-outline-success" type="submit">
                    <i class="fa-solid fa-check">  Enviar</i>
                </button>
                <button class="mx-3 my-1 btn btn-outline-primary" type="button" onclick="addInput()">
                    <i class="fa-solid fa-check">  Ignorar</i>
                </button>
            </div>
        </form>

    </div>
@endsection



@section('Scripts')

    <script>
        function openInput($cadastroId) {
            if (document.getElementById(`input-nome-${$cadastroId}`).hasAttribute('hidden')) {

                document.getElementById(`span-nome-${$cadastroId}`).setAttribute('hidden', '');
                document.getElementById(`input-nome-${$cadastroId}`).removeAttribute('hidden');
        
                document.getElementById(`span-cpf-${$cadastroId}`).setAttribute('hidden', '');
                document.getElementById(`input-cpf-${$cadastroId}`).removeAttribute('hidden');
                
                document.getElementById(`span-email-${$cadastroId}`).setAttribute('hidden', '');
                document.getElementById(`input-email-${$cadastroId}`).removeAttribute('hidden');
                
                document.getElementById(`span-autoridade-${$cadastroId}`).setAttribute('hidden', '');
                document.getElementById(`input-span-autoridade-${$cadastroId}`).removeAttribute('hidden');
                document.getElementById(`input-autoridade-${$cadastroId}`).removeAttribute('hidden');
        
                document.getElementById(`button-id-${$cadastroId}`).setAttribute('hidden', '');
                document.getElementById(`button-confirm-id-${$cadastroId}`).removeAttribute('hidden');
            } else {
                document.getElementById(`input-nome-${$cadastroId}`).setAttribute('hidden', '');
                document.getElementById(`span-nome-${$cadastroId}`).removeAttribute('hidden');
        
                document.getElementById(`input-cpf-${$cadastroId}`).setAttribute('hidden', '');
                document.getElementById(`span-cpf-${$cadastroId}`).removeAttribute('hidden');
                
                document.getElementById(`input-email-${$cadastroId}`).setAttribute('hidden', '');
                document.getElementById(`span-email-${$cadastroId}`).removeAttribute('hidden');
                
                document.getElementById(`input-autoridade-${$cadastroId}`).setAttribute('hidden', '');
                document.getElementById(`input-span-autoridade-${$cadastroId}`).setAttribute('hidden', '');
                document.getElementById(`span-autoridade-${$cadastroId}`).removeAttribute('hidden');
        
                document.getElementById(`button-confirm-id-${$cadastroId}`).setAttribute('hidden', '');
                document.getElementById(`button-id-${$cadastroId}`).removeAttribute('hidden');
            }
        };

        function addInput() {
            if (document.getElementById('cadastro-pessoa-novo').hasAttribute('hidden')) {
                // "hidden" ainda que não mude visualmente, é usado como gatilho
                document.getElementById('cadastro-pessoa-novo').removeAttribute('hidden');
                document.getElementById('cadastro-pessoa-novo').style = '';
            } else {
                // Leva a página para o topo
                window.scrollTo(0,0);
                // Atribuí "hidden" novamente e esconde o formulário
                document.getElementById('cadastro-pessoa-novo').setAttribute('hidden', '');
                document.getElementById('cadastro-pessoa-novo').style = 'display: none';
            }
        };

        function deleteAll($urlDaPagina) {
            if (confirm('Você tem CERTEZA que deseja deletar TUDO?')) {
                location.assign(`${$urlDaPagina}/all`);
            }
        };

        function deleteOne($urlDaPagina, $cadastroId) {
            if (confirm('Você tem CERTEZA que deseja deletar?')) {
                location.assign(`${$urlDaPagina}/${$cadastroId}`);
            }
        };
    </script>

@endsection
