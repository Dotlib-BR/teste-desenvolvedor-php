

# Teste para candidatos à vaga de Desenvolvedor PHP Júnior


## Instruções

- clone o repositório
- instale as dependências: composer install
- execute os contêineres (foi utilizado o laradock para construção do ambiente): docker-compose up -d nginx mysql phpmyadmin
- execute as migrations: php artisan migrate
- execute os seeders um de cada vez: php artisan db:seed --class=ClientesTableSeeder (gera 30 clientes aleatórios)
  php artisan db:seed --class=ProdutosTableSeeder (gera 30 produtos aleatórios)
- Acesse o endereço http://localhost:80 e tenha acesso a aplicação

## Modelo de dados

A modelagem inicial para a implementação solução é a seguinte:

[![](/images/modelo.png)](http://www.dotlib.com)

Você deve alterar esta modelagem para que a mesma cumpra com as três primeiras formas normais.

Além disso, a implementação deste modelo em um banco de dados relacional deve ser realizada levando em consideração os seguintes requisitos:

- O banco de dados deve ser criado utilizando Migrations do framework Laravel, e também utilizar Seeds e Factorys para popular as informações no banco de dados.
- Implementação das validações necessárias na camada que julgar melhor.

## Tecnologias a serem utilizadas

Devem ser utilizadas as seguintes tecnologias:

- HTML
- CSS
- Javascript
- Framework Laravel (PHP)
- Docker (construção do ambiente de desenvolvimento)

## Entrega

- Para iniciar o teste, faça um fork deste repositório; **Se você apenas clonar o repositório não vai conseguir fazer push.**
- Crie uma branch com o seu nome completo;
- Altere o arquivo teste-junior.md com as informações necessárias para executar o seu teste (comandos, migrations, seeds, etc);
- Depois de finalizado, envie-nos o pull request;

## Bônus

- Implementar autenticação de usuário na aplicação.
- Permitir que o usuário mude o número de itens por página.
- Permitir deleção em massa de itens nos CRUDs.
- Implementar aplicação de desconto em alguns pedidos de compra.
- Implementar a camada de Front-End utilizando a biblioteca javascript Bootstrap e ser responsiva.
- API Rest JSON para todos os CRUDS listados acima.

## O que iremos analisar

- Organização do código;
- Aplicação de design patterns;
- Separação de módulos e componentes;
- Legibilidade;
- Criação do ambiente com Docker.

### Boa sorte!
