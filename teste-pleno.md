# Crud-Laravel-Pleno

## Pré-requisitos

Certifique-se de ter o Docker e o Docker Compose instalados em sua máquina. 
Caso não tenha, você pode instalá-los seguindo as instruções em:

- [**Docker**](https://docs.docker.com/get-docker/)
- [**Docker Compose**](https://docs.docker.com/compose/install/)

## Configurando o Ambiente

1. Clone este repositório da branch thiagocsoares para o diretório desejado em sua máquina:

git clone https://github.com/seu-usuario/nome-do-seu-projeto.git

2. Navegue até o diretório do projeto:

entre na pasta:
cd crud-laravel-pleno 
Em seguida crie um arquivo .env a partir do arquivo .env.example:
Edite o arquivo .env e ajuste as variáveis de ambiente conforme necessário.

3. Iniciando a Aplicação

Navegue até o diretório do projeto:

cd crud-laravel-pleno

Abra um terminal e execute o seguinte comando para construir os contêineres Docker e iniciar os serviços:

docker-compose up -d
Aguarde até que os contêineres sejam criados e os serviços sejam inicializados.

4. Execute o seguinte comando para instalar as dependências do Laravel:

docker-compose exec app composer install

5 Execute as migrações do banco de dados:

./vendor/bin/sail artisan migrate

6. Execute as Seeds

./vendor/bin/sail artisan db:seed

7. Acessando a Aplicação
Após concluir as etapas acima, você poderá acessar a aplicação em seu navegador em:

http://localhost:sua-porta-no-env
