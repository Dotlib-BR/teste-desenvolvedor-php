<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Laravel - Teste Processo Seletivo - Vaga Remota - Laravel 

Protótipo simples de uma aplicação em Laravel que cadastra produtos, clientes e simula compras.
<p align="center">
  <img src="./screenshots/img01.png"  width="100%">
</p>

- [Veja a Demonstração](https://lojadev.algoritmo9.site).

-Login Admin
- login: admin@admin.com
- senha: password

Login cliente 
- login: cliente@cliente.com
- senha: password
ou cadastre um novo usuário

## Instalação

 - Clone para o seu servidor
 - Insira suas credenciais no arquivo .env
 - Tenha o node a partir da v12 instalado
 - Rode sudo npm install e sudo npm run dev para que o frontend seja compilado
 - Rode php artisan migrate para criar as tabelas necessárias
 - Rode php artisan db:seed para criar automaticamente produtos, categorias e usuários
	- Usuário admin criado : admin@admin.com / password  - Usuário cliente criado: cliente@cliente.com
 - Certifique-se que possui acesso para escrita na pasta /storage

 
 - Em alguns casos pode ser necessário regenerar o link storage na pasta pública. Delete a pasta /storage localizado em /public e rode o comando: php artisan storage:link

### Simulação de Compras

   Para esse teste, não foi incluido nenhum gateway de pagamento.
   Credenciais para simular uma compra, após inclusão de produto no carrinho:
    - Numero do cartão: 4242424242424242 - Compra só será aprovada se esse numero do cartão for inserido, demais dados do cartão poderá ser qualquer valor.
	- CPF: O sistema verificará se cpf é unico e válido. Insira apenas números no cpf. Você pode gerar um cpf ficticio em : geradordecpf.org
	
   # Cupons
   
   Para utilizar cupom de desconto no momento da compra, crie antes no painel do admin alguns cupons para ser usado para um determidado produto e insira o número do cupom no momento da compra.
   O valor total com desconto aparecerá automaticamente.
 
### Api

   Utilize ferramenta como o Postman para de forma autenticada via token, realizar uma edição de unico produto, listar todos ou listar por id.
   Também é possivel retornar sem autenticação, via url o json de todos os produtos cadastrados.
   Criação e exclusão para produtos via api ainda não implementadas.
   Para criação do token, acesse o menu Api Tokens e cadastre uma nova chave.
   
- *GET: /api/v1/produtos -* - Retorna em json, via url, todos os produtos cadastrados no sistema, sem necessidade de autenticação
- *GET: /api/v1/produtos/< id-produto-aqui > -* - Retorna em json, via url, um único produto.
- *GET: /api/v1/autenticado/produtos -* (Requer Token com permissão de leitura) - Retorna a lista de produtos se token informado no header da requisição.
- *GET: /api/v1/produtos/autenticado/< id-produto-aqui > -* (Requer Token com permissão de leitura) - Retorna um unico produto se token informado no header da requisição.
- *POST: /api/autenticado/editar/produtos/< id-produto-aqui > -* (Requer Token com permissão de edição) - Edita um produto se token informado no header da requisição. 


## Capturas de tela

<p align="center">
  <img src="./screenshots/img01.png"  width="100%">
</p>
<p align="center">
  <img src="./screenshots/img1.png"  width="100%">
</p>
<p align="center">
  <img src="./screenshots/img2.png"  width="100%">
</p>
<p align="center">
  <img src="./screenshots/img3.png"  width="100%">
</p>
<p align="center">
  <img src="./screenshots/img4.png"  width="100%">
</p>
<p align="center">
  <img src="./screenshots/img5.png"  width="100%">
</p>
<p align="center">
  <img src="./screenshots/img6.png"  width="100%">
</p>
<p align="center">
  <img src="./screenshots/img7.png"  width="100%">
</p>
<p align="center">
  <img src="./screenshots/img8.png"  width="100%">
</p>
<p align="center">
  <img src="./screenshots/img9.png"  width="100%">
</p>
<p align="center">
  <img src="./screenshots/img10.png"  width="100%">
</p>
<p align="center">
  <img src="./screenshots/img11.png"  width="100%">
</p>
<p align="center">
  <img src="./screenshots/img12.png"  width="100%">
</p>
<p align="center">
  <img src="./screenshots/img13.png"  width="100%">
</p>
<p align="center">
  <img src="./screenshots/img14.png"  width="100%">
</p>
<p align="center">
  <img src="./screenshots/img15.png"  width="100%">
</p>
<p align="center">
  <img src="./screenshots/img16.png"  width="100%">
</p>
<p align="center">
  <img src="./screenshots/img17.png"  width="100%">
</p>
<p align="center">
  <img src="./screenshots/img18.png"  width="100%">
</p>
<p align="center">
  <img src="./screenshots/img19.png"  width="100%">
</p>
<p align="center">
  <img src="./screenshots/img20.png"  width="100%">
</p>
<p align="center">
  <img src="./screenshots/img21.png"  width="100%">
</p>
<p align="center">
  <img src="./screenshots/img22.png"  width="100%">
</p>
<p align="center">
  <img src="./screenshots/img23.png"  width="100%">
</p>
<p align="center">
  <img src="./screenshots/img24.png"  width="100%">
</p>
<p align="center">
  <img src="./screenshots/img25.png"  width="100%">
</p>
<p align="center">
  <img src="./screenshots/img26.png"  width="100%">
</p>
<p align="center">
  <img src="./screenshots/img27.png"  width="100%">
</p>
<p align="center">
  <img src="./screenshots/img28.png"  width="100%">
</p>
<p align="center">
  <img src="./screenshots/img29.png"  width="100%">
</p>
<p align="center">
  <img src="./screenshots/img30.png"  width="100%">
</p>
<p align="center">
  <img src="./screenshots/img31.png"  width="100%">
</p>
<p align="center">
  <img src="./screenshots/img32.png"  width="100%">
</p>
<p align="center">
  <img src="./screenshots/img33.png"  width="100%">
</p>
<p align="center">
  <img src="./screenshots/img34.png"  width="100%">
</p>
<p align="center">
  <img src="./screenshots/img35.png"  width="100%">
</p>
<p align="center">
  <img src="./screenshots/img36.png"  width="100%">
</p>
<p align="center">
  <img src="./screenshots/img37.png"  width="100%">
</p>
<p align="center">
  <img src="./screenshots/img38.png"  width="100%">
</p>
<p align="center">
  <img src="./screenshots/img39.png"  width="100%">
</p>



## 2021


