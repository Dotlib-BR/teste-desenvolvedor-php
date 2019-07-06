//Mensagens de validações globais
jQuery.extend(jQuery.validator.messages, {
    required: "Campo obrigatório.",
    email: "Este Email é inválido.",
    date: "Data inválida.",
    number: "Não é um Número.",
    digits: "Apenas digitos.",
    equalTo: "Valores estão diferentes",
    accept: "Extensão do arquivo é inválida.",
    maxlength: jQuery.validator.format("No máximo {0} caracteres."),
    minlength: jQuery.validator.format("No minímo {0} caracteres."),
    rangelength: jQuery.validator.format("Valor deve está entre {0} e {1} caracteres."),
    range: jQuery.validator.format("Valor deve está entre {0} e {1}."),
    max: jQuery.validator.format("Valor deve ser menor que ou igual a {0}."),
    min: jQuery.validator.format("Valor deve ser maior que ou igual a {0}.")
});
//Fim de mensagens de validações globais

//Novo método validador para cpf customizado
jQuery.validator.addMethod('cpf', function(value, element) {
    value = jQuery.trim(value);
    value = value.replace('.','');
    value = value.replace('.','');

    let cpf = value.replace('-', '');

    while (cpf.length < 11) {
        cpf = "0" + cpf;
    }

    let expReg = /^0+$|^1+$|^2+$|^3+$|^4+$|^5+$|^6+$|^7+$|^8+$|^9+$/;
    let a = [];
    let b = new Number;
    let c = 11;

    for (i = 0; i < 11; i++) {
        a[i] = cpf.charAt(i);

        if (i < 9) {
            b += (a[i] * --c);
        }
    }
    if ((x = b % 11) < 2) {
        a[9] = 0;
    } else {
        a[9] = 11 - x;
    }

    b = 0;
    c = 11;

    for (y = 0; y < 10; y++) {
        b += (a[y] * c--);
    }

    if ((x = b % 11) < 2) {
        a[10] = 0;
    } else {
        a[10] = 11 - x;
    }

    let response = true;

    if ((cpf.charAt(9) != a[9]) ||
        (cpf.charAt(10) != a[10]) ||
        cpf.match(expReg)) {

        response = false
    }

    return this.optional(element) || response;

}, "Informe um CPF válido");
