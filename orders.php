<?php
include_once "header.php";
include_once "checkLogin.php";
include_once "interface.php";
include_once "checkPermission.php"
?>
<section>

  <div class="container mt-3">
    <div id="tabela">
      <div class="">
        <h5 class="card-title">Pedidos</h5>
        <div class="row">
          <div class="col-sm-4">
            <div class="form-group">
              <label>Nome</label>
              <input type="text" id="name_order" class="form-control" value="">
            </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group">
              <label>Número Pedido</label>
              <input id="id_order" class="form-control" value="">
            </div>
          </div>
          <div class="col-sm-2">
            <div class="form-group">
              <label>&nbsp;</label>
              <div>
                <button onClick=handleSearch() type="submit" name="submit" value="search" id="submit"
                  class="btn btn-primary"><i class="fa fa-fw fa-search"></i> Pesquisar</button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <table class='table table-striped table-bordered'>
        <thead>
          <tr class='bg-primary text-white'>
            <th>Código</th>
            <th>Cliente</th>
            <th>Endereço</th>
            <th>CEP</th>
            <th>Situação</th>
            <th>Preço Total</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody id="tabela-pedidos">
        </tbody>
      </table>
    </div>

    <div id="orderDetails" class="container mt-5 p-3 rounded cart">
      <div class="row no-gutters">
        <div class="col-md-12">
          <div class="product-details mr-2">
            <div class="d-flex flex-row align-items-center"><i class="fa fa-long-arrow-left"></i><span
                class="ml-2">Voltar</span></div>
            <hr>
            <div class="d-flex justify-content-between"><span>Itens do Pedido</span>
            </div>
            <div id="itens-pedido">

            </div>
          </div>
        </div>

        <script>
        $(document).ready(function() {
          $('#orderDetails').hide();
          $.ajax({
            url: 'http://localhost/ecommerce/getOrder.php',
            method: 'POST',
            dataType: 'json',
            success: function(response) {
              if (response.length)
                response.forEach((item) => mountTable(item));
            },
            error: function(response) {
              console.log("responseerror", response)
            },
          });


        });

        function mountTable(item) {
          var newRow = $(`<tr>`);
          var cols = "";

          cols += `<td>${item.id_order}</td>`;
          cols += `<td>${item.nome_cliente}</td>`;
          cols += `<td>${item.street}</td>`;
          cols += `<td>${item.zipcode}</td>`;
          cols += `<td>${item.situation}</td>`;
          cols += `<td>${item.price_total}</td>`;
          cols +=
            `<td><a onClick=viewDetails(${item.id_order}) class='text-primary'><i class='fa fa-fw fa-edit'></i> Detalhes</a></td>`;


          newRow.append(cols);
          $("#tabela-pedidos").append(newRow);
        }

        function handleSearch() {
          var nome = $("#name_order").val();
          var id = $("#id_order").val();

          $('#tabela-pedidos').empty();

          $.ajax({
            url: 'http://localhost/ecommerce/getOrder.php',
            method: 'POST',
            dataType: 'json',
            data: {
              name_order: nome,
              id_order: id
            },
            success: function(response) {
              if (response.length > 0)
                response.forEach((item) => mountTable(item));
            },
            error: function(response) {
              console.log("responseerror", response)
            },
          });

        }

        function viewDetails(idPedido) {
          $('#tabela').hide();
          $('#orderDetails').show();

          $.ajax({
            url: 'http://localhost/ecommerce/getItensOrder.php',
            method: 'POST',
            dataType: 'json',
            data: {
              id_pedido: idPedido,
            },
            success: function(response) {
              if (response.length > 0) {
                response.forEach((item) => {
                  console.log("item", item)
                  $("#itens-pedido").append(`
                  <div class="d-flex justify-content-between align-items-center mt-3 p-2 items rounded">
                <div class="d-flex flex-row"><img class="rounded" src="http://localhost/ecommerce${item.path_imagem}" width="40">
                  <div class="ml-2"><span class="font-weight-bold d-block">${item.name}</span><span class="spec">Descrição</span></div>
                </div>
                <div class="d-flex flex-row align-items-center"><span class="d-block">${item.quantity}</span><span
                    class="d-block ml-5 font-weight-bold">R$ ${item.price_total}</span>
                </div>
              </div>
                  `);
                })


              }

            },
            error: function(response) {
              console.log("responseerror", response)
            },
          });
        }
        </script>

</section>

<?php
// layout do rodapé
?>