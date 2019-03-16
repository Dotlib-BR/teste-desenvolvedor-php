var search=null;
function getProdutos(page = null) {
  $.ajax({
    url: page ? page+(search ? "&search="+search : "") : BASE_URL + "/api/produtos"+(search ? "?search="+search : ""),
    type: "GET",
    dataType: "json",
    success: function(data) {
      let htmlTabela = [];
      let htmlPaginacao;
      $.each(data.data, function(index, row) {
        htmlTabela.push(`
                      <tr>
                          <td>${row.id}</td>
                          <td>${row.nome}</td>
                          <td>${row.valor}</td>
                          <td>${row.created_at}</td>
                          <td>${row.updated_at}</td>
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

  $("input[name=search]").keyup(function(){
        search = this.value;
        getProdutos();
  });

});



$(document).on("click", ".page-item", function() {
  if (!$(this).hasClass("disabled")){
    getProdutos(
      $(this)
        .find("a")
        .data("page")
    );
  }
});
