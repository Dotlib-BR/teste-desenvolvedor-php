[![](http://www.dotlib.com.br/site/images/footer/bra.png)](http://www.dotlib.com)

# Teste para candidatos à vaga de Desenvolvedor PHP

## Instruções

Primeiramente tem que clonar o repositório na sua máquina e dentro dele trocar de branch
```bash
git clone https://github.com/theusrsilva/teste-desenvolvedor-php.git

cd teste-desenvolvedor-php

git checkout Matheus-Rocha-Da-Silva

```
Depois tem que configurar o arquivo .env 
```bash
cp .env.example .env

DB_CONNECTION=mysql
DB_HOST=mysql-app //container do mysql
DB_PORT=3306
DB_DATABASE=laravel //tudo aqui foi criado no yaml do docker compose
DB_USERNAME=root
DB_PASSWORD=laravel

```
Agora é hora de iniciar os containers e acessar seu terminal
```bash
docker-compose up --build -d

docker exec -it app bash //app é o nome do container do php

```

Já dentro do container algumas configurações são necessárias, e partimos para popular o banco de dados
```bash
composer install && composer dump-autoload

php artisan key:generate

php artisan migrate --seed

```

Agora pra finalizar, dentro do terminal na sua máquina, dentro da pasta do projeto
```bash
cd /diretorio/teste-desenvolvedor-php

npm install && npm run dev

```
Agora está funcionando, só acessar o localhost certo na porta 8080 que foi colocada no yaml, caso esteja no windows vai ser necessario uns passoas a mais do docker para acessar o ip da sua máquina virtual
```bash
http://localhost:8080/
```
## Entrega

- Para iniciar o teste, faça um fork deste repositório; **Se você apenas clonar o repositório não vai conseguir fazer push.**
- Crie uma branch com o seu nome completo;
- Altere o arquivo teste.md com as informações necessárias para executar o seu teste (comandos, migrations, seeds, etc);
- Depois de finalizado, envie-nos o pull request;
- Preencha o formulário https://forms.gle/YKMoZVMe28qgX7qH8 e envie seu currículo.


