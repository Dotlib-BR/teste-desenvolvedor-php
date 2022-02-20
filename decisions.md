# Decisões
Criei essa página pra documentar minha linha de raciocínio e o motivo pelo qual eu tomei determinada decisão.

## OrderProducts table
#### **Problema**
Uma relação direta entre Orders e Products como demonstrado na imagem abaixo:

não permitiria a criação de uma ordem de compra contendo mais de um produto, nem armazenaria o preço do produto na data de compra. Não saberiamos por quanto um produto foi comprado após o reajuste de preço de um produto.