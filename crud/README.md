

### Passo a passo
Clone Repositório
```sh
git clone https://github.com/wendell-priebe/teste-desenvolvedor-php.git
```

Acessar pasta crud
```sh
cd teste-desenvolvedor-php/crud
```

Suba os containers do projeto
```sh
docker-compose up -d
```

Acessar o container
```sh
docker-compose exec app bash
```

Instalar as dependências do projeto
```sh
composer install
```

Cria as tabelas do banco de dados através do migrate
```sh
php artisan migrate
```

Acesse o projeto
[http://localhost:8989](http://localhost:8989)
