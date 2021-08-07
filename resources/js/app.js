require('./bootstrap');
require('../../node_modules/jquery');
require('../../node_modules/jquery-mask-plugin');
require('./datatable.min');

    $(document).ready(function(){
    $(".cpf").mask("999.999.999-99");
    $(".cb").mask("99999999999999999999");
    $(".table").dataTable();

});

