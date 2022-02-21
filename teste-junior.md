# Teste para candidatos à vaga de Desenvolvedor PHP Júnior

Loja em Laravel

## Instruções

### Docker

Entre na pasta loja_teste
`
$cd loja_teste
`

Copie o .env.exemplo para o .env 
`
$cp .env.example .env
`

Edite o arquivo docker-composer.yml com o nome do usuário local

docker.composer.yml
`
version: "3.7"
services:
  app:
    build:
      args:
        user: sammy  #mesmo usuário proprietário na pasta local
        uid: 1000
      context: ./
`

Construa a imagem do app
`
$docker-compose build app
`

Inicialize o ambiente de desenvolvimento em segundo plano
`
$docker-compose up -d
`

### Instalação

Instale os pacotes através do composer
`
$docker-compose exec app composer install
`

Gere a key do laravel
`
$docker-compose exec app php artisan key:generate
`

#### Bando de Dados

Crie as tabelas do Banco de Dados
`
$docker-compose exec app php artisan migrate
`

Popule o Banco de Dados
`
$docker-compose exec app php artisan seed
`

### Execução

No navegador entre no localhost
http://localhost:8000
