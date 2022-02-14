Teste Junior:

Preparo do docker:

docker run -d -p 3306:3306 --name desafio-teste -e "MYSQL_DATABASE=desafio" -e "MYSQL_ROOT_PASSWORD=password" -e MYSQL_ROOT_HOST='%' -d mysql:5.7

Comandos para criar o usuario do mysql:

CREATE USER 'username'@'localhost' IDENTIFIED BY 'password';

GRANT ALL PRIVILEGES ON _._ TO 'username'@'localhost' WITH GRANT OPTION;

CREATE USER 'username'@'%' IDENTIFIED BY 'password';

GRANT ALL PRIVILEGES ON _._ TO 'username'@'%' WITH GRANT OPTION;

FLUSH PRIVILEGES;

Comandos para instalar as dependencias do laravel no projeto:

composer install && composer dump-autoload

Renomeie o arquivo .env.example para .env e configure a conexão com o banco de dados MySQL.

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=desafio_dotlib
DB_USERNAME=username
DB_PASSWORD=password

Por fim, execute o comando php artisan migrate:fresh --seed para popular o banco de dados.

Documentação da API

https://documenter.getpostman.com/view/7035979/UVeNo48Q#200aa48a-709a-410c-a9f6-a5b44a33c734
