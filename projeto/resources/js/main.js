$(document).ready(function(){
   
    $('.deletar').click(function(e){  
        e.preventDefault();           
        var id = $(this).attr('data-deletar');
        $('#form-deletar input[name="id"]').val(id); 
        ok = confirm("Deseja realmente excluir?")
        if (ok == true){                      
            $('#form-deletar').submit();
        }       
    }); 

    //SELECIONAR TODAS AS LINHAS DA TABELA 
    $('.all').click(function(){        
        $(".form-check-input").prop('checked', $(this).prop('checked'));
    });

    //EXCLUSÃO EM MASSA
    $('.deletarAll').click(function(){          
        var id = $(this).attr('id');
        ok = confirm("Deseja excluir os todos selecionados");
        if (ok == true){
            var aDados = [];             
            $("input[name='delete[]']:checked").each(function (){
                aDados.push($(this).val());
            });
            $('#form-deletar input[name="id"]').val(aDados);   
            $('#form-deletar').submit();                     
        }        
    });
    
    $("#qnt").blur(function(){
        var quantidade = Number($(this).val());
        var valor = Number($('#valUnt').val());
        var subTotal = quantidade * valor;
        $('#subtotal').val(parseFloat(subTotal.toFixed(2)));
    });
});