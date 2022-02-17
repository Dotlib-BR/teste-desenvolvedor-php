[![](https://dotlib.com/theme/img/logos/logo.png)](http://www.dotlib.com)
#Comandos necessários de serem rodados para iniciar o projeto
php composer i
\
php artisan migrate --seed

###Dados do banco
    database: teste_desenvolvedor
    username: root
    password:

####URI e JSON Body de cada rota
##Cliente
* GET - *api.show.one.cliente*
    * URI - /api/cliente/listar/{id}
    * *Não possui JSON.*

<hr>

* POST - *api.show.all.cliente*
    * URI - /api/cliente/listar
```json
{
    "filtro": null,
    "order": "asc",
    "orderCampo": null,
    "quantPagina": 20
}
```

<hr>

* POST - *api.create.cliente*
    * URI - /api/cliente/cadastro
```json
{
    "nome": "Gustavo Freitas",
    "cpf": "12345678910",
    "email": null
}
```
<hr>

* PUT - *api.update.cliente*
    * URI - /api/cliente/atualizar/{id}
```json
{
    "nome": "Gustavo Freitas",
    "cpf": "12345678910",
    "email": null
}
```
<hr>

* DELETE - *api.delete.cliente*
    * URI - /api/cliente/deletar/{id}
    * *Não possui JSON.*

##Produto
* GET - *api.show.one.produto*
    * URI - /api/produto/listar/{id}
    * *Não possui JSON.*

<hr>

* POST - *api.show.all.produto*
    * URI - /api/produto/listar
```json
{
    "filtro": null,
    "order": "asc",
    "orderCampo": null,
    "quantPagina": 20
}
```

<hr>

* POST - *api.create.produto*
    * URI - /api/produto/cadastro
```json
{
    "quantidade": 5,
    "valorUnitario": 9800,
    "nomeProduto": "PC Gamer"
}
```
<hr>

* PUT - *api.update.produto*
    * URI - /api/produto/atualizar/{id}
```json
{
    "quantidade": 5,
    "valorUnitario": 9800,
    "nomeProduto": "PC Gamer"
}
```
<hr>

* DELETE - *api.delete.produto*
    * URI - /api/produto/deletar/{id}
    * *Não possui JSON.*


##Pedido
* GET - *api.show.one.pedido*
    * URI - /api/pedido/listar/{id}
    * *Não possui JSON.*

<hr>

* POST - *api.show.all.pedido*
    * URI - /api/pedido/listar
```json
{
    "filtro": null,
    "order": "asc",
    "orderCampo": null,
    "quantPagina": 20
}
```

<hr>

* POST - *api.create.pedido*
    * URI - /api/pedido/cadastro
```json
{
    "status": 1,
    "idCliente": 1,
    "produtos": [
        {
            "idProduto": 1,
            "quantidade": 2
        },
        {
            "idProduto": 2,
            "quantidade": 1
        }
    ]
}
```
<hr>

* PUT - *api.update.pedido*
    * URI - /api/pedido/atualizar/{id}
```json
{
    "status": 3,
    "produtosExcluir": [1],
    "produtosCadastro": [
        {
            "idProduto": 3,
            "quantidade": 3
        },
        {
            "idProduto": 4,
            "quantidade": 1
        }
    ]
}
```
<hr>

* PUT - *api.pay.pedido*
    * URI - /api/pedido/pagar/{id}
    * *Não possui JSON.*

<hr>

* PUT - *api.cancel.pedido*
    * URI - /api/pedido/cancelar/{id}
    * *Não possui JSON.*

<hr>

* DELETE - *api.delete.pedido*
    * URI - /api/pedido/deletar/{id}
    * *Não possui JSON.*

# Nossa empresa

A Dot.Lib distribui conteúdo online científico e acadêmico a centenas de instituições espalhadas pela América Latina. Temos como parceiras algumas das principais editoras científicas nacionais e internacionais. Além de prover conteúdo, criamos soluções que atendem às necessidades de nossos clientes e editoras.

## Conheça mais sobre a Dotlib

https://dotlib.com/

https://www.linkedin.com/company/dotlib/

# Descrição da vaga

Buscamos profissionais que sejam apaixonados por desenvolvimento, inovação e novas tecnologias, para integrar nosso time em projetos baseados em Node.JS, Laravel, React.JS e React Native.

## Requisitos

### **Obrigatórios:**

- Mínimo 1 ano de experiência em desenvolvimento de sites e sistemas em Laravel;
- Desenvolvimento de APIs RESTful;
- Conhecimentos em SQL e NoSQL;
- Conhecimentos em Docker;
- Controle de versões (GIT).

### **Diferenciais:**

- TDD;
- Conhecimentos em Node.JS;
- Conhecimentos em Elasticsearch;
- Conhecimentos em serviços AWS;
- Experiência em metodologias ágeis (Scrum/Kanban).

## Benefícios

- Salário compatível com o mercado;
- Vale Refeição ou Vale Alimentação;
- Plano de Saúde e Odontológico;
- Equipe unida, divertida e apaixonada por hambúrgueres;
- TECH DAY - Evento trimestral de palestras sobre tecnologia;
- Friday's Talk - Bate papo descontraído sobre tecnologia, apresentação de POCs de estudos, etc;
- Emendas em feriados nacionais.

## Contratação

Regime: CLT

## Alocação

100% Remoto

## Como se candidatar

Para se candidatar, basta acessar a url de acordo com o nível e realizar o teste para a vaga:

- [Desenvolvedor PHP Júnior](teste-junior.md)
- [Desenvolvedor PHP Pleno](teste-pleno.md)
