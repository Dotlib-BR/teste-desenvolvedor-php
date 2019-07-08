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
* Autorizar a escrita nos diretórios `storage/logs`, `storage/framework` e `bootstrap/cache` se der erro `permission danied`.
* Na raiz do projeto:
    * Intalar as dependências PHP: `composer install`.
     * Instalar as dependências JavaScript: `npm install`
        * Executar os scripts NPM para compilar os recursos: `npm run dev`
    * Gerar a chave da aplicação: `php artisan key:generate`
    * Criar o banco de dados.
	    * Popular o banco de dados: `php artisan migrate:refresh --seed`.


## TDD

* Parar rodar os testes execute na raiz do projeto: `vendor/phpunit/phpunit/phpunit --verbose`

#### Observações:
* Como existe diversas formas diferentes para realizar esse teste, optei por faze-lo da forma mais "Manual" possível, 
para mostrar que não sei apenas usar algo pronto, como também sou capaz de criar uma funcionalidade de forma customizada.

* [Aqui está o link](http://18.228.38.70/) de um projeto que comecei a desenvolver há pouco tempo como freelancer.
    
    * Tecnologias e Ferramentas utilizadas:
        * Nginx
        * Laravel 5.8
        * JWT
        * DataTable
        * Bootstrap
        * Jquery
        * Guzzle PHP HTTP client
        * Chart.JS
        
    * Credenciais para visualizar
        * Email: `dev@dev.com`
        * Senha: `password`
        * Código da Unidade: `1234`

* Meu linkedin é [Vlademir Manoel](https://www.linkedin.com/in/vlademir-manoel-73b89b153/)
