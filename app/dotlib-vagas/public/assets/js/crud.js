
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








