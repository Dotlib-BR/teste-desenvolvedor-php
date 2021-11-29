[![](http://www.dotlib.com.br/site/images/footer/bra.png)](http://www.dotlib.com)


# Teste para candidatos à vaga de Desenvolvedor PHP Pleno

## Configurando o projeto

Iniciar os containers

```
$ docker-compose up
```

Acessar a pasta `www` e executar o comando para instalar as dependências
```
$ docker-compose exec -T app composer install
```
Criar o arquivo .env e setar as configurações do banco de dados

```
$ docker-compose exec -T app cp .env.example .env
```
No arquivo .env na raiz do projeto, mude as configurações do banco de dados como está abaixo

```env
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=prova
DB_USERNAME=prova
DB_PASSWORD=123456

```
Agora com o banco configurado, vamos executar as migrations juntamente com os seeders para popular a base com alguns dados

```
$ docker-compose exec -T app php artisan migrate --seed
```

O projeto pode ser acessado em http://localhost:8100


Para rodar testes de caso

```
$ docker-compose exec -T app php artisan test
```

### Deixo no repositorio 2 arquivos exportados do postman, um contendo uma coleção com as requests prontas para os endpoints, e o outro é a configuração de ambiente utilizado por essas coleções, se servir de ajuda.


------------------------------------------------

## Descrição do teste/projeto

O desafio consiste em implementar uma aplicação web utilizando o framework PHP Laravel, um banco de dados relacional (Mysql, Postgres ou SQLite), que terá como finalidade a inscrição de candidatos a uma oportunidade de emprego.

Sua aplicação deve possuir:

- CRUD de vagas:
  - Criar, editar, excluir e listar vagas.
  - A vaga pode ser CLT, Pessoa Jurídica ou Freelancer.
- CRUD de candidatos:
  - Criar, editar, excluir e listar candidatos.
- Um cadidato pode se inscrever em uma ou mais vagas.
- Deve ser ser possível "pausar" a vaga, evitando a inscrição de candidatos.
- Cada CRUD:
  - Deve ser filtrável e ordenável por qualquer campo, e possuir paginação de 20 itens.
  - Deve possuir formulários para criação e atualização de seus itens.
  - Deve permitir a deleção de qualquer item de sua lista.
  - Implementar validações de campos obrigatórios e tipos de dados.
- Testes unitários e de unidade.

## Banco de dados

- O banco de dados deve ser criado utilizando Migrations do framework Laravel, e também utilizar Seeds e Factorys para popular as informações no banco de dados.

## Tecnologias a serem utilizadas

Devem ser utilizadas as seguintes tecnologias:

- HTML
- CSS
- Javascript
- Framework Laravel (PHP)
- Docker (construção do ambiente de desenvolvimento)
- Mysql, Postgres ou SQLite

## Entrega

- Para iniciar o teste, faça um fork deste repositório; **Se você apenas clonar o repositório não vai conseguir fazer push.**
- Crie uma branch com o seu nome completo;
- Altere o arquivo teste-pleno.md com as informações necessárias para executar o seu teste (comandos, migrations, seeds, etc);
- Depois de finalizado, envie-nos o pull request;
- Preencha o formulário https://forms.gle/YKMoZVMe28qgX7qH8 e envie seu currículo.

## Bônus

- API Rest JSON para todos os CRUDS listados acima.
- Permitir deleção em massa de itens nos CRUDs.
- Permitir que o usuário mude o número de itens por página.
- Implementar autenticação de usuário na aplicação.

## O que iremos analisar

- Organização do código;
- Aplicação de design patterns;
- Aplicação de testes;
- Separação de módulos e componentes;
- Legibilidade;
- Criação do ambiente com Docker.

### Boa sorte!
