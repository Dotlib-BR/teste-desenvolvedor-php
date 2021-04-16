<!--
 API Documentation HTML Template  - 1.0.1
 Copyright © 2016 Florian Nicolas
 Licensed under the MIT license.
 https://github.com/ticlekiwi/API-Documentation-HTML-Template
 Editado por Thélesson de Souza - @2021
 !-->
 <!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <title>Documentação API</title>
    <meta name="description" content="">
    <meta name="author" content="ticlekiwi">

    <meta http-equiv="cleartype" content="on">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="{{ asset('api/css/hightlightjs-dark.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.8.0/highlight.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,500|Source+Code+Pro:300" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('api/css/style.css') }}" media="all">
    <script>
        hljs.initHighlightingOnLoad();
    </script>
</head>

<body class="one-content-column-version">
<div class="left-menu">
    <div class="content-logo">
        <img alt="platform by Emily van den Heever from the Noun Project" title="platform by Emily van den Heever from the Noun Project" src="{{ asset('api/images/logo.png') }}" height="32" />
        <span>Documentação da API</span>
    </div>
    <div class="content-menu">
        <ul>
            <li class="scroll-to-link active" data-target="get-started">
                <a>INICIO</a>
            </li>
            
            <li class="scroll-to-link" data-target="get-produtos-0">
                <a>GET PRODUTOS(Sem autenticação)</a>
            </li>
            <li class="scroll-to-link" data-target="get-produtos-id">
                <a>GET PRODUTO(Sem autenticação)</a>
            </li>
            <li class="scroll-to-link" data-target="get-produtos">
                <a>GET Produtos(Autenticado)</a>
            </li>
            <li class="scroll-to-link" data-target="get-produtos-id-auth">
                <a>GET PRODUTO(Autenticado)</a>
            </li>
            <li class="scroll-to-link" data-target="get-characters">
                <a>POST PRODUTOS</a>
            </li>
            <li class="scroll-to-link" data-target="errors">
                <a>ERRORS</a>
            </li>
        </ul>
    </div>
</div>


<div class="content-page">
    <div class="content">
        <div class="overflow-hidden content-section" id="content-get-started">
            <h1 id="get-started">Inicio</h1>
            <p>
              Esta é uma api que lista, cria, edita ou deleta um novo produto. 
            </p>
            <p>
               Para a utilização da api em modo autenticado, você precisará do <strong>API Token</strong>.

            </p>
            <p>Somente Admins possuem acesso a edição/criação/exlusão de produtos via api. Para gerar seu token, acesse o menu: Api Tokens ou <a href="{{ route('api-tokens.index') }}">Clique aqui para gerar um novo token</a></p>
            <p>Certifique-se de habilitar a permissão correta na criação do token</p>
        </div>
       
        <div class="overflow-hidden content-section" id="content-get-produtos-0">
            <h2 id="get-produtos-0">GET Produtos(Sem Autenticação) - Endpoint</h2>
            <p>
                Para retornar a lista de produtos sem a necessidade de autenticação,
                <br>
                Faça um GET para essa url:<br>
                <code class="higlighted">{{ url('/') }}/api/v1/produtos</code>
                <br>
                Será retornado um json, para qualquer um que acessar o link.
                <br> <a href="{{url('/')}}/api/v1/produtos">Acesse o endpoint aqui </a>
            </p>
            <br>
        </div>
        <div class="overflow-hidden content-section" id="content-get-produtos-id">
            <h2 id="get-produtos-id">GET Produto(Sem Autenticação) por id - Endpoint</h2>
            <p>
                Para retornar um único produto sem a necessidade de autenticação,
                <br>
                Faça um GET para essa url:<br>
                <code class="higlighted">{{ url('/') }}/api/v1/produtos/< id-produto-aqui > </code>
                <br>
                Será retornado um json, para qualquer um que acessar o link.
                <br> <a href="{{url('/')}}/api/v1/produtos/1">Acesse o endpoint aqui para retornar um unico produto </a>
            </p>
            <br>
            <h4>PARÂMETROS DA QUERY</h4>
            <table>
                <thead>
                <tr>
                    <th>Campo</th>
                    <th>Tipo</th>
                    <th>Descrição</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>id_produto</td>
                    <td>int</td>
                    <td>Id do produto.</td>
                </tr>
               
              
                </tbody>
            </table>
        </div>
        <div class="overflow-hidden content-section" id="content-get-produtos">
            <h2 id="get-produtos">GET Produtos(Autenticado)</h2>
            <p>
                Para retornar a lista de produtos de forma autenticada, certifique-se que possua um token habilitado para leitura e com a utilização
                de uma ferramenta como o POSTMAN, insira no cabeçalho do método GET, o Bearer Token: < seu-token-aqui >.<br>
                Faça um GET para essa url:<br>
                <code class="higlighted">{{ url('/') }}/api/v1/autenticado/produtos</code>
                <br>
                Token Requirido: Ler 
            </p>
            <br>
        </div>
        <div class="overflow-hidden content-section" id="content-get-produtos-id-auth">
            <h2 id="get-produtos-id-auth">GET Produto(Autenticado) por id </h2>
            <p>
                Para retornar um único produto através de um request autenticado,
                <br>
                Faça um GET para essa url:<br>
                <code class="higlighted">{{ url('/') }}/api/v1/produtos/autenticado/< id-produto-aqui > </code>
                <br>
                Token Requerido: Ler
               
            </p>
            <br>
            <h4>PARÂMETROS DA QUERY</h4>
            <table>
                <thead>
                <tr>
                    <th>Campo</th>
                    <th>Tipo</th>
                    <th>Descrição</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>id_produto</td>
                    <td>int</td>
                    <td>Id do produto.</td>
                </tr>
               
              
                </tbody>
            </table>
        </div>
        <div class="overflow-hidden content-section" id="content-get-characters">
            <h2 id="get-characters">POST Produtos(Autenticado) - Atualizar </h2>
            <p>
                Para Atualizar um produto por id, certifique-se de possuir um token habilitado para atualização e com a utilização
                de uma ferramenta como o POSTMAN, insira no cabeçalho do método POST, o Bearer Token: < seu-token-aqui >.<br>
                Faça um POST para essa url:<br>
                <code class="higlighted">{{ url('/') }}/api/autenticado/editar/produtos/< id-produto-aqui ></code>
            </p>
            <br>
            <h4>PARÂMETROS DA QUERY</h4>
           
            <table>
                <thead>
                <tr>
                    <th>Campo</th>
                    <th>Tipo</th>
                    <th>Descrição</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>nome_produto</td>
                    <td>String(Requerido)</td>
                    <td>Nome para o produto.</td>
                </tr>
                <tr>
                    <td>slug</td>
                    <td>String(Requerido)</td>
                    <td>Slug único para o produto. Ex: meu-produto-de-teste</td>
                </tr>
                <tr>
                    <td>descricao</td>
                    <td>String(Requerido)</td>
                    <td>
                        Descrição para o produto
                    </td>
                </tr>
                <tr>
                    <td>valor_unitario</td>
                    <td>Decimal(Requerido)</td>
                    <td>
                        Valor unitário para o produto
                    </td>
                </tr>
                <tr>
                    <td>preco_promocional</td>
                    <td>Decimal(Opcional)</td>
                    <td>
                      Preço promocional para o produto, caso valor informado seja inferior ao valor unitário informado, caso superior, será considerado um valor taxado. Em caso de campo não preenchido, o valor unitário será exibido na loja.
                    </td>
                </tr>
                <tr>
                    <td>sku</td>
                    <td>String(Requerido)</td>
                    <td>SKU unico para o produto, afim de localizar mais facilmente o produto criado.</td>
                </tr>
                <tr>
                    <td>cod_barras</td>
                    <td>Numeric(Requerido)</td>
                    <td>Campo numérico para simular a criação do código de barras e qrcode</td>
                </tr>
                <tr>
                    <td>imagem</td>
                    <td>String(Opcional) - Não implementado</td>
                    <td>Campo que aceita aceita formato de imagem</td>
                </tr>
                <tr>
                    <td>categoria</td>
                    <td>Int(Opcional)</td>
                    <td>Campo para vincular o produto a um id de categoria</td>
                </tr>
                <tr>
                    <td>status_estoque</td>
                    <td>Enum(Requerido)</td>
                    <td>Informe "disponivel" ou "indisponivel" - Caso Indisponivel, o produto será ocultado para venda na loja</td>
                </tr>
                <tr>
                    <td>quantidade_estoque</td>
                    <td>int(Requerido)</td>
                    <td>Informe a quantidade de produtos no estoque. Caso 0, o produto será ocultado para venda da loga e o status_estoque será setado automaticamente para indisponivel</td>
                </tr>
                <tr>
                    <td>destaque</td>
                    <td>boolean(Requerido)</td>
                    <td>0 para produto sem destaque ou 1 para produto com destaque</td>
                </tr>
                </tbody> 
            </table>
        </div>
        <div class="overflow-hidden content-section" id="content-errors">
            <h2 id="errors">Errors</h2>
            <p>
                Código de erro da api - Não Implementado
            </p>
            <table>
                <thead>
                <tr>
                    <th>Código de erro</th>
                    <th>Significado</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>X000</td>
                    <td>
                       Alguns parametros perdidos.
                    </td>
                </tr>
                <tr>
                    <td>X001</td>
                    <td>
                     
                    </td>
                </tr>
                <tr>
                    <td>X002</td>
                    <td>
                    Desconhecido ou inválido  <code class="higlighted">api_key</code>.
                    </td>
                </tr>
                <tr>
                    <td>X003</td>
                    <td>
                    Desconhecido ou inválido  <code class="higlighted">api_key</code>.
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Github Corner Ribbon - to remove (Ribbon created with : http://tholman.com/github-corners/ )-->

<script src="{{ asset('api/js/script.js') }}"></script>
</body>

</html>