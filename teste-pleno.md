[![](http://www.dotlib.com.br/site/images/footer/bra.png)](http://www.dotlib.com)

# Teste para candidatos à vaga de Desenvolvedor PHP Pleno

## Requesitos
-   Docker version 20.10.9.
-   Docker-compose version 1.29.2

**OBS: O procedimento a seguir foi executado em um sistema linux (Fedora 35)**

## Ambiente
- Realizar o clone do projeto e acessar a branch **jose-handerson-da-silva**
- Na pasta raiz do projeto aonde se encontra o arquivo **docker-compose.yml**  execute o seguinte comando:
```
docker-compose up --build
```

## Configurações do projeto

- Gerando o arquivo de configuração
```
Raiz do projeto
mv app/dotlib-vagas/.env.example app/dotlib-vagas/.env  
```

- Instalando as dependecias do projeto
```
docker exec -it web_app  composer install
```
 Caso esteja utilizando algum sistema linux execute na raiz do projeto:
 ```
 Raiz do projeto
 sudo chmod -R 777 app
```
- Execuntando as migrations
```
docker exec -it web_app  php artisan migrate
```

- Execuntando as seeders
```
docker exec -it web_app  php artisan db:seed
```

- Execuntando os testes
```
docker exec -it web_app  vendor/bin/phpunit
```

Se tudo ocorreu bem o projeto estará acessivel em http://localhost:8000/.

Para acessar o sistema é necessario realizar um cadastro básico e logar no sistema com o mesmo.



## Tarefas realizadas
- CRUD de vagas.
- CRUD de candidatos.
- Listagem e busca das inscrições.
- Um cadidato pode se inscrever em uma ou mais vagas.
- Deve ser ser possível "pausar" a vaga, evitando a inscrição de candidatos.
- Deve ser filtrável e ordenável por qualquer campo, e possuir paginação de 20 itens.
- Deve possuir formulários para criação e atualização de seus itens.
- Deve permitir a deleção de qualquer item de sua lista.
- Implementar validações de campos obrigatórios e tipos de dados.
- Testes unitários e de unidade (Unitários e Feature).
- Implementar autenticação de usuário na aplicação.


## Tarefas não realizadas
- API Rest JSON para todos os CRUDS listados acima.
- Permitir deleção em massa de itens nos CRUDs.
- Permitir que o usuário mude o número de itens por página.


## Link de demostração
O projeto proposto está acessivel no link http://vagas.mobsystem.com.br.






