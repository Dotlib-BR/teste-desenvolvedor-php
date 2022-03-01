[![](http://www.dotlib.com.br/site/images/footer/bra.png)](http://www.dotlib.com)

# Teste para candidatos à vaga de Desenvolvedor PHP Júnior

Olá caro desenvolvedor, nesse teste analisaremos seu conhecimento geral e inclusive velocidade de desenvolvimento. Abaixo explicaremos tudo o que será necessário.

## Instruções

O desafio consiste em implementar uma aplicação Web utilizando o framework PHP Laravel, e um banco de dados relacional SQLite, MySQL ou Postgres, a partir de uma modelagem de dados inicial desnormalizada, que deve ser normalizada para a implementação da solução.

Você vai criar uma aplicação de cadastro de pedidos de compra, a partir de uma modelagem inicial, com as seguintes funcionalidades:

- CRUD de clientes.
- CRUD de produtos.
- CRUD de pedidos de compra, com status (Em Aberto, Pago ou Cancelado).
- Cada CRUD:
  - deve ser filtrável e ordenável por qualquer campo, e possuir paginação de 20 itens.
  - deve possuir formulários para criação e atualização de seus itens.
  - deve permitir a deleção de qualquer item de sua lista.
- Barra de navegação entre os CRUDs.
- Links para os outros CRUDs nas listagens (Ex: link para o detalhe do cliente da compra na lista de pedidos de compra)

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
