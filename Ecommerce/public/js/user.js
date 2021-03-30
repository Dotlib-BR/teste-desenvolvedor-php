$(function () {
    const $products = $('.product__bascket');
    const url = window.location.origin;

    // /pedidos
    if ($products) {
        $products.on('click', function () {
            const productId = $(this).data('product-id');
            $.ajax({
                url: url + '/orders/cart',
                method: 'POST',
                data: {
                    id: productId
                },
                headers: {
                    'X-CSRF-Token': $('input[name="_token"]').val()
                }
            })
                .done(function (resp) {
                    $('.finish__link').removeClass('hidden');
                }).fail(function (resp) {
                    console.log('falhou');
                    console.log(resp);
                });
        });
    }

});