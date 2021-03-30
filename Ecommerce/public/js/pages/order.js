$(() => {
    const $orderQuantityInput = $('.product__quantity');
    const $finishOrder = $('.order__product--container.finish__order');
    const url = window.location.origin;
    
    const destroy = (item) => {
        const $subTotal = $('.order__product--subtotal span');
        const $subTotalDiscount = $('.order__product--subtotal-discount span');
        const $total = $('.order__product--total span');
        const $input = item.children('.col-md-4').children('.order__product--quantity').children('.product__quantity');
        let quantity = $input.val();

        let $prices = item.children('.order__product--info').children('.order__product--price');

        let $oldPrice = $prices.children('.order__product--old-price');
        let $discount = $prices.children('.order__product--discount');

        let oldPrice = parseFloat($oldPrice.text().split('R$')[1].replace('.', '').replace(',', '.'));

        let discount = 0;

        if ($discount.text()) {
            discount = parseFloat($discount.text().split('R$')[1].replace('.', '').replace(',', '.'))
            discount = (oldPrice - discount) * quantity;
        }


        let subTotal = parseFloat($subTotal.text().split('R$')[1].replace('.', '').replace(',', '.'));
        let subTotalDiscount = parseFloat($subTotalDiscount.text().split('R$')[1].replace('.', '').replace(',', '.'));
        let total = parseFloat($total.text().split('R$')[1].replace('.', '').replace(',', '.'));


        subTotal -= (oldPrice * quantity);
        subTotalDiscount = subTotalDiscount - discount;
        total -= (oldPrice * quantity) - discount;

        $subTotal.text(formatNumber(subTotal, { style: 'currency', currency: 'BRL' }, 'pt-BR'));
        $subTotalDiscount.text(formatNumber(subTotalDiscount, { style: 'currency', currency: 'BRL' }, 'pt-BR'));
        $total.text(formatNumber(total, { style: 'currency', currency: 'BRL' }, 'pt-BR'));
        return;
    }

    const disableWhenThereIsNoProduct = () => {
        if ($('.order__product--item').length === 0) {
            $('.order__finish').prop("disabled", true);
            $('.order__cancel').prop("disabled", true);

            window.location.replace(url + '/orders/clear');
        }
    }

    const changePrice = (current, type) => {
        const $subTotal = $('.order__product--subtotal span');
        const $subTotalDiscount = $('.order__product--subtotal-discount span');
        const $total = $('.order__product--total span');


        let subTotal = parseFloat($subTotal.text().split('R$')[1].replace('.', '').replace(',', '.'));
        let subTotalDiscount = parseFloat($subTotalDiscount.text().split('R$')[1].replace('.', '').replace(',', '.'));
        let total = parseFloat($total.text().split('R$')[1].replace('.', '').replace(',', '.'));

        const $price = current.parents('.col-md-4').siblings('.order__product--info').children('.order__product--price');

        let oldPrice = parseFloat($price.children('.order__product--old-price').text().split('R$')[1].replace('.', '').replace(',', '.'));
        let $discountCheck = $price.children('.order__product--discount').text();

        let discount = 0;
        if ($discountCheck) {
            discount = parseFloat($discountCheck.split('R$')[1].replace('.', '').replace(',', '.'));
        }

        if (type === 'add') {
            subTotalDiscount += (discount > 0) ? (oldPrice - discount) : 0;
            subTotal += oldPrice;
            total += (oldPrice - discount);

            $subTotal.text(formatNumber(subTotal, { style: 'currency', currency: 'BRL' }, 'pt-BR'));
            $subTotalDiscount.text(formatNumber(subTotalDiscount, { style: 'currency', currency: 'BRL' }, 'pt-BR'));
            $total.text(formatNumber(total, { style: 'currency', currency: 'BRL' }, 'pt-BR'));

            return;
        }

        subTotalDiscount -= (discount > 0) ? (oldPrice - discount) : 0;
        subTotal -= oldPrice;
        total -= (oldPrice - discount);

        $subTotal.text(formatNumber(subTotal, { style: 'currency', currency: 'BRL' }, 'pt-BR'));
        $subTotalDiscount.text(formatNumber(subTotalDiscount, { style: 'currency', currency: 'BRL' }, 'pt-BR'));
        $total.text(formatNumber(total, { style: 'currency', currency: 'BRL' }, 'pt-BR'));
        return;
    }

    if ($finishOrder) {

        const $add = $('.order__product--add');
        const $remove = $('.order__product--remove');
        const $destroy = $('.order__product--destroy');

        const $subTotal = $('.order__product--subtotal span');
        const $subTotalDiscount = $('.order__product--subtotal-discount span');
        const $total = $('.order__product--total span');

        $('.order__product--item').map((index, element) => {
            const $currentItemPrice = $(element).children('.order__product--info').children('.order__product--price');
            let $oldPriceCheck = $currentItemPrice.children('.order__product--old-price');
            let $discountCheck = $currentItemPrice.children('.order__product--discount');
            let oldPrice = parseFloat($oldPriceCheck.text());
            let discount = 0;

            if ($discountCheck) {
                discount = parseFloat($discountCheck.text());
                $discountCheck.text(formatNumber(discount, { style: 'currency', currency: 'BRL' }, 'pt-BR'));
            }

            $oldPriceCheck.text(formatNumber(oldPrice, { style: 'currency', currency: 'BRL' }, 'pt-BR'))

        });

        let subTotal = parseFloat($subTotal.text().split('R$')[1]);
        let subTotalDiscount = parseFloat($subTotalDiscount.text().split('R$')[1]);
        let total = parseFloat($total.text().split('R$')[1]);

        $subTotal.text(formatNumber(subTotal, { style: 'currency', currency: 'BRL' }, 'pt-BR'))
        $subTotalDiscount.text(formatNumber(subTotalDiscount, { style: 'currency', currency: 'BRL' }, 'pt-BR'))
        $total.text(formatNumber(total, { style: 'currency', currency: 'BRL' }, 'pt-BR'))

        $orderQuantityInput.on('input', function () {
            let value = $(this).val();

            if (isNaN(value[value.length - 1])) {
                $(this).val(value.substring(0, value.length - 1));
                return;
            }
        });


        $add.on('click', function () {
            let $input = $(this).siblings('.product__quantity');
            $input.val(parseInt($input.val()) + 1);
            changePrice($(this), 'add');
        });

        $remove.on('click', function () {
            let $input = $(this).siblings('.product__quantity');
            let $container = $(this).parents('.order__product--item');

            $input.val(parseInt($input.val()) - 1);

            if (parseInt($input.val()) < 0) {
                console.log('alo');
                $container.remove();
                disableWhenThereIsNoProduct();
                return;
            }
            changePrice($(this), 'remove');
        });

        $destroy.on('click', function () {
            destroy($(this).parent('.row.order__product--item'));
            $(this).parent('.order__product--item').remove();
            disableWhenThereIsNoProduct();
        });


        $('.order__finish').on('click', () => {
            const $items = $('.order__product--item');

            let products = {};
            let type = []
            let count = 0;
            $items.map((index, element) => {
                const $currentItem = $(element);
                let final = {};

                let quantity = $currentItem.children('.col-md-4').children('.order__product--quantity').children('input').val();
                let id = $currentItem.data('product-id');

                final.id = id;
                final.quantity = quantity;
                products[count] = final;

                count++;
            });

            $.ajax({
                url: url + '/orders',
                method: 'POST',
                headers: {
                    'X-CSRF-Token': $('input[name="_token"]').val()
                },
                data: {
                    items: products
                },
            }).done(function (resp) {
                if (resp.order.id) {
                    window.location.replace(url + '/orders/' + resp.order.id);
                } else {
                    console.log('error');
                }
            }).fail(function () {
                console.log('error');
            });
        });

        $('.order__cancel').on('click', () => {
            window.location.replace(url + '/orders/clear');
        });
    }

});