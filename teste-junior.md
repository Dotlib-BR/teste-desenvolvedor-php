# Teste para candidatos à vaga de Desenvolvedor PHP Júnior

Loja em Laravel

## Instruções

### Docker

Inicialize o ambiente de desenvolvimento
`
$docker up
`

### Instalação

Entre na pasta loja_teste
`
$cd loja_teste
`

Instale os pacotes através do composer
`
$composer install
`

Copie o .env.exemplo para o .env (já está com a configuração do docker)
`
$cp .env.example .env
`

Gere a key do laravel
`
$php artisan key:generate
`

#### Bando de Dados

Crie as tabelas do Banco de Dados
`
$php artisan migrate
`

Popule o Banco de Dados
`
$php artisan seed
`

### Execução

Execute o servidor
`
$php artisan serve
`

No navegador entre no localhost
http://localhost:8000

Caso queira entrar no phpmyadmin
http://localhost:8080