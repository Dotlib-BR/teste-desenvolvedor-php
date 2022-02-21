# Olá, esse é meu projeto de teste para a vaga de desenvolvedor php junior

## Instruções para testar:

#### Primeiramente, entre no doretório teste-dotlib.

#### 1. Execute o comando docker-compose up -d para subir os containers do laravel e do mysql.
#### 2. Execute o comando docker exec -it {{ conteiner_laravel_id }} bash para abrir o projeto com o bash.
#### 3. Execute o comando npm install para baixar as dependencias do projeto.
#### 4. Execute o comando composer install para instalar as dependências do laravel.
#### 5. Criar o .env do projeto e adicione os seguintes parametros para o banco

* DB_CONNECTION=mysql
* DB_HOST=dotlib-db
* DB_PORT=3306
* DB_DATABASE=docker
* DB_USERNAME=docker
* DB_PASSWORD=docker


#### 6. Execute o comando php artisan key:generate para gerar a chave.
#### 7. Depois de adicionado as variáveis ao .env e criado a chave está na hora de rodas as migrations, o comando é php artisan migrate.
#### 8. O último passo é executar os seeds e factorys com o comando php artisan db:seed.
#### 9. O sistema já está rodadando na porta 8000.


## Particularidades do sistema
	
##### Existe um usuario admin que pode manipular varias coisas do sistema, incluindo adicionar, editar e apagar dados de clientes, pedidos e produtos, alem disso, ele tem acesso a todos os dados do banco, isso quer dizer que ele tem acesso a todos os clientes, produtos e pedidos de qualquer cliente da plataforma. As credenciais de acesso do admin sao cpf: 11111111111 e senha: admin
#### Já os usuários normais tem acesso aos dados que tem relação com ele, os dados de outrol usuário não podem ser acessados.
#### As tabelas de produtos, pedidos e clientes sao todas paginaveis por 20 e pode ter a ordem de exibicao dos dados relacionados a todas as colunas.
#### Todos os botões do site funcionam e realizam ações.
