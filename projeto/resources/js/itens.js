$().ready(function(){
    //Remover item do carrinho
    $('.removeItens').click(function(e){
        e.preventDefault();               
        var pedido = $(this).attr("data-pedido");
        var produto = $(this).attr("data-produto");
        var item = $(this).attr('data-item');
        $('#removeItens input[name="pedido"]').val(pedido); 
        $('#removeItens input[name="produto"]').val(produto);
        $('#removeItens input[name="item"]').val(item);
        $('#removeItens').submit();
    });

    //Adicionar item do carrimho
    $('.addItens').click(function(e){
        e.preventDefault();               
        var pedido = $(this).attr("data-pedido");
        var produto = $(this).attr("data-produto");
        var item = $(this).attr('data-item');
        $('#addItens input[name="pedido_id"]').val(pedido); 
        $('#addItens input[name="produto_id"]').val(produto);        
        $('#addItens').submit();
    });

    $('.pagamento').click(function(e){
        e.preventDefault();        
        $('#atualizaPedido input[name="status"]').val('3');
        $('#atualizaPedido').submit();
    });

    $('.cancelar').click(function(e){
        e.preventDefault();       
        $('#atualizaPedido input[name="status"]').val('4');
        $('#atualizaPedido').submit();
    });
});