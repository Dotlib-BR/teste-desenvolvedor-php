var search = null;
var storagePedido = [];
var ordem = ["id", "desc"];
var paginaAtual;


/**
 *
 * @param {object} pedido_detalhe
 * @param {String = option[cdesconto,sdesconto]} tipo
 */
function total(pedido_detalhe, tipo = "sdesconto") {
  let total = 0;
  $.each(pedido_detalhe, function(index, row) {
    if (tipo == "cdesconto") {
      total +=
        (row.produto.valor - (row.produto.valor / 100) * row.desconto) *
        row.quantidade;
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
      paginaAtual = data.path+"?page="+data.current_page;

      htmlTabela.push(`
      <thead>
      <th onClick="ordenar('id')">ID</th>
      <th onClick="ordenar('status')">Status</th>
      <th >Cliente</th>
      <th >E-mail</th>
      <th>Valor Compra</th>
      <th>Valor C/ Desconto</th>
      <th onClick="ordenar('created_at')">Data Registro</th>
      <th onClick="ordenar('updated_at')">Data Atualização</th>
      <th colspan="2">Ação</th>
      <tbody>
  </thead>
      `);
      $.each(data.data, function(index, row) {

        switch(row.status){
          case "aberto" || "cancelar":
              statusLegenda ="Receber"
              btnLegenda = "success";
          break;
          case "pago":
              statusLegenda ="Cancelar"
              btnLegenda = "danger";
          break;

        }
        htmlTabela.push(`
                      <tr>
                          <td>${row.id}</td>
                          <td>${row.status}</td>
                          <td>${row.cliente.nome}</td>
                          <td>${row.cliente.email}</td>
                          <td>${total(row.pedido_detalhe).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'})}</td>
                          <td>${total(row.pedido_detalhe, "cdesconto").toLocaleString('pt-br',{style: 'currency', currency: 'BRL'})}</td>
                          <td>${row.created_at}</td>
                          <td>${row.updated_at}</td>
                          <td>
                            <a class="btn btn-primary btn-sm  text-white editar float-left" data-key="${index}">Editar</a>
                          </td>
                          <td>
                            <a class="btn btn-${btnLegenda} btn-sm text-white pagamento float-left"  data-key="${index}">${statusLegenda}</a>
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

function searchCliente(search = null) {
  $.ajax({
    url: BASE_URL + "/api/clientes",
    type: "get",
    dataType: "json",
    data: { search: search },
    success: function(data) {
      let listaCliente = [];
      if (data.data.length > 0) {
        listaCliente.push(`<ul class="list-group">`);
        $.each(data.data, function(index, row) {
          listaCliente.push(
            `<li data-cliente_id="${
              row.id
            }" class="list-group-item item-lista-cliente">${row.nome +
              " - CPF " +
              row.cpf}</li>`
          );
        });
        listaCliente.push(`</ul>`);
      } else {
        listaCliente.push("<b>Nenhum cliente foi encontrado!</b>");
      }

      $("#modal-complementar .modal-body #lista-clientes").html(
        listaCliente.join("")
      );
    },
    error: function() {}
  });
}

function searchProduto(search = null) {
  $.ajax({
    url: BASE_URL + "/api/produtos",
    type: "get",
    dataType: "json",
    data: { search: search },
    success: function(data) {
      let listaProduto = [];
      if (data.data.length > 0) {
        listaProduto.push(`<ul class="list-group">`);
        $.each(data.data, function(index, row) {
          listaProduto.push(
            `<li data-produto_id="${
              row.id
            }" class="list-group-item item-lista-produtos"><b>ID </b>
              ${row.id}
              PRODUTO -  
              ${row.nome}
              PREÇO - 
              ${row.valor.toLocaleString('pt-br',{style: 'currency', currency: 'BRL'})}</li>`
          );
        });
        listaProduto.push(`</ul>`);
      } else {
        listaProduto.push("<b>Nenhum cliente foi encontrado!</b>");
      }

      $("#modal-complementar .modal-body #lista-produtos").html(
        listaProduto.join("")
      );
    },
    error: function() {}
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
       <label><a class="btn btn-sm btn-primary text-white " id="btn-search-cliente">Pesquisar Cliente</a></label>
       <h5 id="cliente-legenda">Sem Cliente no pedido</h5>
       </div>

       <div class="form-group">
          <label><a class="btn btn-sm btn-primary text-white d-none" id="btn-search-produto">Pesquisar produto</a></label>
       </div>

       <h5 class="text-center">Lista de Produtos</h5>
       <div class="col-md-12" id="lista-produtos-form" style="overflow:auto;max-height:300px">
       </div>

       <input type="hidden" name="id">
       </form>`);

    $("#modal").modal("show");
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
  let listaProdutos = [];

  listaProdutos.push("<ul class='list-group'>");
  $.each(pedido.pedido_detalhe, function(index, row) {
    listaProdutos.push(`
    <li 
        data-produto_id="${row.produto.id}" 
        data-quantidade="${row.quantidade}" 
        data-desconto="${row.desconto}" 
        data-pedido_detalhe_id="${row.id}" 
        class="list-group-item item-lista-produto"
    >
      <b>PRODUTO</b> : ${row.produto.nome} <br>
      <b>QUANTIDADE</b> : ${row.quantidade}<br>
      <b>DESCONTO</b> : ${row.desconto}<br>
      <b>PREÇO</b> : ${row.produto.valor.toLocaleString('pt-br',{style: 'currency', currency: 'BRL'})} <br>
      <b>PREÇO C/ DESCONTO</b> : ${(row.produto.valor -
        (row.produto.valor / 100) * row.desconto).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'})} <br>
      </li>`);
  });
  listaProdutos.push("</ul>");

  $("#modal .modal-title").text("Atualização de Pedido");

  $("#modal .modal-body").html(`
       <form id="form-pedido">

       <div class="form-group">
       <label><a class="btn btn-sm btn-primary text-white " id="btn-search-cliente">Pesquisar Cliente</a></label>
       <h5 id="cliente-legenda">${pedido.cliente.nome}</h5>
       </div>
     
       <div class="form-group">
          <label><a class="btn btn-sm btn-primary text-white" id="btn-search-produto">Pesquisar produto</a></label>
       </div>
       <h5 class="text-center">Lista de Produtos</h5>
       <div class="col-md-12" id="lista-produtos-form" style="overflow:auto;max-height:300px">
       ${listaProdutos.join("")}
       </div>

       

       
       <input type="hidden" name="id" value="${pedido.id}">
       </form>`);

  $("#modal").modal("show");
});

$(document).on("click", "#tabela-pedido .pagamento", function() {
  let pedido = storagePedido[$(this).data("key")];

  if(pedido.pedido_detalhe.length  < 1 && pedido.status == "aberto"){
    swal("Alerta","Para receber é necessario incluir pelo menos 1 produto no pedido!","warning");
    return;
  }
  let form = {};
  form.pedido_id = pedido.id
  form.status = pedido.status;

  swal({
    title: "Deseja mudar status do pedido?",
    text: "",
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
        url: BASE_URL + "/api/pedido-pagamento",
        type: "put",
        dataType: "json",
        data:form,
        success: function(data) {
          if (data.success) {
            swal("Sucesso!", data.message, "success");
            getPedidos(paginaAtual);
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

$(document).on("click", "#btn-search-cliente", function() {
  let htmlPesquisaCliente = `
      <div class="form-group">
      <label>Clientes</label>
        <input type="text" name="pesquisa-cliente" class="form-control">
      </div>

      <div id="lista-clientes" style="overflow:auto;max-height:300px;"></div>
    
    `;

  $("#modal-complementar .modal-body").html(htmlPesquisaCliente);
  $("#modal-complementar").modal("show");
  searchCliente();
});

$(document).on(
  "keydown",
  "#modal-complementar input[name=pesquisa-cliente]",
  function() {
    searchCliente(this.value);
  }
);

$(document).on("click", "#lista-clientes .item-lista-cliente", function() {
  var msg = $("#modal input[name=id]").val() ? "atualizado o " : "iniciado um";
  swal({
    title: "Incluir cliente",
    text: "Ao confirmar será " + msg + " pedido!",
    icon: "warning",
    buttons: true,
    dangerMode: false
  }).then(salvar => {
    if (salvar) {
      $.ajaxSetup({
        headers: {
          "X-CSRF-TOKEN": $('meta[name="_token"]').attr("content")
        }
      });

      let form = {};
      form.cliente_id = $(this).data("cliente_id");
      form.pedido_id = $("#modal input[name=id]").val();
      $.ajax({
        url: BASE_URL + "/api/pedido",
        type: "post",
        dataType: "json",
        data: form,
        success: function(data) {
          if (data.success) {
            $("#modal #cliente-legenda").text(
              data.pedido.cliente.nome + " - CPF" + data.pedido.cliente.cpf
            );
            $("#modal #cliente-legenda").data(
              "cliente_id",
              data.pedido.cliente.id
            );
            $("#modal input[name=id]").val(data.pedido.id);
            $("#modal #btn-search-produto").removeClass("d-none");
            $("#modal-complementar").modal("hide");
            swal("Sucesso!", data.message, "success");
            getPedidos();
          } else if (!data.success && data.message) {
            swal("Alerta!", data.message, "warning");
          } else {
            swal("Erro!", "Ocorreu um erro!", "error");
          }
        },
        error: function() {
          swal("Erro!", "Ocorreu um erro!", "error");
        }
      });
    }
  });
});

$(document).on("click", "#btn-search-produto", function() {
  let htmlPesquisaCliente = `
      <div class="form-group">
      <label>Produto</label>
        <input type="text" name="pesquisa-produto" class="form-control">
      </div>

      <div id="lista-produtos" style="overflow:auto;max-height:300px;"></div>
    
    `;

  $("#modal-complementar .modal-body").html(htmlPesquisaCliente);
  $("#modal-complementar").modal("show");
  searchProduto();
});

$(document).on(
  "keydown",
  "#modal-complementar input[name=pesquisa-produto]",
  function() {
    searchProduto(this.value);
  }
);

$(document).on("click", "#lista-produtos .item-lista-produtos", function() {
  $("#modal-complementar-form .modal-body").html(`
      
       <div class="form-group">
          <label>Quantidade</label>
            <input type="text" name="quantidade" class="form-control">
       </div>

       <div class="form-group">
       <label>Desconto</label>
         <input type="text" name="desconto" class="form-control">
       </div>
       <input type="hidden" name="produto_id" value="${$(this).data(
         "produto_id"
       )}">
       <input type="hidden" name="pedido_id" value="${$(
         "#form-pedido input[name=id]"
       ).val()}">
       
    `);
  $("#modal-complementar-form").modal("show");
});

$(document).on("click", "#modal-complementar-form #salvar", function() {
  let form = {};
  form.quantidade = $("#modal-complementar-form input[name=quantidade]").val();
  form.desconto = $("#modal-complementar-form input[name=desconto]").val();
  form.produto_id = $("#modal-complementar-form input[name=produto_id]").val();
  form.pedido_id = $("#modal-complementar-form input[name=pedido_id]").val();
  form.pedido_detalhe_id = $("#modal-complementar-form input[name=pedido_detalhe_id]").val();

  $.ajax({
    url: BASE_URL + "/api/pedido-detalhe",
    type: "post",
    dataType: "json",
    data: form,
    success: function(data) {
      if (data.success) {
        let listaProdutos = [];
        listaProdutos.push("<ul class='list-group'>");
        $.each(data.pedido.pedido_detalhe, function(index, row) {
          listaProdutos.push(`
          <li 
              data-produto_id="${row.produto.id}" 
              data-quantidade="${row.quantidade}" 
              data-desconto="${row.desconto}" 
              data-pedido_detalhe_id="${row.id}" 
              class="list-group-item item-lista-produto"
          >
            <b>PRODUTO</b> : ${row.produto.nome} <br>
            <b>QUANTIDADE</b> : ${row.quantidade}<br>
            <b>DESCONTO</b> : ${row.desconto}<br>
            <b>PREÇO</b> : ${row.produto.valor} <br>
            <b>PREÇO C/ DESCONTO</b> : ${row.produto.valor -
              (row.produto.valor / 100) * row.desconto} <br>
            </li>`);
        });
        listaProdutos.push("</ul>");

        $("#lista-produtos-form").html(listaProdutos.join(""));
        $("#modal-complementar-form").modal("hide");
        $("#modal-complementar").modal("hide");

        swal("Sucesso!", data.message, "success");
        getPedidos();
      } else if (!data.success && data.message) {
        swal("Alerta!", data.message, "warning");
      } else {
        swal("Erro!", "Ocorreu um erro!", "error");
      }
    },
    error: function() {}
  });
});

$(document).on("click", "#lista-produtos-form .item-lista-produto", function() {
  $("#modal-complementar-form .modal-body").html(`
    
     <div class="form-group">
        <label>Quantidade</label>
          <input type="text" name="quantidade" class="form-control" value="${$(
            this
          ).data("quantidade")}">
     </div>

     <div class="form-group">
     <label>Desconto</label>
       <input type="text" name="desconto" class="form-control" value="${$(
         this
       ).data("desconto")}">
     </div>
     <input type="hidden" name="produto_id" value="${$(this).data(
       "produto_id"
     )}">
     <input type="hidden" name="pedido_id" value="${$(
       "#form-pedido input[name=id]"
     ).val()}">
     <input type="hidden" name="pedido_detalhe_id" value="${$(this).data(
       "pedido_detalhe_id"
     )}">

  `);
  $("#modal-complementar-form").modal("show");
});
