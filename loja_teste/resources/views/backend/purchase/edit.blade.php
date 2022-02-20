@extends('layouts.app')

@section('content')

    <h3 class="page-title">Pedidos</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('purchase.get.list') }}">Pedidos</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $purchase->id }}</li>
        </ol>
    </nav>


    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"> Pedido - Atualização</h4>
                    <p class="card-description"> Editar Pedido </p>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form class="forms-sample" method="POST" action="{{ route('purchase.put.edit', $purchase->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label for="purchaseInputClientCPF" class="col-sm-3 col-form-label">CPF do Client</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="hidden" id="formClientId" name="clientId"
                                        value="{{ $purchase->client->id }}">
                                    <input type="text" class="form-control" id="purchaseInputClientCPF" name="client_cpf"
                                        placeholder="CPF do Cliente" required minlength="11" maxlength="11"
                                        value="{{ $purchase->client->cpf }}">
                                    <div class="input-group-append">
                                        <button id="find-client-by-cpf" class="btn btn-lg btn-gradient-primary"
                                            type="button">Pesquisar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="purchaseInputClientName" class="col-sm-3 col-form-label">Nome do Cliente</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="purchaseInputNameClient" name="client_name"
                                    value="{{ $purchase->client->name }}" disabled>
                            </div>
                        </div>
                        <hr>
                        <h5 class="text-center">Adicionar Produtos</h5>
                        <hr>
                        <div class="form-group row">
                            <label for="purchaseInputSearchProductBarcodeQtd"
                                class="col-sm-3 col-form-label">Quantidade</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="purchaseInputSearchProductBarcodeQtd"
                                    id="purchaseInputSearchProductBarcodeQtd" placeholder="Quantidade de Produtos">
                            </div>

                            <label for="purchaseInputSearchProductBarcodeQTD" class="col-sm-3 col-form-label">Códgido de
                                Barras</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="purchaseInputSerachProductBarcode"
                                        name="barcodeSearch" placeholder="Código de Barras" minlength="20"
                                        maxlength="20">
                                    <button type="button" class="btn btn-primary" id="searchProductsByBarcode">
                                        Pesquisar
                                    </button>
                                </div>
                            </div>
                            <p id="errorBarcode" class="text-danger mt-1"></p>
                        </div>

                        <table id="productsList">
                            <caption>Produtos Adicionados</caption>
                            <thead class="p5 mt5">

                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nome do Produto</th>
                                    <th scope="col">Valor Unitário</th>
                                    <th scope="col">Código de Barras</th>
                                    <th scope="col">Quantidade</th>
                                    <th scope="col">Valor Total</th>
                                    <th scope="col">Remover</th>
                                </tr>

                            </thead>
                            <tbody id="dataProductsPurchase">
                                @foreach ($purchase->products as $product)
                                    <tr>
                                        <td data-label="#"><input type="hidden" name="productsId[]"
                                                value="{{ $product->id }}" />{{ $product->id }}</td>
                                        <td data-label="#"><input type="hidden" name="productsName[]"
                                                value="{{ $product->name }}" />{{ $product->name }}</td>
                                        <td data-label="#"><input type="hidden" name="productsPrice[]"
                                                value="{{ $product->price }}" />{{ $product->price }}</td>
                                        <td data-label="#"><input type="hidden" name="productsBarcode[]"
                                                value="{{ $product->barcode }}" />{{ $product->barcode }}</td>
                                        <td data-label="#"><input type="hidden" name="productsQuantity[]"
                                                value="{{ $product->pivot->quantity }}" />{{ $product->pivot->quantity }}
                                        </td>
                                        <td data-label="#"><input type="hidden" name="productsAmount[]"
                                                value="{{ $product->pivot->product_price }}" /><span class="productAmout">
                                                    {{ $product->pivot->product_price }}</span></td>
                                        <td data-label="Adicionar/Remover" class="text-center"><button type="button"
                                                id="removeProduct" name="{{ $product->id }}"
                                                class="btn btn-outline-danger btn-rounded btn-icon"><i
                                                    class="mdi mdi-delete"></i></button></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="form-group row">
                            <label for="purchaseInputAmount" class="col-sm-3 col-form-label">Total do Pedido</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="purchaseInputAmount" name="purchaseAmount"
                                    value="{{ $purchase->amount }}" readonly>
                            </div>
                        </div>

                        <button type="submit" id="createPurchaseSubmit"
                            class="btn btn-gradient-primary me-2">Cadastrar</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
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
                            $("#formClientId").val(result["id"]);
                        } else {
                            $("#purchaseInputNameClient").val(result);
                        }

                    }
                });
            });
            $("#searchProductsByBarcode").click(function() {

                $.ajax({
                    url: "/product/barcode",
                    data: {
                        'barcode': $("#purchaseInputSerachProductBarcode").val()
                    },
                    success: function(result) {

                        if ($.fn.dataTable.isDataTable('#productsList')) {
                            var tableProduct = $('#productsList').DataTable();
                        } else {
                            var tableProduct = $('#productsList').DataTable({
                                "lengthMenu": [20, 40, 60, 80, 100],
                                "language": {
                                    "url": 'https://cdn.datatables.net/plug-ins/1.11.4/i18n/pt_br.json'
                                },
                            });
                        }
                        var qtdProduct = $('#purchaseInputSearchProductBarcodeQtd').val();
                        var amountProduct = (qtdProduct * result["price"]);
                        var purchaseAmount = parseFloat($('#purchaseInputAmount').val());
                        $('#purchaseInputAmount').val(purchaseAmount + amountProduct);


                        tableProduct.row.add([
                            '<td data-label="#"><input type="hidden" name="productsId[]" value=' +
                            result["id"] + ' />' + result["id"] + '</td>',
                            '<td data-label="#"><input type="hidden" name="productsName[]" value=' +
                            result["name"] + ' />' + result["name"] + '</td>',
                            '<td data-label="#"><input type="hidden" name="productsPrice[]" value=' +
                            result["price"] + ' />' + result["price"] + '</td>',
                            '<td data-label="#"><input type="hidden" name="productsBarcode[]" value=' +
                            result["barcode"] + ' />' + result["barcode"] + '</td>',
                            '<td data-label="#"><input type="hidden" name="productsQuantity[]" value=' +
                            qtdProduct + ' />' + qtdProduct + '</td>',
                            '<td data-label="#"><input type="hidden" name="productsAmount[]" value=' +
                            amountProduct + ' /><span class="productAmout">' +
                            amountProduct + '</span></td>',
                            '<td data-label="Adicionar/Remover" class="text-center"><button type="button" id="removeProduct" name="' +
                            result["id"] +
                            '" class="btn btn-outline-danger btn-rounded btn-icon"><i class="mdi mdi-delete"></i></button></td>'
                        ]).draw(false);
                    },
                    error: function(error) {
                        console.log(error["responseJSON"]["message"]);
                        $("#errorBarcode").text(error["responseJSON"]["message"]);
                    }
                });
            });
            $('#productsList tbody').on('click', '#removeProduct', function() {
                var tableProduct = $('#productsList').DataTable();
                var purchaseAmount = parseFloat($('#purchaseInputAmount').val());
                console.log()

                var productAmoutSpan = parseFloat($(this).parents('tr').find(".productAmout").text());
                tableProduct
                    .row($(this).parents('tr'))
                    .remove()
                    .draw();
                console.log(purchaseAmount, productAmoutSpan);
                $('#purchaseInputAmount').val(purchaseAmount - productAmoutSpan);
            });
        });
    </script>
@endsection
