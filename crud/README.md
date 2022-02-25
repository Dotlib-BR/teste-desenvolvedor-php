
*Apenas para esse caso específico, para facilitar a execução, o arquivo ```.env``` foi enviado para o github, nele já contem a ```APP_KEY``` e a conexão com o banco de dados.

### Passo a passo
Passo a passo detalhado com os comandos para executar a aplicação, facilitado para copiar e colar no terminal.

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
