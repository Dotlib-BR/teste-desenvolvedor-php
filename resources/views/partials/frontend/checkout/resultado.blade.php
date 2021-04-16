<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<style>
._failed{ border-bottom: solid 4px red !important; }
._failed i{  color:red !important;  }

._success {
    box-shadow: 0 15px 25px #00000019;
    padding: 45px;
    width: 100%;
    text-align: center;
    margin: 40px auto;
    border-bottom: solid 4px #28a745;
}

._success i {
    font-size: 55px;
    color: #28a745;
}

._success h2 {
    margin-bottom: 12px;
    font-size: 40px;
    font-weight: 500;
    line-height: 1.2;
    margin-top: 10px;
}

._success p {
    margin-bottom: 0px;
    font-size: 18px;
    color: #495057;
    font-weight: 500;
}
</style>
</head>
<body>
<div class="container">
@if($verifica ===1)
  <div class="row justify-content-center">
    <div class="col-md-5">
      <div class="message-box _success">
        <i class="fa fa-check-circle" aria-hidden="true"></i>
        <h2> PAGAMENTO APROVADO</h2>
        <p> Agradecemos pela compra<br>
         Acesse o seu dashboard para acompanhar o status do seu pedido </p>
         <a href="{{route('ClienteDashboard')}}" class="btn btn-primary">Dashboard</a>
         <a href="{{route('index')}}"  class="btn btn-secondary">continuar comprando</a>
      </div>
    </div>
  </div>
  <hr>
@else
  <div class="row justify-content-center">
    <div class="col-md-5">
      <div class="message-box _success _failed">
        <i class="fa fa-times-circle" aria-hidden="true"></i>
        <h2> Falha na Transação </h2>
        <p> Reveja o método de pagamento fornecido </p>
        <a href="{{route('produtos-carrinho')}}" class="btn btn-primary">Voltar para o carrinho</a>
      </div>
    </div>
  </div>
@endif
</div>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>