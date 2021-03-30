$(() => {
    const url = window.location.origin;
    const $singleOrder = $('.order__product--container.single');


    if ($singleOrder) {
        let id = $singleOrder.data('product-id');

        // 
        const $itens = $('.row.order__product--item'); 

        $itens.map((index, element) => {
            const $currentItem = $(element).children('.order__product--info').children('.order__product--price');
            let text = $currentItem.text();
            $currentItem.text(formatNumber(text, { style: 'currency', currency: 'BRL' }, 'pt-BR'));
        });

        const $total = $('.order__product--total span');
        $total.text(formatNumber($total.text(), { style: 'currency', currency: 'BRL' }, 'pt-BR'));
        $('.pay__order').on('click', () => {
            $.ajax({
                url: url + '/orders/' + id,
                method: 'PUT',
                headers: {
                    'X-CSRF-Token': $('input[name="_token"]').val()
                },
                data: {
                    status: "1",
                    type: 'status'
                },
            }).done(function (resp) {
                if (resp.error === 0) {
                    window.location.replace(window.location.href);
                } else {
                    console.log('error');
                }
            }).fail(function () {
                console.log('error');
            });
        });

        $('.cancel__order').on('click', () => {
            $.ajax({
                url: url + '/orders/' + id,
                method: 'PUT',
                headers: {
                    'X-CSRF-Token': $('input[name="_token"]').val()
                },
                data: {
                    status: "2",
                    type: 'status'
                },
            }).done(function (resp) {
                if (resp.error === 0) {
                    window.location.replace(window.location.href);
                } else {
                    console.log('error');
                }
            }).fail(function () {
                console.log('error');
            });
        });
    }

});