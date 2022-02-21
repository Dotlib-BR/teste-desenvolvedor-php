<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Pedidos</title>
    <link rel="stylesheet" href="{{ asset('site/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('site/style.css') }}">
</head>
<body>
    @include('templates.header')

    <div style="display: block; text-align: right">
        <button type="button" style="margin-right: 3em"  class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalAddRequest">
            Add pedido
        </button>
    </div>

    <table style="width: 85%" class="mx-auto table">
        <thead>
        <tr>
            <th scope="col"><a href="/requests/id" style="color: black; text-decoration: none;">Número</a></th>
            <th scope="col"><a href="/requests/status_id" style="color: black; text-decoration: none;">Status</a></th>
            <th scope="col"><a href="/requests/date" style="color: black; text-decoration: none;">Data de entrega</a></th>
            <th scope="col"><a href="/requests/created_at" style="color: black; text-decoration: none;">Data de criação</a></th>
            <th scope="col">Ações</th>
        </tr>
        </thead>
        <tbody>
        @foreach($requests as $request)
            <tr>
                <th scope="row">{{ $request->id }}</th>
                <td style="text-transform: lowercase">{{ $request->status }}</td>
                <td>{{ $request->date }}</td>
                <td>{{ $request->created_at }}</td>
                <td>
                    <button class="btn btn-primary" type="button" onclick="showModalDetails({{ $request->id }})" data-bs-toggle="modal" data-bs-target="#modalRequestDetail">ver</button>
                    <button class="btn btn-danger" type="button" onclick="removeRequest({{ $request->id }})">excluir</button>
                </td>
            </tr>
        @endforeach
        </tbody>
        <div class="d-flex justify-content-center">
            {{ $requests->links() }}
        </div>
    </table>

    <!-- Modal -->
    <div class="modal fade" id="modalAddRequest" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Insira os detalhes do pedido</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">


                    <form method="POST" action="{{ route('add.request') }}">
                        @csrf
                        <div class="row mb-3">
                            <label for="date" class="col-sm-2 col-form-label">Data</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" name="date" required>
                            </div>
                        </div>
                        @if(session('user.admin'))
                            <div class="row mb-3">
                                <label for="client_id" class="col-sm-2 col-form-label">Cliente</label>
                                <select class="form-select col-sm-10" name="client_id" aria-label="Default select example" required>
                                    @foreach($clients as $client)
                                        <option value="{{ $client->id }}">{{ $client->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                        <input id="submit_form_request_input" type='submit'>
                    </form>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary mb-lg-5" id="submit_form_request_btn">Adicionar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalRequestDetail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Insira os detalhes do pedido</h5>
                    <button type="button" id="clearForm" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <label for="client" class="col-sm-2 col-form-label">Cliente</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="client_ajax" readonly>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="products_ajax" class="col-sm-2 col-form-label">Produtos</label>
                        <div class="col-sm-10" id="products_ajax">

                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="status_ajax" class="col-sm-2 col-form-label">Status</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="status_ajax" readonly>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="date_ajax" class="col-sm-2 col-form-label">Entrega</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="date_ajax" readonly>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="created_at_ajax" class="col-sm-2 col-form-label">Criado em</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="created_at_ajax" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('site/jquery.js') }}"></script>
    <script src="{{ asset('site/bootstrap.js') }}"></script>
    <script>

        var imputFormRequest = $('#submit_form_request_input');
        var btnFormRequest = $('#submit_form_request_btn');
        $(btnFormRequest).click(() => {
            imputFormRequest.click()
        });
        imputFormRequest.hide();




        function showModalDetails(id) {
            var request = null;
            var client = null;
            // ajax para buscar os detalhes do pedido pelo id
            $.ajax({
                headers: { 'csrftoken' : '{{ csrf_token() }}' },
                url: '\\ajax/request/get/' + id,
                type: 'get',
                dataType: 'json',
                success: function (resRequest) {
                    request = resRequest;
                    // ajax para buscar os detalhes do cliente pelo id
                    $.ajax({
                        headers: { 'csrftoken' : '{{ csrf_token() }}' },
                        url: '\\ajax/clients/get/' + request.client_id,
                        type: 'get',
                        dataType: 'json',
                        success: function (resClient) {
                            client = resClient;

                            $.ajax({
                                headers: { 'csrftoken' : '{{ csrf_token() }}' },
                                url: '\\ajax/orders/get/' + resRequest.id,
                                type: 'get',
                                dataType: 'json',
                                success: function (resOrders) {

                                    // remove dados dos produtos anteriores
                                    $('#products_ajax').children().remove();

                                    // injeta os dados da requisicao no modal
                                    $('#client_ajax').val(client.name);
                                    $('#status_ajax').val(request.status).css('text-transform', 'lowercase');
                                    $('#date_ajax').val(request.date);
                                    $('#created_at_ajax').val(request.created_at);
                                    resOrders.forEach((el) => {
                                        let name = el.name;
                                        let qtd = el.qtd
                                        let total_value = (Math.round((el.qtd * el.unit_value) * 100) / 100).toFixed(2);

                                        $('#products_ajax').append(`<input type="text" class="form-control" value="${name} - ${qtd} unidades - R$ ${total_value}" readonly>`);
                                    });



                                },
                                error: function (err) {
                                    console.error(err);
                                }
                            });
                        },
                        error: function (err) {
                            console.error(err);
                        }
                    });
                },
                error: function (err) {
                    console.error(err);
                }
            });
        }

        function removeRequest(id) {
            // ajax para remover o pedido pelo id
            $.ajax({
                headers: { 'csrftoken' : '{{ csrf_token() }}' },
                url: '\\ajax/request/delete/' + id,
                type: 'get',
                success: function (res) {
                    window.location.href= '\\requests/' + 'id';
                },
                error: function (err) {
                    console.error(err);
                }
            });
        }
    </script>
</body>
</html>
