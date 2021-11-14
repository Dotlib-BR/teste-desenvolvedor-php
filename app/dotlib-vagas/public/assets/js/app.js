
var swalWithBootstrapButtons = null

$(document).ready(function(e) {
    swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
    })

    $('#salario').mask('#.##0,00', {reverse: true});

    var maskBehavior = function (val) {
            return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
        },
        spOptions = {
            onKeyPress: function(val, e, field, options) {
                field.mask(maskBehavior.apply({}, arguments), options);
            }
        };

    $('#telefone').mask(maskBehavior, spOptions);
})

function deleteRegistro(url) {

    swalWithBootstrapButtons.fire({
        title: 'Deseja realmente deletar este registro?',
        text: "Essa ação não poderá ser revertida!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sim, delete!',
        cancelButtonText: 'Não, cancele!',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            let token = document.getElementsByName("_token")[0].value;

            axios({
                method: 'delete',
                url: url,
                headers: {'X-CSRF-TOKEN': token}
            })
            .then(function (response) {
                swalWithBootstrapButtons.fire(
                    'Excluído!',
                    '',
                    'success'
                ).then((result) => {
                    if (result.isConfirmed) {
                        location.reload();
                    }
                })
            })
            .catch(function (error) {});

        } else if (
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire(
                'Cancelado',
                '',
                'error'
            )
        }
    })
}

function alterarRegistro(url) {

    let token = document.getElementsByName("_token")[0].value;

    axios({
        method: 'get',
        url: url,
        headers: {'X-CSRF-TOKEN': token}
    })
    .then(function (response) {
        swalWithBootstrapButtons.fire(
            'Alteração realizada!',
            '',
            'success'
        ).then((result) => {
            if (result.isConfirmed) {
                location.reload();
            }
        })
    })
    .catch(function (error) {
        console.log(error)
        swalWithBootstrapButtons.fire(
            'Não foi possível alterar o registro',
            '',
            'error'
        )
    });
}








