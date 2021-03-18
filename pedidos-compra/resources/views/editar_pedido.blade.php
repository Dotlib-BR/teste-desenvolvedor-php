@extends('principal')

@section('conteudo')

<form method="post" action="{{route('salvar.pedido.editado', $pedido->id)}}">

    {{ csrf_field() }}


    <div class="form-group">
        <label for="data_pedido">Data do Pedido</label>
        <input type="date" class="form-control" name="data_pedido" value="{{$pedido->data_pedido}}">
    </div>


    <div class="form-group">
        <label for="exampleFormControlSelect1">Cliente</label>
        <select class="form-control" name="cliente_id">
            @foreach($clientes as $cliente)
            <option value="{{$cliente->id}}" name="cliente_id" {{ ( $cliente->id == $pedido->cliente->id) ? 'selected' : '' }}>{{$cliente->nome_cliente}}</option>
            @endforeach
        </select>
    </div>

    <label for="exampleFormControlSelect1">Itens</label>

    <div class="stuffs_to_clone">
        <div class="stuff">
            <select class="form-control" name="produtos[]">
                @foreach($produtos as $produto)
                <option value="{{$produto->id}}">{{$produto->nome_produto}} - R$ {{number_format($produto->valor_unitario,2)}}</option>
                @endforeach
            </select>
            <br>
            <div class="del disabled hidden"></div>
        </div>
        <div class="clone btn btn-dark" title="Create new item">Adicionar Mais Itens</div>
    </div>

    <script>
        $(document).ready(function() {

            $(".clone").click(function() {
                var
                    $self = $(this),
                    $element_to_clone = $self.prev(),
                    $wrapper_parent_element = $self.parent(),
                    $new_element = $element_to_clone.clone();

                $new_element.find('.del').removeClass('hidden disabled').addClass('enabled');

                $new_element.insertAfter($element_to_clone);

                return false;
            });

            $("body").on("click", ".del.enabled", function(event) {
                var $parent = $(this).parent();
                $parent.remove();
                return false;
            });
        });
    </script>

    <button type="submit" class="btn btn-primary">Atualizar Pedido</button>
</form>

@endsection