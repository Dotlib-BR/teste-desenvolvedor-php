const cpf = document.querySelector('#cpf');

const formatNumber = (number, style, locale) => {
    number = new Intl.NumberFormat(locale, style).format(number);
    return number;
}


if (cpf) {
    cpf.addEventListener('input', function (e) {

        let value = this.value;

        if (isNaN(value[value.length - 1])) {
            this.value = value.substring(0, value.length - 1)
            return;
        }

        if (value.length === 3 || value.length === 7) this.value += ".";
        if (value.length == 11) this.value += "-";
    });
}

const cpfConfigMask = document.querySelector('.cpf');

if (cpfConfigMask) {

    let value = cpfConfigMask.value;

    value = value.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, "$1.$2.$3-$4")
    
    cpfConfigMask.value = value;
}