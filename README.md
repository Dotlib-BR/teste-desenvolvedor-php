[![](http://www.dotlib.com.br/site/images/footer/bra.png)](http://www.dotlib.com)

# Teste para candidatos à vaga de Desenvolvedor PHP Pleno

## Configurações iniciais

- Para que o projeto funcione e necessário seguir os seguintes passos:
  - Entre na pasta do projeto
        - Rode os seguintes comandos
            - Clone o laradock
                - git clone https://github.com/laradock/laradock.git
                - Entre na pasta laradock e copie o .env.example para .env
                -OBS:Vou enviar uma pasta com o nome AMBIENTES, vai ficar na raiz do projeto ja configurado, vc tera que copiar os, para a raiz do projeto e ou outro para a pasta laradock, removi os postos para o passar pelo gitinore
            - Crie a imagem
                - sudo docker-compose up -d nginx mysql phpmyadmin
            - Verifique o status do container
                - sudo docker-compose ps
            - Acesso como usuario laradock
                - sudo docker-compose exec --user=laradock workspace bash
            - Crie as migrations e o seeders
                - php artisan migrate:fresh --seed

O que foi desenvolvido:

- CRUD de vagas:
  - Criar, editar, excluir e listar vagas. -> Feito
  - A vaga pode ser CLT, Pessoa Jurídica ou Freelancer. -> Feito
- CRUD de candidatos:
  - Criar, editar, excluir e listar candidatos. -> Feito
- Um cadidato pode se inscrever em uma ou mais vagas. -> Feito
- Deve ser ser possível "pausar" a vaga, evitando a inscrição de candidatos. -> FEITO
- Cada CRUD:
  - Deve ser filtrável e ordenável por qualquer campo, e possuir paginação de 20 itens. -> FEITO (Usei o datatable a listagem esta em forma de tabela)
  - Deve possuir formulários para criação e atualização de seus itens. -> FEITO
  - Deve permitir a deleção de qualquer item de sua lista. -> FEITO
  - Implementar validações de campos obrigatórios e tipos de dados. ->FEITO
- Testes unitários e de unidade. -> NÃO FOI FEITO.

## Banco de dados
 -> FEITO
- O banco de dados deve ser criado utilizando Migrations do framework Laravel, e também utilizar Seeds e Factorys para popular as informações no banco de dados.

## Tecnologias a serem utilizadas
-> FEITO
Devem ser utilizadas as seguintes tecnologias:

- HTML
- CSS
- Javascript
- Framework Laravel (PHP)
- Docker (construção do ambiente de desenvolvimento)
- Mysql, Postgres ou SQLite

## Entrega

- Para iniciar o teste, faça um fork deste repositório; **Se você apenas clonar o repositório não vai conseguir fazer push.**
- Crie uma branch com o seu nome completo;
- Altere o arquivo teste-pleno.md com as informações necessárias para executar o seu teste (comandos, migrations, seeds, etc);
- Depois de finalizado, envie-nos o pull request;
- Preencha o formulário https://forms.gle/YKMoZVMe28qgX7qH8 e envie seu currículo.

## Bônus

- API Rest JSON para todos os CRUDS listados acima. -> FEITO PARCIALMENTE (IMPLEMENTEI O SISTEMA DE AUTENTICAÇÃO COM JWT, POSSUI METODOS PARA: LOGAR, DESLOGAR, ATUALIZAR TOKEN, VISUALIZAR INFOMAçÃO DE USUÁRIO LOGADO, E LISTA TODOS OS USUARIOS CADASTRADOS)
- Permitir deleção em massa de itens nos CRUDs. -> FEITO APENAS USUÁRIOS COM PERFIL ADM PODEM REALIZAR O CRUD DAS VAGAS E DE OUTROS USUARIOS (O USUARIO LOGADO NAO PODE EXCLUIR ELE MESMO) 
- Permitir que o usuário mude o número de itens por página. ->FEITO (USANDO datatables) 
- Implementar autenticação de usuário na aplicação

## Mais detalhes
 - Após rodar as seeders va até o banco e escolhar um usuário que esteja com o perfil adm seja igual a 1.
   - Se o usuario possuir apenas o perfil user igual a 1, ele so poderar se cadastrar nas vagas e cancelar a candidatura e editar seus proprios dados.
   - Se o usuario estiver com adm igual 0 e user igual 0, ele nao podera acessar o sistema.
   - E possivel com o perfil Adm ativar e destivar usuarios e vagas.
   - Quando excluir um usuario ou uma vaga a qual ambos estão vinculados, o vinculo e excluído junto, criei uma tabela auxiliar para registrar os vinculos dos candidatos com as vagas. 
