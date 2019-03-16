var search = null;
var storageCliente = [];
var ordem = ["id", "desc"];

function ordenar(field) {
  let order;
  if (ordem[0] == field) {
    order = ordem[1] == "asc" ? "desc" : "asc";
  } else {
    order = "asc";
  }

  ordem = [field, order];
  getClientes(BASE_URL + "/api/clientes");
}

function getClientes(page = null) {
  $.ajax({
    url: page ? page : BASE_URL + "/api/clientes",
    type: "GET",
    dataType: "json",
    data: {
      search: search,
      ordem: ordem
    },
    success: function(data) {
      storageCliente = data.data;
      let htmlTabela = [];
      let htmlPaginacao;

      htmlTabela.push(`
      <thead>
      <th onClick="ordenar('id')">ID</th>
      <th onClick="ordenar('nome')">Nome</th>
      <th onClick="ordenar('cpf')">cpf</th>
      <th onClick="ordenar('email')">E-mail</th>
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
                          <td>${row.nome}</td>
                          <td>${row.cpf}</td>
                          <td>${row.email}</td>
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
      $("#tabela-clientes").html(htmlTabela.join(""));
      $("#paginacao").html(htmlPaginacao);
    }
  });
}

$(document).ready(function() {
  getClientes();

  $("input[name=search]").keyup(function() {
    search = this.value;
    getClientes();
  });

  $("#novo-cliente").click(function() {
    $("#modal .modal-title").text("Cadastro de Cliente");

    $("#modal .modal-body").html(`
       <form id="form-cliente">

       <div class="form-group">
       <label>Nome</label>
       <input type="text" name="nome" class="form-control" >
   </div>
       <div class="form-group">
           <label>CPF</label>
           <input type="text" name="cpf" class="form-control">
       </div>
       <div class="form-group">
           <label>E-mail</label>
           <input type="text" name="email" class="form-control">
       </div>
       </form>`);

    $("#modal").modal("show");
  });

  $("#modal #salvar").click(function() {
    let form = $("#modal #form-cliente").serialize();

    $.ajaxSetup({
      headers: {
        "X-CSRF-TOKEN": $('meta[name="_token"]').attr("content")
      }
    });
    $.ajax({
      url: BASE_URL + "/api/cliente",
      type: "post",
      dataType: "json",
      data: form,
      success: function(data) {
        if (data.success) {
          $("#modal #form-cliente").trigger("reset");
          $("#modal").modal("hide");
          search = null;
          order = null;
          $("input[name=search]").val("");
          getClientes();
          swal("Sucesso!", data.message, "success");
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
  });
});

$(document).on("click", ".page-item", function() {
  if (!$(this).hasClass("disabled")) {
    getClientes(
      $(this)
        .find("a")
        .data("page")
    );
  }
});

$(document).on("click", "#tabela-clientes .editar", function() {
  let cliente = storageCliente[$(this).data("key")];

  $("#modal .modal-title").text("Atualização de Cliente");

  $("#modal .modal-body").html(`
       <form id="form-cliente">

       <div class="form-group">
           <label>Nome</label>
           <input type="text" name="nome" class="form-control" value="${
             cliente.nome
           }">
       </div>

       <div class="form-group">
           <label>CPF</label>
           <input type="text" name="cpf" class="form-control" value="${
             cliente.cpf
           }">
       </div>
       <div class="form-group">
           <label>E-mail</label>
           <input type="text" name="email" class="form-control" value="${
             cliente.email
           }">
       </div>
       <input type="hidden" name="id" value="${cliente.id}">
       </form>`);

  $("#modal").modal("show");
});

$(document).on("click", "#tabela-clientes .excluir", function() {
  let cliente = storageCliente[$(this).data("key")];

  swal({
    title: "Deseja Excluir o cliente?",
    text: "O cliente será excluido definitivamente do sistema",
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
        url: BASE_URL + "/api/cliente/" + cliente.id,
        type: "delete",
        dataType: "json",
        success: function(data) {
          if (data.success) {
            swal("Sucesso!", data.message, "success");
            getClientes();
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
