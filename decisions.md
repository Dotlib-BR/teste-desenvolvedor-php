# Decisões
Criei essa página pra documentar minha linha de raciocínio e o motivo pelo qual eu tomei determinada decisão.

## OrderProducts table

### **Problema**
Uma relação direta entre Orders e Products como demonstrada na imagem abaixo

![simple order products relation](https://raw.githubusercontent.com/henri1i/teste-desenvolvedor-php/henri-borges/images/decisions/orders-products.png)

não permitiria a criação de uma ordem de compra contendo mais de um produto, nem armazenaria o preço do produto na data de compra. Não saberiamos por quanto um produto foi comprado após o reajuste de preço de um produto.

### **Solução**
Optei pela criação de uma tabela OrderProducts responsável pela relação entre essas duas tabelas. Com isso, será possível a criação de um item para cada produto de cada ordem de compra:

![](https://github.com/henri1i/teste-desenvolvedor-php/blob/henri-borges/images/decisions/orders-oderproducts-products.png?raw=true)