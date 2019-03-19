@extends('adminlte::page')

@section('title', 'Teste WebDev - Pedidos')

@section('content_header')
    <h1>Pedidos</h1>
@stop

@section('content')
    <div class="box">

        <div class="box-header">
            <h3 class="box-title">Adicionar</h3>
        </div>
        
        <!-- /.box-header -->

        <div class="box-body">
            @if ($message = Session::get('danger'))
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> Erro!</h4>
                    {{$message}}
                </div>
            @endif
            @if (count($errors) > 0)
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-ban"></i> Ops!</h4>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </div>
                
            @endif
           
            {!! Form::open(
                array(
                'route' => 'orders.store',
                'method'=>'POST',
                'role'=>'form',
                'class'=>'row'
            )) !!}
            {{ csrf_field() }}
                <div class="col-md-12">
                    <div class="form-group">
                        <strong>Produtos:</strong>
                        {!! Form::text('product', null, array('placeholder' => 'Nome do produto', 'id' => 'product', 'class' => 'form-control', 'required', 'maxlength' => '50')) !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <strong>Data do pedido:</strong>
                        {!! Form::date('order_date', null, array('rows' => 2, 'class' => 'form-control', 'required')) !!}
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <strong>Status:</strong>
                        {!! Form::select('status',
                            [
                                'Em Aberto'       => 'Em Aberto',
                                'Pago'     => 'Pago'
                            ],
                            null, ['placeholder' => 'Selecione...', 'id' => 'status', 'class'=>'form-control', 'required']);
                        !!}
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <strong>Cliente:</strong>
                        {!! Form::select('client', $clients, null, array('placeholder' => 'Selecione...', 'class' => 'form-control', 'required')) !!}
                    </div>
                </div>

                <div class="col-md-12"><hr>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Produto</th>
                                <th scope="col">Valor unitário</th>
                                <th scope="col">Código de barras</th>
                                <th scope="col">Quantidade do produto</th>
                                <th scope="col">Quantidade do pedido</th>
                            </tr>
                        </thead>
                        <tbody class="product-list">
                            
                        </tbody>
                    </table>
                </div>

                <div class="products">
                    
                </div>

                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                    <button type="button" class="btn btn-info back-button"
                        onclick="location.href='{{ route('orders.index') }}'">Voltar
                    </button>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
    
@stop

@section('js')
<script>
    $(function() {
        $("#product").autocomplete({
            source: "/orders/new/getproduct",
            minLength: 3,
            select: function (event, ui) {
                var pid = ui.item.pid;
                var p = ui.item;
                var op = 'orderprod'+pid;
                $('.products').append("<input type='hidden' id='product"+ pid +"'name='products[]' value="+ pid +">");

                $('.product-list').append("<tr id='"+op+"'><th scope='row'>"+pid+"</th><td>"+p.name+"</td><td>"+p.price+"</td><td>"+p.barcode+"</td><td>"+p.qtt+"</td><td><input type='text' required name='qtt_prod_"+pid+"' id='qtt-prod"+pid+"'></td><td><a onclick="+"removeOrder('"+op+"','"+pid+"')"+"><i class='fa fa-close'></i></a></td></tr>");
                
            }
            
        });
        
         
    });

    function removeOrder(op,pid) {
        $('#'+op).remove();
        $('#product'+pid).remove();
    }
</script>
@stop