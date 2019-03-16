var search = null;
var storageProduto = [];
function getProdutos(page = null) {
  $.ajax({
    url: page
      ? page + (search ? "&search=" + search : "")
      : BASE_URL + "/api/produtos" + (search ? "?search=" + search : ""),
    type: "GET",
    dataType: "json",
    success: function(data) {
      storageProduto = data.data;
      let htmlTabela = [];
      let htmlPaginacao;
      $.each(data.data, function(index, row) {
        htmlTabela.push(`
                      <tr>
                          <td>${row.id}</td>
                          <td>${row.codBarras}</td>
                          <td>${row.nome}</td>
                          <td>${row.valor}</td>
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
      $("#tabela-produto tbody").html(htmlTabela.join(""));
      $("#paginacao").html(htmlPaginacao);
    }
  });
}

$(document).ready(function() {
  getProdutos();

  $("input[name=search]").keyup(function() {
    search = this.value;
    getProdutos();
  });

  $("#novo-produto").click(function() {
    $("#modal .modal-title").text("Cadastro de Produto");

    $("#modal .modal-body").html(`
       <form id="form-produto">

       <div class="form-group">
       <label>Cód. Barras</label>
       <input type="text" name="codBarras" class="form-control" >
   </div>
       <div class="form-group">
           <label>Produto</label>
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
    let form = $("#modal #form-produto").serialize();

    $.ajaxSetup({
      headers: {
        "X-CSRF-TOKEN": $('meta[name="_token"]').attr("content")
      }
    });
    $.ajax({
      url: BASE_URL + "/api/produto",
      type: "post",
      dataType: "json",
      data: form,
      success: function(data) {
        if (data.success) {
          $("#modal #form-produto").trigger("reset");
          $("#modal").modal("hide");
          getProdutos();
        }
        alert(data.message);
      }
    });
  });
});

$(document).on("click", ".page-item", function() {
  if (!$(this).hasClass("disabled")) {
    getProdutos(
      $(this)
        .find("a")
        .data("page")
    );
  }
});

$(document).on("click", "#tabela-produto .editar", function() {
  let produto = storageProduto[$(this).data("key")];

  $("#modal .modal-title").text("Atualização de Produto");

  $("#modal .modal-body").html(`
       <form id="form-produto">

       <div class="form-group">
           <label>Cód. Barras</label>
           <input type="text" name="codBarras" class="form-control" value="${
             produto.codBarras
           }">
       </div>

       <div class="form-group">
           <label>Produto</label>
           <input type="text" name="nome" class="form-control" value="${
             produto.nome
           }">
       </div>
       <div class="form-group">
           <label>Preço</label>
           <input type="text" name="valor" class="form-control" value="${
             produto.valor
           }">
       </div>
       <input type="hidden" name="id" value="${produto.id}">
       </form>`);

       $("#modal").modal("show");
});



$(document).on("click", "#tabela-produto .excluir", function() {
  let produto = storageProduto[$(this).data("key")];

  
    $.ajaxSetup({
      headers: {
        "X-CSRF-TOKEN": $('meta[name="_token"]').attr("content")
      }
    });

    $.ajax({
      url: BASE_URL + "/api/produto/"+produto.id,
      type: "delete",
      dataType: "json",
      success: function(data) {
        if (data.success) {
          getProdutos();
        }
        alert(data.message);
      }
    });

});
