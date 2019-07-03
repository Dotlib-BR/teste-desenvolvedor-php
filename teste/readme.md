# Teste para Dot.Lib

## Server Requirements

* PHP >= 7.1.3
* BCMath PHP Extension
* Ctype PHP Extension
* JSON PHP Extension
* Mbstring PHP Extension
* OpenSSL PHP Extension
* PDO PHP Extension
* Tokenizer PHP Extension
* XML PHP Extension
* Node.js >= 6 (inclui NPM)

## Instruções

* Renomear o arquivo `.env.example` para `.env`.
* Configurar o arquivo `.env`.
    * Informar os dados da conexão com o banco de dados: prefixo `DB_`.
    * Não precisa informar os dados do servidor de email pois estou utilizando o mailtrap.io.

* Apontar a raiz do servidor web para a pasta `public`.
* Autorizar a escrita nos diretórios `storage`, `bootstrap/cache` se der erro `permission danied`.
* Na raiz do projeto:
    * Intalar as dependências PHP: `composer install`.
     * Instalar as dependências JavaScript: `npm install`
        * Executar os scripts NPM para compilar os recursos: `npm run dev`
    * Gerar a chave da aplicação: `php artisan key:generate`
    * Criar banco de dados.
	    * Popular o banco de dados: `php artisan migrate:refresh --seed`.


## TDD

* Parar rodar os testes execute na raíz do projeto: `vendor/phpunit/phpunit/phpunit --verbose`
