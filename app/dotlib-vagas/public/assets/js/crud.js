
var swalWithBootstrapButtons = null

$(document).ready(function(e) {

    swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
    })

    $('#cpf').mask('000.000.000-00', {
        onKeyPress : function(cpfcnpj, e, field, options) {
            const mask = ['000.000.000-00'];
            $('#cpf').mask(mask, options);
        }
    });

    $('#numero').mask('0000000000', {
        onKeyPress : function(cpfcnpj, e, field, options) {
            const mask = ['0000000000'];
            $('#numero').mask(mask, options);
        }
    });

    $('#valor').mask('#.##0,00', {reverse: true});

    $('#nome').keyup(function(e) {
        let value = $('#nome').val()
        let text = upperCase(value);

        if(/[0-9]/g.test(value)){
            var tamanho = value.length
            text = value.substring(0, tamanho -1)
        }

        $('#nome').val(text)
    })

    $('#pessoa_id_movimentacao').change(function(e) {
        getContasPessoa()
    })

    $('#conta_id').change(function(e) {
        getMovimentacaoPorConta()
    })


})

function upperCase(value){
    const text = value.split(" ");

    var result = text.map((palavra) => {
        return palavra[0].toUpperCase() + palavra.substring(1);
    }).join(" ");

    return result
}


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
            .catch(function (error) {
                swalWithBootstrapButtons.fire(
                    'Não é possivel excluir uma pessoa que já possui  uma conta',
                    '',
                    'error'
                )
            });

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

function getContasPessoa() {

    let id = $('#pessoa_id_movimentacao').val();

    axios({
        method: 'get',
        url: `conta/pessoa/${id}`,
    })
        .then(function (response) {

            console.log(response.data)
            let data = response.data
            if(data){
                setSelectConta(data.data)
            }else{
                swalWithBootstrapButtons.fire(
                    'Não existe conta para esta pessao.',
                    '',
                    'error'
                )
            }

        })
        .catch(function (error) {
            console.log(error)
            swalWithBootstrapButtons.fire(
                'Error ao carregar a  conta',
                '',
                'error'
            )
        });
}

function setSelectConta(data){
    removeOptionSelect('conta_id');

    let select = document.getElementById("conta_id");

    data.forEach((item) => {
        option = new Option(`${item.numero} - Saldo: ${formatarMoeda(item.saldo,2,true)}` ,item.id);
        select.options[select.options.length] = option;
    });
}

function removeOptionSelect(idSelect){
    $(`#${idSelect}`).find('option').remove().end()
        .append(' <option value="" disabled="" selected="">Selecione</option>');
}

function saveMovimentacao() {

    let pessoaId = $('#pessoa_id_movimentacao').val()
    let contaId = $('#conta_id').val()
    let movimentacao = $('#movimentacao').val();
    let valor = $('#valor').val();

    if(!pessoaId){
        swalWithBootstrapButtons.fire(
            'Por favor selecione uma pessoa.',
            '',
            'warning'
        )
        return
    }

    if(!contaId){
        swalWithBootstrapButtons.fire(
            'Por favor selecione uma conta.',
            '',
            'warning'
        )
        return
    }

    if(!valor){
        swalWithBootstrapButtons.fire(
            'Nenhum valor informado.',
            '',
            'warning'
        )
        return
    }

    if(!movimentacao){
        swalWithBootstrapButtons.fire(
            'Por favor selecione a forma de movimentação.',
            '',
            'warning'
        )
        return
    }


    var formData = new FormData();
    formData.set('conta_id', contaId);
    formData.set('valor', formatFloatBd(valor));
    formData.set('movimentacao', movimentacao);

    let token = document.getElementsByName("_token")[0].value;

    axios({
        method: 'post',
        url: `movimentacao`,
        data: formData,
        headers: {'Content-Type': 'multipart/form-data', 'X-CSRF-TOKEN': token }
    })
        .then(function (response) {
            let data = response.data
            if(data){
                limparFormMovimentacao();
                setExtrato(data.data);
            }

        })
        .catch(function (error) {
            swalWithBootstrapButtons.fire(
                'Não foi possível realizar a movimentação, por favor verifique se todos os dados estão preenchidos.',
                '',
                'error'
            )
        });
}


function getMovimentacaoPorConta() {

    let id = $('#conta_id').val()

    axios({
        method: 'get',
        url: `movimentacao/conta/${id}`,
    }).then(function (response) {
            let data = response.data
            if(data){
                setExtrato(data.data)
            }

        })
        .catch(function (error) {
            console.log(error)
            swalWithBootstrapButtons.fire(
                'Não foi possível carregar o extrato.',
                '',
                'error'
            )
        });
}

function setExtrato(data){
    let htmlTable = ''
    let movimentacao = data.movimentacao
    let saldoConta = data.saldo

    $('#tbody-extrato tr').remove();
    $('.saldo h5').remove();

    movimentacao.forEach((item) => {
        let statusClass = parseFloat(item.valor) < 0 ? 'text-danger' : ''
        htmlTable += `<tr><td scope="row">${item.data}</td> <td ><label class="${statusClass}">${formatarMoeda(item.valor,2,true)}</label></td>`;
    });

   $('#tbody-extrato').append(htmlTable);

   let statusSaldo = parseFloat(saldoConta) < 0 ? 'text-danger' : ''
   $('.saldo').append(`<h5 >Saldo: <label class="${statusSaldo}">${formatarMoeda(saldoConta,2,true)}</label></h5>`);

}

function limparFormMovimentacao(){
   $('#pessoa_id_movimentacao').val('')
   $('#conta_id').val('')
   $('#movimentacao').val('');
   $('#valor').val('');
}







