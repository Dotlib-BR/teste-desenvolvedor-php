require('./bootstrap');
require('../../node_modules/jquery');
require('../../node_modules/jquery-mask-plugin');

    $(document).ready(function(){
    $(".cpf").mask("999.999.999-99");
});
