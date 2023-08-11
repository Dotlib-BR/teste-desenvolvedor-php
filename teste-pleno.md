# Aplicativo de Vagas e Candidatos

Olá caro desenvolvedor ou tester!

Este é um aplicativo de exemplo desenvolvido em Laravel que gerencia vagas e candidatos.

## Pré-requisitos

Certifique-se de ter o Docker instalado em sua máquina.

- Docker: [https://www.docker.com/get-started](https://www.docker.com/get-started)

## Como Executar

1. Clone este repositório para sua máquina:

git clone https://github.com/seu-usuario/seu-projeto.git

2. Navegue até o diretório do projeto:

cd teste-pleno-php

3. Crie uma cópia do arquivo `.env.example` e renomeie para `.env`:

cp .env.example .env

4. Edite o arquivo `.env` e configure as variáveis de ambiente, incluindo as configurações do banco de dados.

5. Execute o seguinte comando para construir a imagem Docker e iniciar o contêiner:

docker-compose up -d

6. Instale as dependências do Composer:

docker-compose exec app composer install 

7. Gere a chave do aplicativo Laravel:

docker-compose exec app php artisan key:generate

9. Caso a bootstrap-ui e registration não seja acionadas sozinhos, execute:

npn install && npm run dev

9. Execute as migrações do banco de dados:

docker-compose exec app php artisan migrate


10. Acesse o aplicativo em seu navegador:

[http://localhost:8000](http://localhost:8000)

## Como Parar e Remover o Contêiner

Para parar o contêiner e remover o ambiente Docker, execute o seguinte comando:

docker-compose down

Isso encerrará o contêiner e removerá todos os recursos relacionados ao ambiente Docker.
