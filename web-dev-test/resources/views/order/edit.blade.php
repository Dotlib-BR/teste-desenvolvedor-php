@extends('adminlte::page')

@section('title', 'Teste WebDev - Pedidos')

@section('content_header')
    <h1>Pedidos</h1>
@stop

@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Visualizar pedido</h3>
        </div>
        <!-- /.box-header -->
        
        <div class="box-body">
            @if (count($errors) > 0)
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-ban"></i> Ops!</h4>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </div>
                
            @endif
           
            {!! Form::model($order,
                [
                    'method' => 'PATCH',
                    'route' => ['orders.update', $order->id],
                    'class'=> 'row',
                    'id' => 'form-order'
                ])
            !!}
            {{ csrf_field() }}
                <div class="col-md-12">
                    <div class="form-group">
                        <strong>Produtos:</strong>
                        {!! Form::text('product', null, array('placeholder' => 'Nome do produto', 'id' => 'product', 'class' => 'form-control', 'maxlength' => '50')) !!}
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
                                'Pago'     => 'Pago',
                                'Cancelado'  => 'Cancelado'
                            ],
                            null, ['placeholder' => 'Selecione...', 'id' => 'status', 'class'=>'form-control', 'required']);
                        !!}
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <strong>Cliente:</strong>
                        {!! Form::select('client', $clients, $client, array('placeholder' => 'Selecione...', 'class' => 'form-control', 'required')) !!}
                    </div>
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
                <div class="col-md-12"><hr>
                    <h3>Produtos</h3>
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
                            <tbody class="products-list">
                                @foreach ($products as $key => $product)
                                    <tr id="{{'orderprod'.$product->id}}" class='orderprod'>
                                        <th scope='row'>{{$product->id}}</th>
                                        <td>{{$product->name}}</td>
                                        <td>{{$product->price}}</td>
                                        <td>{{$product->bar_code}}</td>
                                        <td>{{$product->quantity}}</td>
                                        <td>
                                        {!! Form::open(
                                            array(
                                            'route' => 'update.qtt',
                                            'method'=>'POST',
                                            'role'=>'form',
                                            'class'=>'row'
                                        )) !!}
                                        {{ csrf_field() }}
                                            <input type="hidden" name="order_id" class='order-id' value="{{ $order->id }}">
                                            <input type="hidden" name="product_id" class='prod-id' value="{{ $product->id }}">
                                            <input type='text'  name='qtt' class='qtt' id='qtt' value="{{$qtt[$product->id][0]->qtd_order}}" required>
                                        {!! Form::close() !!}
                                        </td>
                                        <td>
                                            <a href="{{route('delete.product', [$order->id, $product->id])}}"><i class='fa fa-close'></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                </div>
            
        </div>
    </div>
@stop

@section('js')
<script>
    $('#form-order input').on('keypress', function(e) {
        return e.which !== 13;
    });
    
    $(function() {
        $("#product").autocomplete({
            source: "/orders/new/getproduct",
            minLength: 3,
            select: function (event, ui) {
                var pid = ui.item.pid;
                var p = ui.item;
                var op = 'orderprod'+pid;
                $('.products').append("<input type='hidden' id='product"+ pid +"'name='products[]' value="+ pid +">");
                $('.products').append("<input type='hidden' id='qttproduct"+ pid +"'name='qtt_product_"+pid+"'>");
                $('.products-list').append("<tr id='"+op+"'><th scope='row'>"+pid+"</th><td>"+p.name+"</td><td>"+p.price+"</td><td>"+p.barcode+"</td><td>"+p.qtt+"</td><td><input onfocusout="+"updateQtt('"+op+"','"+pid+"')"+" class='qttprod' type='text' required name='uctqtt_prod_"+pid+"' id='qtt-prod-"+pid+"'></td><td><a onclick="+"removeOrder('"+op+"','"+pid+"')"+"><i class='fa fa-close'></i></a></td></tr>");
                
            }
            
        }); 
    });

    function updateQtt(op, pid) {
        $("#qttproduct"+pid).val($("#qtt-prod-"+pid).val());
    }

    function removeOrder(op,pid) {
        $('#'+op).remove();
        $('#product'+pid).remove();
    }

    function removeOld() {
        $(this).parent().parent().remove();
        return false;
    }

    var prodId;
    var orderId;

    $(".qtt").on('click', function() {
        prodId = $(this).siblings('.prod-id').val();
        orderId = $(this).siblings('.order-id').val();
    });

    $(".qttprod").on("input", function(){
        console.log('oi');
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
@stop