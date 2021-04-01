$(() => {

    const $massDeletionProduct = $('.mass__deletion--product');
    const $deleteAllProduct = $('.delete__all--product');
    const $icon = $('.product__delete');

    if($massDeletionProduct && $deleteAllProduct){

        $icon.map((index, element) => {

            $(element).on('click', () => {
                $('.delete__products--btn').removeClass('hidden');
                $(element).toggleClass('selected');
                const $checkBox = $(element).siblings('.mass__deletion--product');
                if($checkBox.prop('checked')){
                    $checkBox.prop('checked', false);
                } else {
                    $checkBox.prop('checked', true);
                }
            });
        })

        $deleteAllProduct.on('click', () => {
            let ids = [];
            $massDeletionProduct.map((index, element) => {
                if($(element).prop('checked')){
                    ids.push(parseInt($(element).val()));
                    
                }
            });

            if(ids.length > 0){
                $.ajax({
                    url: window.location.origin + '/admin/products',
                    async: true,
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    data: {
                        id: ids
                    }
                }).done((resp) => {
                    if(resp.error === 0) {
                        document.location.reload(true);
                    } else {
                        console.log('não deletou')
                    }
                }).fail((resp) => {
                    console.log('deu erro na requisição ');
                    console.log(resp);
                });
            }
            
        });

    }

});