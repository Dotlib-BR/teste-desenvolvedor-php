function formatFloatBd(valor){
    return valor.replace("R$", "")
        .replace(".", "")
        .replace(",", ".")
        .trim();
}

function formatarMoeda(
    valor,
    decimais,
    exibirSimbolo
) {
    if(!valor){
        return ''
    }

    let valorNegativo = false

    valor = valor.replace(/[^\d|\-+]/g, '')
    if (Number(valor) < 0) {
        valorNegativo = true
    }
    valor = valor.replace(/[\D]+/g, '')

    if (valor.length > decimais) {
        const regex = new RegExp(`([0-9]{${decimais}})$`, 'g')
        valor = valor.replace(regex, ',$1')
    }

    if (valor.length > 4 + decimais) {
        const regex = new RegExp(`([0-9]{3}),([0-9]{${decimais}}$)`, 'g')
        valor = valor.replace(regex, '.$1,$2')
    }

    if (valor.length > 8 + decimais) {
        const regex = new RegExp(
            `([0-9]{3}).([0-9]{3}),([0-9]{${decimais}}$)`,
            'g'
        )
        valor = valor.replace(regex, '.$1.$2,$3')
    }

    if (valor.length > 12 + decimais) {
        const regex = new RegExp(
            `([0-9]{3}).([0-9]{3}).([0-9]{3}),([0-9]{${decimais}}$)`,
            'g'
        )
        valor = valor.replace(regex, '.$1.$2.$3,$4')
    }

    if (valor.length > 16 + decimais) {
        const regex = new RegExp(
            `([0-9]{3}).([0-9]{3}).([0-9]{3}).([0-9]{3}),([0-9]{${decimais}}$)`,
            'g'
        )
        valor = valor.replace(regex, '.$1.$2.$3.$4,$5')
    }

    if (valorNegativo) {
        return exibirSimbolo ? 'R$ -' + valor : '-' + valor
    }
    return exibirSimbolo ? 'R$ ' + valor : valor
}

