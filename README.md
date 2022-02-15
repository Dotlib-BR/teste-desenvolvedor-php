<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

[![](http://www.dotlib.com.br/site/images/footer/bra.png)](http://www.dotlib.com)

# Teste para vaga de Desenvolvedor PHP Júnior

Olá caro recrutador, nesse teste utilizei meu conhecimento para tentar entregar o que foi solicitado.

## Instruções

``` git
  git clone xxxxxx
```
Crie o arquivo do banco de dados na pasta 'database'

``` bash
  touch database/database.sqlite
```

Faça uma cópia do arquivo .env.exeample para .env e edite as configurações de acesso ao banco de dados.
```bash
  cp .env.example .env
```

de:
```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```
para:

```dotenv
DB_CONNECTION=sqlite
#DB_HOST=127.0.0.1
#DB_PORT=3306
#DB_DATABASE=laravel
#DB_USERNAME=root
#DB_PASSWORD=
```

baixe as dependências do composer
```composer
  composer install
```

crie uma chave criptografada para o sistema
```laravel
  php artisan key:generate
```

crie as tabelas no banco de dados, executando a migração
```laravel
  php artisan migrate
```
ou assim para popular as tabelas de clientes e produtos
```laravel
  php artisan migrate --seed
```


### Obrigado!
