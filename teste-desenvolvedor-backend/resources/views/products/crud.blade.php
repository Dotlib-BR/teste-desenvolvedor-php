@extends('layout.navbar')

@section('title', 'Produtos')

@section('content')

    <div class="wrapper">
        <div class="container-fluid">

            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Produtos</h4>
                    </div>
                </div>
            </div>
            <!-- end page title end breadcrumb -->


            <div class="row">
                <div class="col-12">
                    <div class="card-box table-responsive">
                        <h4 class="m-t-0 header-title"><b>{{ isset($product) ? "Editar Produto" : "Criar Novo Produto" }}</b></h4>
                        <p class="text-muted font-14 m-b-30">
                            Formulário para {{ isset($product) ? "edição de um Produto" : "criação de novo Produto" }}.
                        </p>

                        <form id="form-client" method="POST" action=" {{ isset($product) ? route("produtos.update", $product->id) : route("produtos.store")}} " enctype="multipart/form-data">

                            @csrf
                            @isset($product)
                                @method("PUT")
                            @else
                                @method("post")
                            @endisset

                            @component('products.form', [ "product" => isset($product) ? $product : null])
                            @endcomponent

                        </form>

                        <div class="d-flex justify-content-end mt-3">
                            <button type="submit" form="form-client" class="btn btn-success mr-2">Salvar</button>
                            <a href=" {{ route('produtos.index') }}" class="btn btn-outline-success">Voltar</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->

        </div> <!-- end container -->
    </div>
    <!-- end wrapper -->

@endsection

