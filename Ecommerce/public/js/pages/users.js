$(() => {

    const $deleteAllUsers = $('.delete__all');
    const $massDeletionUser = $('.mass__deletion--users');

    $deleteAllUsers.on('click', () => {
        console.log('click');
        let ids = [];
        $massDeletionUser.map((index, element) => {
            if($(element).prop('checked')){
                ids.push(parseInt($(element).val()));
                
            }
        });

        if(ids.length > 0){
            $.ajax({
                url: window.location.origin + '/admin/users',
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
})