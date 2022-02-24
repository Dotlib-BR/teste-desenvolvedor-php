[![](http://www.dotlib.com.br/site/images/footer/bra.png)](http://www.dotlib.com)

# Rodando o projeto

1. Clone o projeto

```terminal
$ git clone -b henri-borges https://github.com/henri1i/teste-desenvolvedor-php.git && cd teste-desenvolvedor-php
```

2. Crie o .env do docker

```terminal
$ cd docker && cp .env.example .env
```

3. Crie o .env do projeto laravel

```terminal
$ cp ../app/.env.example ../app/.env
```

3. Rode os seguintes containers e acesse o container workspace

```terminal
$ docker-compose up --build -d mariadb nginx workspace && docker exec -u laradock -it laradock_workspace_1 bash
```

4. Instalação composer e npm

```terminal
$ composer install
```

```terminal
$ npm install && npm run dev
```

5. Gerar app_key, rodar migrations e seeders

```terminal
$ php artisan key:generate && php artisan migrate --seed
```