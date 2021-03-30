const cpf = document.querySelector('#cpf');

if(cpf) {
    cpf.addEventListener('input', function(e){
    
        let value = this.value;
    
        if(isNaN(value[value.length -1])) {
            this.value = value.substring(0, value.length - 1)
            return;
        }
    
        if(value.length === 3 || value.length === 7) this.value += ".";
        if (value.length == 11) this.value += "-";
    });
}