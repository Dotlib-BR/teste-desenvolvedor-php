$(() => {
    const $price = $('.order__total--price');

    $price.map((index, element) => {
        let value = $(element).text();
        $(element).text(formatNumber(value, { style: 'currency', currency: 'BRL' }, 'pt-BR'))
    });
});