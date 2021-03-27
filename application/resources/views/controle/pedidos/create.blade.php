@extends('layouts.controle')

@section('content')
<div class="card">
    <div class="card-header">
      Pedidos / {{ (isset($pedido->id)) ? 'Editar' : 'Cadastrar' }}
    </div>
    <div class="card-body">
        @if(isset($pedido->id))
            {!! Form::model($pedido ?? null, ['route' => ['controle.pedidos.update', $pedido->id]]) !!}
            @method('put')
        @else
            @method('post')
            {!! Form::model($pedido ?? null, ['route' => 'controle.pedidos.store']) !!}
        @endif
            <div class="form-group">
              <label for="cliente_id">Cliente</label>
              {!! Form::select('cliente_id', ['' => 'Selecione'] + $clientes, null, ['class' => 'form-control select2', 'required']) !!}
            </div>
            <div class="form-group">
                <label for="produto">Produto</label>
                <div class="input-group">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        Adicionar produto
                    </button>
                </div>
            </div>
            <div class="form-group">
                <h3>Lista de produtos</h3>
                <ul class="list-group" id="lista-produtos">
                    <!-- <li class="list-group-item">
                        Cras justo odio <button class="btn btn-danger btn-sm float-right">Excluir</button>
                    </li> -->
                </ul>
            </div>
            <div class="form-group">
              <label for="cupom_desconto_id">Cupom de desconto</label>
              {!! Form::select('cupom_desconto_id', ['' => 'Selecione'] + $cupoms, null, ['class' => 'form-control']) !!}
            </div>
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href="{{ route('controle.pedidos.index') }}" class="btn btn-default float-right">Calcelar</a>
        {!! Form::close() !!}
    </div>
  </div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <label for="">Produto</label>
            {!! Form::select('produto', ['' => 'Selecione o produto'] + $produtos, null, ['class' => 'form-control select2', 'required', 'style' => 'width:100%']) !!}
        </div>
        <div class="form-group">
            <label for="">Quantidade</label>
            {!! Form::number('quantidade', 1, ['class' => 'form-control', 'min' => 1]) !!}
        </div>
        <div class="input-group-append">
            <button class="btn btn-primary adicionar" type="button">ADICIONAR</button>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>


@endsection

@section('scripts')
<script>
$(document).ready(function() {
    $('.adicionar').click(function() {
        var produto = $('select[name="produto"] option:selected');
        var quantidade = $('[name="quantidade"]').val();
        var verificaProduto = $('li[data-produto-id="'+produto.val()+'"]');

        if (!produto.val()) return;

        if (verificaProduto.length == 0) {
            let linha = '<li class="list-group-item" data-produto-id="' + produto.val() + '">\
                            <span class="badge badge-primary">' + quantidade + '</span>\
                            ' + produto.text() + ' <button type="button" class="btn btn-danger btn-sm float-right excluir" data-produto_id="' + produto.val() + '">Excluir</button>\
                            <input type="hidden" name="quantidade[' + produto.val() + ']" value="' + quantidade + '"/>\
                            <input type="hidden" name="produto_id[' + produto.val() + ']" value="' + produto.val() + '"/>\
                        </li>';
            $('#lista-produtos').append(linha)
        } else {
            let pro = verificaProduto.find('[type="hidden"]').val()
            let qtd = parseInt(pro) + parseInt(quantidade);
            verificaProduto.find('.badge').text(qtd);
            verificaProduto.find('[type="hidden"]').val(qtd)
        }
        $("#exampleModal").modal('hide')

    })
    $('#lista-produtos').delegate('.excluir', 'click', function() {
        $(this).parents('.list-group-item').remove()
    })
})
</script>
@endsection
