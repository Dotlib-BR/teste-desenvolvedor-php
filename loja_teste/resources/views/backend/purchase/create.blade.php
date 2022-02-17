@extends('layouts.app')

@section('content')

    <h3 class="page-title">Pedidos</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('purchase.get.list') }}">Pedidos</a></li>
            <li class="breadcrumb-item active" aria-current="page">Editar</li>
        </ol>
    </nav>


    <div class="card">
        <div class="card-body">
            <h4 class="card-title"> Pedido - Cadastro</h4>
            <p class="card-description"> Cadastrar Novo Pedido </p>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form class="forms-sample" method="POST" action="{{ route('purchase.post.create') }}">
                @csrf
                <div class="form-group row">
                    <label for="purchaseInputName" class="col-sm-3 col-form-label">CPF do Client</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input type="text" class="form-control" id="purchaseInputClientCPF" name="client_cpf"
                                placeholder="CPF do Cliente" required minlength="11" maxlength="11">
                            <div class="input-group-append">
                                <button id="find-client-by-cpf" class="btn btn-lg btn-gradient-primary"
                                    type="button">Search</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="purchaseInputNameClient" class="col-sm-3 col-form-label">Nome do Cliente</label>
                    <div class="col-sm-9">
                        <input type="text" class="amount-mask form-control" id="purchaseInputNameClient" name="client_name"
                            value="" disabled>
                    </div>
                </div>
                <div class="form-group row">
                <a href="#">
                    <button class="btn btn-outline-primary btn-rounded">
                    <i class="mdi mdi-cart-plus mdi-lg"></i>
                    Adicionar Produtos
                    </button>
                </a>
                </div>

                <button type="submit" id="createPurchaseSubmit" class="btn btn-gradient-primary me-2"
                    disabled>Cadastrar</button>
            </form>
        </div>
    </div>

@endsection

@section('js')
    <script>
        $("#find-client-by-cpf").click(function() {
            $.ajax({
                url: "/client/bycpf",
                data: {
                    'cpf': $("#purchaseInputClientCPF").val()
                },
                success: function(result) {

                    if (result !== 'Cliente inativo' && result !== 'Cliente não existe') {
                        let name = result["name"];
                        $("#purchaseInputNameClient").val(name);
                        $("#createPurchaseSubmit").removeAttr("disabled");

                    } else {
                        $("#purchaseInputNameClient").val(result);
                    }

                }
            });
        });
    </script>
@endsection
