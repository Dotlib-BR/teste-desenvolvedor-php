@extends('layout.navbar')

@section('title', 'Pedidos')

@section('content')

    <div class="wrapper">
        <div class="container">

            <div class="row" style="margin-top: 3%">
                <div class="col-12">
                    <div class="card-box table-responsive">
                        <h4 class="m-t-0 header-title"><b>{{ isset($order) ? "Editar Pedido" : "Criar Novo Pedido" }}</b></h4>
                        <p class="text-muted font-14 m-b-30">
                            Formulário para {{ isset($order) ? "edição de um Pedido" : "criação de novo Pedido" }}.
                        </p>

                        <div style="display: flex;justify-content: space-between" class="card-header py-2 mb-3">
                            <h2 class="mt-3">Total: R$ 299,00</h2>
                            <button type="submit" form="form-client" class="btn btn-success my-2" style="margin-bottom: 1.5rem!important;">Finalizar Pedido</button>
                        </div>

                        <form id="form-client" method="POST" action=" {{ isset($order) ? route("pedidos.update, $order->id") : route("pedidos.store")}} " enctype="multipart/form-data">

                            @csrf
                            @isset($order)
                                @method("PUT")
                            @else
                                @method("post")
                            @endisset

                            @component('orders.form', [ "order" => isset($order) ? $order : null, "products" => $products ])
                            @endcomponent

                        </form>

                        <div class="d-flex justify-content-end mt-3" style="margin-bottom: 3%">
                            <a href=" {{ route('pedidos.index') }}" class="btn btn-outline-success">Voltar</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->

        </div> <!-- end container -->
    </div>
    <!-- end wrapper -->
@endsection
