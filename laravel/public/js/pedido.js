var search = null;
var storagePedido = [];
var ordem = ["id", "desc"];
var statusOp = [
  {"valor":"aberto","opcao":"Em Aberto"},
  {"valor":"pago","opcao":"Pago"},
  {"valor":"cancelado","opcao":"Cancelado"},
];

function total(pedido_detalhe) {
  let total = 0;
  $.each(pedido_detalhe, function(index, row) {
    if (row.desconto > 0) {
      total += (row.produto.valor * row.quantidade);
    } else {
      total += row.produto.valor * row.quantidade;
    }
  });

  return total;
}
function ordenar(field) {
  let order;
  if (ordem[0] == field) {
    order = ordem[1] == "asc" ? "desc" : "asc";
  } else {
    order = "asc";
  }
  ordem = [field, order];
  getPedidos(BASE_URL + "/api/pedidos");
}

function getPedidos(page = null) {
  $.ajax({
    url: page ? page : BASE_URL + "/api/pedidos",
    type: "GET",
    dataType: "json",
    data: {
      search: search,
      ordem: ordem
    },
    success: function(data) {
      storagePedido = data.data;
      let htmlTabela = [];
      let htmlPaginacao;

      htmlTabela.push(`
      <thead>
      <th onClick="ordenar('id')">ID</th>
      <th onClick="ordenar('status')">Status</th>
      <th >Cliente</th>
      <th >E-mail</th>
      <th>Valor</th>
      <th onClick="ordenar('created_at')">Data Registro</th>
      <th onClick="ordenar('updated_at')">Data Atualização</th>
      <th colspan="2">Ação</th>
      <tbody>
  </thead>
      `);
      $.each(data.data, function(index, row) {
        htmlTabela.push(`
                      <tr>
                          <td>${row.id}</td>
                          <td>${row.status}</td>
                          <td>${row.cliente.nome}</td>
                          <td>${row.cliente.email}</td>
                          <td>${total(row.pedido_detalhe)}</td>
                          <td>${row.created_at}</td>
                          <td>${row.updated_at}</td>
                          <td>
                            <a class="btn btn-primary btn-sm  text-white editar float-left" data-key="${index}">Editar</a>
                          </td>
                          <td>
                            <a class="btn btn-danger btn-sm text-white excluir float-left"  data-key="${index}">Excluir</a>
                          </td>
                      </tr>
                    `);
      });

      htmlTabela.push("</tbody>");

      let prev, next;
      if (data.prev_page_url) {
        prev = `<li class="page-item"><a class="page-link" data-page="${
          data.prev_page_url
        }">Anterior</a></li>`;
      } else {
        prev = `<li class="page-item disabled"><a class="page-link">Anterior</a></li>`;
      }

      if (data.next_page_url) {
        next = `<li class="page-item"><a class="page-link" data-page="${
          data.next_page_url
        }">Próximo</a></li>`;
      } else {
        next = `<li class="page-item disabled"><a class="page-link">Próximo</a></li>`;
      }
      htmlPaginacao = `
                <nav>
                <ul class="pagination">
                  ${prev}
                     <li class="page-item active"><a class="page-link" href="#">${
                       data.current_page
                     }</a></li>
                  ${next}
                </ul>
              </nav>
                `;
      $("#tabela-pedido").html(htmlTabela.join(""));
      $("#paginacao").html(htmlPaginacao);
    }
  });
}

$(document).ready(function() {
  getPedidos();

  $("input[name=search]").keyup(function() {
    search = this.value;
    getPedidos();
  });

  $("#novo-pedido").click(function() {
    $("#modal .modal-title").text("Cadastro de Pedido");

    $("#modal .modal-body").html(`
       <form id="form-pedido">

       <div class="form-group">
       <label>Cód. Barras</label>
       <input type="text" name="codBarras" class="form-control" >
   </div>
       <div class="form-group">
           <label>Pedido</label>
           <input type="text" name="nome" class="form-control">
       </div>
       <div class="form-group">
           <label>Preço</label>
           <input type="text" name="valor" class="form-control">
       </div>
       </form>`);

    $("#modal").modal("show");
  });

  $("#modal #salvar").click(function() {
    let form = $("#modal #form-pedido").serialize();

    $.ajaxSetup({
      headers: {
        "X-CSRF-TOKEN": $('meta[name="_token"]').attr("content")
      }
    });
    $.ajax({
      url: BASE_URL + "/api/pedido",
      type: "post",
      dataType: "json",
      data: form,
      success: function(data) {
        if (data.success) {
          $("#modal #form-pedido").trigger("reset");
          $("#modal").modal("hide");
          search = null;
          order = null;
          $("input[name=search]").val("");
          getPedidos();
          swal("Sucesso!", data.message, "success");
        } else if (!data.success && data.message) {
          swal("Alerta!", data.message, "warning");
        } else {
          swal("Erro!", "Ocorreu um erro", "error");
        }
      },
      error: function() {}
    });
  });
});

$(document).on("click", ".page-item", function() {
  if (!$(this).hasClass("disabled")) {
    getPedidos(
      $(this)
        .find("a")
        .data("page")
    );
  }
});

$(document).on("click", "#tabela-pedido .editar", function() {
  let pedido = storagePedido[$(this).data("key")];
  let select = [];
  $.each(statusOp,function(index,row){
    select.push(`<option value="${row.valor}" ${ row.valor == pedido.status ? "selected" : ""}>${row.opcao}</option>`);
 })

  $("#modal .modal-title").text("Atualização de Pedido");

  $("#modal .modal-body").html(`
       <form id="form-pedido">

       <div class="form-group">
           <label>Status</label>
           <select type="text" name="status" class="form-control">
              ${select.join("")}
           </select>

       </div>

       <div class="form-group">
           <label>Pedido</label>
           <input type="text" name="nome" class="form-control" value="${
             pedido.nome
           }">
       </div>
       <div class="form-group">
           <label>Preço</label>
           <input type="text" name="valor" class="form-control" value="${
             pedido.valor
           }">
       </div>
       <input type="hidden" name="id" value="${pedido.id}">
       </form>`);

  $("#modal").modal("show");
});

$(document).on("click", "#tabela-pedido .excluir", function() {
  let pedido = storagePedido[$(this).data("key")];

  swal({
    title: "Deseja Excluir o pedido?",
    text: "O pedido será excluido definitivamente do sistema",
    icon: "warning",
    buttons: true,
    dangerMode: true
  }).then(willDelete => {
    if (willDelete) {
      $.ajaxSetup({
        headers: {
          "X-CSRF-TOKEN": $('meta[name="_token"]').attr("content")
        }
      });

      $.ajax({
        url: BASE_URL + "/api/pedido/" + pedido.id,
        type: "delete",
        dataType: "json",
        success: function(data) {
          if (data.success) {
            swal("Sucesso!", data.message, "success");
            getPedidos();
          } else if (!data.success && data.message) {
            swal("Alerta!", data.message, "warning");
          } else {
            swal("Erro!", "Ocorreu um erro", "error");
          }
        },
        error: function() {
          swal("Erro!", "Ocorreu um erro", "error");
        }
      });
    }
  });
});
