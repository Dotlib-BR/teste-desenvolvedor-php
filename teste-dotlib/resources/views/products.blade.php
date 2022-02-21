<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Produtos</title>
    <link rel="stylesheet" href="{{ asset('site/bootstrap.css') }}">
</head>
<body>
    @include('templates.header')

    @if(session('user.admin'))
        <div style="display: block; text-align: right">
            <button type="button" style="margin-right: 3em"  class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalAddProduct">
                Add produto
            </button>
        </div>
    @endif

    <table style="width: 85%" class="mx-auto table">
        <thead>
        <tr>
            <th scope="col"><a href="/products/id" style="color: black; text-decoration: none;">Número</a></th>
            <th scope="col"><a href="/products/name" style="color: black; text-decoration: none;">Nome</a></th>
            <th scope="col"><a href="/products/unit_value" style="color: black; text-decoration: none;">Valor</a></th>
            <th scope="col"><a href="/products/bar_code" style="color: black; text-decoration: none;">Código</a></th>
            <th scope="col">Ações</th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
            <tr>
                <th scope="row">{{ $product->id }}</th>
                <td>{{ $product->name }}</td>
                <td>R$ {{ $product->unit_value }}</td>
                <td>{{ $product->bar_code }}</td>
                <td>
                    @if(!session('user.admin'))
                        <button class="btn btn-primary" type="button" onclick="showModalAddInRequest({{ $product->id }}, {{ session('user.id') }})" data-bs-toggle="modal" data-bs-target="#modalAddProductRequest">adicionar à pedido</button>
                    @elseif(session('user.admin'))
                        <button class="btn btn-primary" type="button" onclick="showModalUpdate({{ $product->id }})" data-bs-toggle="modal" data-bs-target="#modalProductUpdate">ver</button>
                        <button class="btn btn-danger" type="button" onclick="removeProduct({{ $product->id }})">excluir</button>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
        <div class="d-flex justify-content-center">
            {{ $products->links() }}
        </div>
    </table>

    <!-- Modal -->
    <div class="modal fade" id="modalAddProductRequest" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Insira os detalhes do pedido</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <label for="requests_ajax" class="col-sm-10 col-form-label">Selecione o número do pedido</label>
                        <select class="form-select col-sm-10" id="requests_ajax" aria-label="Default select example" required>

                        </select>
                    </div>

                    <div class="row mb-3">
                        <label for="qtd" class="col-sm-10 col-form-label">Quantidade</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="qtd" value="1" min="1">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" onclick="addProductInRequest()">Adicionar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalAddProduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Insira os detalhes do produto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form method="POST" action="{{ route('add.product') }}">
                        @csrf
                        <div class="row mb-3">
                            <label for="name" class="col-sm-2 col-form-label">Nome</label>
                            <div class="col-sm-10">
                                <input value="{{ old('cpf') }}" type="text" name="name" class="form-control" maxlength="100">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="unit_value" class="col-sm-2 col-form-label">Valor unitário</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="unit_value" id="unit_value" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="bar_code" class="col-sm-2 col-form-label">Código de barras</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="bar_code" maxlength="20" required>
                            </div>
                        </div>

                        <input id="submit_form_product_input" type='submit'>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary mb-lg-5" id="submit_form_product_btn">Adicionar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalProductUpdate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Insira os detalhes do pedido</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <label for="name" class="col-sm-2 col-form-label">Nome</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" id="name" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="unit_value" class="col-sm-2 col-form-label">Valor</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="unit_value" id="unit_value_modal" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="bar_code" class="col-sm-2 col-form-label">Codigo de barras</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="bar_code" id="bar_code" maxlength="20" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" onclick="updateProduct()">Atualizar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('site/jquery.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
    <script src="{{ asset('site/bootstrap.js') }}"></script>
    <script>
        $(document).ready(function(){
            $('#unit_value').mask('R$ 9.99');
            $('#unit_value_modal').mask('R$ 9.99');
        });

        var imputFormProduct = $('#submit_form_product_input');
        var btnFormProduct = $('#submit_form_product_btn');
        $(btnFormProduct).click(() => {
            imputFormProduct.click()
        });
        imputFormProduct.hide();

        var data = null;

        var productId = null;

        function showModalAddInRequest(id, user_id) {
            productId = id;
            $('#requests_ajax').children().remove();

            $.ajax({
                headers: { 'csrftoken' : '{{ csrf_token() }}' },
                url: '\\ajax/request/user/get/' + user_id,
                type: 'get',
                success: function (res) {
                    res.forEach((el) => {
                        $('#requests_ajax').append('<option value=' + el.id + '>' + el.id + '</option>');
                    });
                },
                error: function (err) {
                    console.log(err);
                }
            });
        }

        function addProductInRequest() {
            console.log($('#requests_ajax').val());

            $.ajax({
                url: '\\ajax/orders/post/',
                type: 'get',
                data: {
                    request_id: $('#requests_ajax').val(),
                    product_id: productId,
                    qtd: $('#qtd').val()
                },
                success: function (res) {
                    window.location.href= '\\products/' + 'id';
                },
                error: function (err) {
                    console.error(err);
                }
            });
        }

        function showModalUpdate(id) {
            // ajax para remover o produto pelo id
            $.ajax({
                headers: { 'csrftoken' : '{{ csrf_token() }}' },
                url: '\\ajax/product/get/' + id,
                type: 'get',
                success: function (res) {
                    data = res;
                    $('#name').val(res.name);
                    $('#unit_value_modal').val('R$ ' + res.unit_value);
                    $('#bar_code').val(res.bar_code);
                },
                error: function (err) {
                    console.error(err);
                }
            });
        }

        function updateProduct() {
            $.ajax({
                headers: { 'csrftoken' : '{{ csrf_token() }}' },
                url: '\\ajax/product/update/' + data.id,
                type: 'get',
                data: {
                    id: data.id,
                    name: $('#name').val(),
                    unit_value: $('#unit_value_modal').val(),
                    bar_code: $('#bar_code').val()
                },
                success: function (res) {
                    window.location.href= '\\products/' + 'id';
                },
                error: function (err) {
                    console.error(err);
                }
            });
        }

        function removeProduct(id) {
            // ajax para remover o produto pelo id
            $.ajax({
                headers: { 'csrftoken' : '{{ csrf_token() }}' },
                url: '\\ajax/products/delete/' + id,
                type: 'get',
                success: function (res) {
                    window.location.href= '\\products/' + 'id';
                },
                error: function (err) {
                    console.error(err);
                }
            });
        }
    </script>
</body>
</html>
