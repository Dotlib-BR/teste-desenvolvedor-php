
<img src="https://dotlib.com/theme/img/logos/logo.png">

<h1>Aplicação</h1>

<p>
Essa aplicação foi construida para o desafio Dot.lib e simula um sistema que gerencia pedidos,
clientes e produtos. Nessa aplicação é possível vizualizar, ordenar, editar e deletar qualquer
tupla de qualquer tabela do banco de dados referente ao desafio.
</p>

<h3> Nessa aplicação é possivel:</h3>

<h5>Clientes</h5>

<ul>
  
<li>Vizualizar todos os clientes</li>
<li>Vizualizar um cliente</li>
<li>Ordenar consultas por nome, email e CPF</li>
<li>Criar um cliente</li>
<li>Editar um cliente</li>
<li>Deletar um cliente</li>
  
</ul>

<h5>Produtos</h5>

<ul>
  
<li>Vizualizar todos os produtos</li>
<li>Vizualizar um produto</li>
<li>Ordenar consultas por nome, código de barras e preço</li>
<li>Criar um produto</li>
<li>Editar um produto</li>
<li>Deletar um produto</li>
  
</ul>

<h5>Pedidos</h5>

<ul>
  
<li>Vizualizar todos os pedidos</li>
<li>Vizualizar um pedido</li>
<li>Ordenar consultas por data, n° do pedido, cliente, produto, status e quantidade</li>
<li>Criar um pedido</li>
<li>Editar um pedido</li>
<li>Deletar um pedido</li>
  
</ul>

<h1>Backend</h1>

<p>
O backend dessa aplicação foi feita em laravel 8, utilizando PSR's e padrões da projetos.
</p>

<h4> Requisitos para executar a aplicação:</h4>

<ul>
  
<li>Servidor Apache (wamp, xampp ou qualquer um de sua preferência)</li>
<li>PHP >= 7.0</li>
<li>Composer</li>
<li>MySQL</li>
<li>NPM</li>
  
</ul>

<h3>Instalação do backend</h3>

<p>
Primeiro faça o download do arquivo no repositório ou utilize o comando
git clone se estiver utilizando o GIT, dentro da pasta publica do seu servidor apache.
</p>

<p>
Dentro da raiz do projeto execute o comando composer install, assim ele criará a pasta
vendor com todas as dependências do projeto.
</p>

<p>
Em seguida crie um arquivo com nome ".env" (sem as aspas). Na raiz do projeto
existe um arquivo chamado .env.exemple, copie todo o conteúdo dentro dele e cole dentro
do arquivo .env que vc acabou de criar.
</p>

<p>
Depois disso vc abrirá o terminal na raiz do projeto e executará os seguintes comandos:
</p>

<ul>
  
<li>php artisan key:generate</li>
<li>php artisan config:clear</li>
<li>php artisan config:cache</li>
  
</ul>

<p>
Agora você precisa criar uma base de dados no MySQL, pode usar qualquer nome desde que
ele seja igual ao valor da constante DB_DATABASE dentro do arquivo .env que foi
criado nos passos anteriores.
</p>

<p>
Para encerrar, você irá criar as tabelas do seu banco de dados usando migrations e
usar seeds e factories para popular o banco de dados. <br>
Execute os seguintes comandos respectivamente:
</p>

<ul>
  
<li>php artisan migrate</li>
<li>php artisan db:seed</li>
  
</ul>

<p>
Tudo pronto! Agora é usar o comando "php artisan serve"(sem as aspas) e utilizar a aplicação.
Se você não modificou alguma configuração do laravel geralmente o servidor é executado
no endereço http://127.0.0.1:8000 .
</p>

<h4> Métodos</h4>

<p>As requisições para a API devem seguir os padrões:</p>

<h5>Clientes</h5>

<table>

<thead>
  
<tr>
  
<th>método</th>
<th>URI</th>
<th>Descrição</th>
  
</tr>
  
</thead>

<tbody>
  
<tr>

<td>GET</td>
<td>/client</td>
<td>Retorna todos os registros de clientes do banco de dados.</td>
  
</tr>
  
<tr>

<td>GET</td>
<td>/client/{client}</td>
<td>Retorna as informações de um único cliente através id.</td>
  
</tr>
  
<tr>

<td>POST</td>
<td>/client</td>
<td>Insere um cliente no banco de dados.</td>
  
</tr>
  
<tr>

<td>PUT</td>
<td>/client/{client}</td>
<td>Atualiza as informações de um usuário através do id.</td>
  
</tr>
  
<tr>

<td>DELETE</td>
<td>/client/{client}</td>
<td>Deleta um usuário através do id no banco de dados.</td>
  
</tr>
  
</tbody>

</table>

<h5>Produtos</h5>

<table>
<thead>
<tr>
<th>método</th>
<th>URI</th>
<th>Descrição</th>
</tr>
</thead>
<tbody>
<tr>

<td>GET</td>
<td>/product</td>
<td>Retorna todos os registros de produtos do banco de dados.</td>
  
</tr>
  
<tr>

<td>GET</td>
<td>/product/{product}</td>
<td>Retorna as informações de um único produto através id.</td>
  
</tr>
  
<tr>

<td>POST</td>
<td>/product</td>
<td>Insere um produto no banco de dados.</td>
  
</tr>
  
<tr>

<td>PUT</td>
<td>/product/{product}</td>
<td>Atualiza as informações de um produto através do id.</td>
  
</tr>
  
<tr>
  
<td>DELETE</td>
<td>/product/{product}</td>
<td>Deleta um produto através do id no banco de dados.</td>
  
</tr>
  
</tbody>
  
</table>

<h5>Pedidos</h5>

<table>
  
<thead>
  
<tr>
  
<th>método</th>
<th>URI</th>
<th>Descrição</th>
  
</tr>
  
</thead>
  
<tbody>
  
<tr>

<td>GET</td>
<td>/order</td>
<td>Retorna todos os registros de pedidos do banco de dados.</td>
  
</tr>
  
<tr>

<td>GET</td>
<td>/order/{order}</td>
<td>Retorna as informações de um único pedido através id.</td>
  
</tr>
  
<tr>

<td>POST</td>
<td>/order</td>
<td>Insere um pedido no banco de dados.</td>
  
</tr>
  
<tr>

<td>PUT</td>
<td>/order/{order}</td>
<td>Atualiza as informações de um pedido através do id.</td>
  
</tr>
  
<tr>
  
<td>>DELETE</td>
<td>/order/{order}</td>
<td>Deleta um pedido através do id no banco de dados.</td>
  
</tr>
  
</tbody>
  
</table>

<h1>Frontend</h1>

<p>
O frontend foi feito utilizando a Engine Blade do laravel e bootstrap na versão 5 e
está todo responsivo.
</p>

<h3>Acessando o site</h3>

<p>
O site é bem simples e intuitivo para que seu uso seja fácil e simples. Você pode
navegar entre as páginas através da barra de navegação. Todos os botões e links da
página estão na cor azul, facilitando sua localização.
</p>

<p>
	Os cabeçalhos das tabelas são links, e você pode clica-lós para deixar suas informações
	em ordem crescente. Os ícones no final de cada registro são respectivamente paraver, 
	editar e deletar o item escolhido. O nome da tabela fica logo acima dela, e ao lado
	dele fica obotão para adicionar um novo registro .
</p>