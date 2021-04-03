
  

<h3  align="center">Teste Dev PHP Jr.</h3>

  

## 📝 Sumário

- [Sobre](#sobre)

- [Ambiente](#ambiente)

- [Começando](#comecando)

- [API](#API)

- [Informações Adicionais](#info)  
  

## 🧐 Sobre <a name = "sobre"></a>

  

<p>Este é um projeto de teste para a vaga de Dev PHP Jr.</p>

  

## :desert_island: Ambiente <a name="ambiente"></a>

<p>Este projeto foi feito utilizando PHP 7.3, Laravel 8 e composer 2.0.</p>

  

## 🏁 Começando <a name = "comecando"></a>

  

<p>Para iniciar o projeto, entre em Ecommerce/ pelo terminal e digite cp .env.example .env. Após ter realizado a copia do arquivo .env preencha as informações do banco (obs: não se esqueça de criar um banco mysql).</p>

<p>Após essas configurações iniciais na mesma pasta rode o comando composer install, logo em seguida rode as migrations com php artisan migrate:fresh --seed. E claro, não menos importante rode o comando php artisan serve para iniciar o servidor web.</p>

  

## :floppy_disk: API <a name="api"></a>

<p>Este projetinho conta com uma API onde possui os 3 CRUDS solicitados.</p>

<p>Para testar utilize a seguinte documentação no <a  href="https://documenter.getpostman.com/view/15227275/TzCP8TTD">postman</a>.</p>

  
 ## :heavy_plus_sign: Informações adicionais <a name="info"></a>
 <p>A aplicação possuí dois sistemas de login, um para o admin e um para o usuário comum. Caso queira acessar o admin acesse /admin-login. Para os usuários comuns você pode pegar um usuário do banco (a seed gera um admin e 10 usuários) ou até mesmo criar o seu, fique a vontade ;)</p>
 <p>OBS: O e-mail do admin é admin@admin.com.br e a senha é 123456. Essa senha se aplica aos usuários comuns gerados pela seed, porém o e-mail é gerado randomicamente, então será necessário pegar um no banco.</p>
  

## 👌 Fim