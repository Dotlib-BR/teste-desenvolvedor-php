

# Teste para candidatos à vaga de Desenvolvedor PHP Júnior


## Instruções

- clone o repositório
- instale as dependências: composer install
- execute os contêineres (foi utilizado o laradock para construção do ambiente): docker-compose up -d nginx mysql phpmyadmin
- execute as migrations: php artisan migrate
- execute os seeders um de cada vez: php artisan db:seed --class=ClientesTableSeeder (gera 30 clientes aleatórios)
  php artisan db:seed --class=ProdutosTableSeeder (gera 30 produtos aleatórios)
- Acesse o endereço http://localhost:80 e tenha acesso a aplicação






