# Teste Junior

## Overview

Usuário deve ser capaz de:
 - Realizar opearções CRUD para clientes, produtos, descontos e pedidos.
 - Adicionar produtos a pedidos.
 - Adicionar desconto a pedidos.
 - Realizar boa parte dessas operações por meio da API (menos os descontos).

Interface toooooltamente inspirada (se não copiada) [desse site](https://demo.filamentphp.com/).

## Preview

![](https://github.com/henri1i/teste-desenvolvedor-php/blob/henri-borges/images/preview.gif?raw=true)

## Como rodar o projeto?
[Passo a passo aqui](https://github.com/henri1i/teste-desenvolvedor-php/blob/henri-borges/teste-junior.md)

## Como rodar os testes?
Deve ser criado um banco de dados específico para testes a sua conexão deve ser configurada no .env
Por exemplo:

1. Criação do banco de dados  "testing"
```terminal
$ docker exec -u root -it laradock_mariadb_1 bash

# mysql -p root

mysql> CREATE DATABASE testing;
```
2. Configuração no .env
```terminal
DB_TEST_DATABASE=testing
DB_TEST_USERNAME=root
DB_TEST_PASSWORD=root
```

## Melhorias a serem feitas

- Proteção de rotas com middleware e criação de página de login.
- Permitir deleção em massa a partir do componente da tabela.
- Permitir abertura de sidebar no modo mobile.
- Criar endpoints para API de criação e uso dos descontos.

## Decisões

Documentei [aqui](https://github.com/henri1i/teste-desenvolvedor-php/blob/henri-borges/decisions.md) algumas das minhas linhas de raciocínio ao longo do desenvolvimento, e o motivo de determinada decisão.