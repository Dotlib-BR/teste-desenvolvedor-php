require('./bootstrap');

const swal = window.swal = require('sweetalert2');
const toast = window.toast = swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 2500
});

window.DataTable = function(target = [], order = 0) {
    var table = $('#data-table');

    table.DataTable({
        columnDefs: [{
            orderable: false,
            targets: target
        }],
        order: [[
            order,
            'asc'
        ]],
        pagingType: 'first_last_numbers',
        lengthMenu: [
            [5, 10, 20, 50, 100, 250, 500, -1],
            [5, 10, 20, 50, 100, 250, 500, 'Todos']
        ],
        pageLength: 20,
        language: {
            processing:         'Processando...',
            search:             'Pesquisar por:',
            lengthMenu:         'Mostrar _MENU_ registros',
            info:               'Mostrando de _START_ até _END_ de _TOTAL_ registros',
            infoEmpty:          'Mostrando 0 até 0 de 0 registros',
            infoFiltered:       '(Filtrados de _MAX_ registros)',
            infoPostFix:        '',
            loadingRecords:     'Carregando...',
            zeroRecords:        'Nenhum registro encontrado.',
            emptyTable:         'Nenhum registro para mostrar.',
            paginate: {
                previous:       'Anterior',
                next:           'Próximo',
                first:          'Primeiro',
                last:           'Último'
            },
            aria: {
                sortAscending:  ': Ordenar colunas de forma ascendente',
                sortDescending: ': Ordenar colunas de forma descendente'
            }
        }
    });

    // fixes
    table.parent()
         .addClass('table-responsive');


}
