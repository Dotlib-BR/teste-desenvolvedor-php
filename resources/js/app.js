
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

$(function () {
    // Modal delete confirm
    $('#modalDestroyConfirm').on('show.bs.modal', function (e) {
        let modal = $(this);
        let button = $(e.relatedTarget);
        let action = button.data('action');
        
        modal.find('form')
            .prop('action', action);
    });

    // Add product in order
    $('.add-product').on('click', function () {
        let button = $(this);
        let product_id = button.data('id');
        let quantity = button.parents('.product-line').find('input[name="qtd"]').val();
        let data = {
            'product_id': product_id,
            'quantity': quantity,
        }

        if (quantity != '' && quantity > 0) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/orders/add-to-cart',
                method: 'GET',
                data: data,
                dataType: 'json',
                success: function (data) {
                    if (data.status == true) {
                        attProductList(data.cart);

                        if ($('#products-table').hasClass('d-none')) {
                            $('#products-table').removeClass('d-none');
                            $('#cart-alert').addClass('d-none');
                        }
                    }
                }
            })
        }
    });

    // Add product in order
    $('body').on('click', '.remove-product', function () {
        let button = $(this);
        let product_id = button.data('id');
        let data = {
            'product_id': product_id,
        };

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/orders/remove-from-cart',
            method: 'GET',
            data: data,
            dataType: 'json',
            success: function (data) {
                if (data.status == true) {
                    attProductList(data.cart);

                    if (data.cart == null) {
                        $('#products-table').addClass('d-none');
                        $('#cart-alert').removeClass('d-none');
                    }
                }
            }
        })
    });

    function attProductList(cart) {
        let lines = '';

        if (cart) {
            $(cart.items).each(function (index, el) {
                lines += "<tr>"
                    + "<td>" + el.name + "</td>"
                    + "<td>R$ " + el.price_full + "</td>"
                    + "<td>" + el.quantity + "</td>"
                    + "<td class='text-center text-md-right'>"
                    + "<button class='btn btn-danger remove-product' type='button' data-id="+ el.product_id + "'><b>-</b></button>"
                    + "</td>"
                    + "</tr>";
            });
    
            lines += "<tr>"
                + "<td colspan='4' class='text-right'><b>Total: R$ " + cart.total + "</b></th>"
                + "</tr>";
        }

        $('.products-added').html(lines);
    }

    // Bulk Actions
    $('#bulk-option').on('change', function () {
        let value = $(this).val();
        let bulkCheckAll = $('#bulk-check-all');
        
        if (value) {
            bulkCheckAll.parent()
                .removeClass('d-none');
                
            $('.bulk-check').parent()
                .removeClass('d-none');
        } else {
            bulkCheckAll
                .prop('checked', '')
                .parent()
                .addClass('d-none');

            $('.bulk-check')
                .prop('checked', '')
                .parent()
                .addClass('d-none');
        }
    });

    $('#bulk-check-all').on('change', function () {
        let checked = this.checked;
        
        if (checked) {
            $('.bulk-check').prop('checked', 'checked');
        } else {
            $('.bulk-check').prop('checked', '');
        }
    });

    $('#bulk-action').on('click', function () {
        let checks = {};
        let tempChecks = [];
        let bulkOption = $('#bulk-option');
        
        if (bulkOption.val()) {
            $('.bulk-check').each(function (i, e) {
                if (e.checked) {
                    tempChecks.push($(e).val());
                }
            });
    
            checks.bulk = tempChecks;
    
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: bulkOption.find(':selected').data('action'),
                method: 'POST',
                data: checks,
                dataType: 'json',
                success: function (data) {
                    if (data.status == true) {
                        removeListItem(checks.bulk)
                    }
                }
            })
        }
    });

    function removeListItem(items) {
        $('.bulk-check').each(function (i, e) {
            if ($.inArray($(e).val(), items) != -1) {
                $(e).parents('tr').fadeOut(function () {
                    $(this).remove();
                });
            }
        });
    }

    // Paginate
    $('#paged').on('change', function () {
        $(this).parents('form')
            .submit();
    });
});