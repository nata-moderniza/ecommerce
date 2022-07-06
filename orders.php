<?php
include_once "header.php";
include_once "checkLogin.php";
include_once "interface.php";
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
      <div style="cursor: pointer;" onClick=showTable() class="d-flex flex-row align-items-center pointer"><i
          class="fa fa-long-arrow-left"></i><span class="ml-2">Voltar</span></div>
      <div class="row">
        <div class="col-md-6">
          <h4 id="numeroPedido"> Pedido : #</h4>
          <div class="billed"><span class="font-weight-bold">Cliente:</span>
            <span id="clientePedido"> class="ml-1">Jasper Kendrick</span>
          </div>
          <div class="billed"><span class="font-weight-bold">Endereço:</span>
            <span id="enderecoPedido">class="ml-1">May 13, 2020</span>
          </div>
          <div class="billed"><span class="font-weight-bold">Total</span>
            <span id="totalPedido" class="ml-1"></span>
          </div>
        </div>
      </div>
      <div class="row no-gutters">
        <div class="col-md-12">
          <div class="product-details mr-2">
            <hr>
            <div class="d-flex justify-content-between"><span>Itens do Pedido</span>
            </div>
            <div id="itens-pedido">
            </div>
          </div>
        </div>

        <script>
        const showTable = () => {

          $('#tabela').show();
          $('#orderDetails').hide();
        }

        $(document).ready(function() {
          $('#orderDetails').hide();
          $.ajax({
            url: 'http://localhost/ecommerce/getOrder.php',
            method: 'POST',
            dataType: 'json',
            success: function(response) {
              if (response.pedidos.length)
                response.pedidos.forEach((item) => mountTable(item, response.role));
            },
            error: function(response) {
              console.log("responseerror", response)
            },
          });


        });

        function mountTable(item, role) {
          console.log("role", role)
          var newRow = $(`<tr id="teste">`);
          var cols = "";
          cols += `<td>${item.id_order}</td>`;
          cols += `<td>${item.nome_cliente}</td>`;
          cols += `<td>${item.street}</td>`;
          cols += `<td>${item.zipcode}</td>`;
          cols += `<td>${item.situation === '1'? "Pago": "Aguardando"}</td>`;
          cols += `<td>R$ ${item.price_total}</td>`;
          cols +=
            `<td><a style="cursor: pointer;" 
            onClick=viewDetails(${item.id_order})
             class='text-primary'><i class='fa fa-fw fa-edit'></i> Detalhes</a>
             </td>`;


          //  <a href='handleDeleteProvider.php?id={$product['id_product']}}' class='text-danger' >
          //  <i class='fa fa-fw fa-trash'></i> Cancelar</a>
          //  <a href='handleDeleteProvider.php?id={$product['id_product']}}' class='text-danger' >
          //  <i class='fa fa-fw fa-trash'></i> Entregar</a>

          newRow.append(cols);
          $("#tabela-pedidos").append(newRow);
        }

        function handleSearch() {
          var nome = $("#name_order").val();
          var id = $("#id_order").val();

          $('#tabela-pedidos').empty();

          var payload = null

          if (nome || id) {
            payload = {
              name_order: nome,
              id_order: id
            }
          }

          $.ajax({
            url: 'http://localhost/ecommerce/getOrder.php',
            method: 'POST',
            dataType: 'json',
            data: payload,
            success: function(response) {
              if (response.pedidos.length)
                response.pedidos.forEach((item) => mountTable(item, response.role));
            },
            error: function(response) {
              console.log("responseerror", response)
            },
          });

        }

        function viewDetails(idPedido) {
          $('#tabela').hide();
          $('#orderDetails').show();
          $('#itens-pedido').empty();

          $("#numeroPedido").html(`Pedido: #${idPedido}`)

          $.ajax({
            url: 'http://localhost/ecommerce/getItensOrder.php',
            method: 'POST',
            dataType: 'json',
            data: {
              id_pedido: idPedido,
            },
            success: function(response) {
              if (response.length > 0) {
                var total = 0
                response.forEach((item) => {
                  console.log(item)

                  total = parseFloat(total) + parseFloat(item.price_total)

                  $("#itens-pedido").append(`
                  <div class="d-flex justify-content-between align-items-center mt-3 p-2 items rounded">
                <div class="d-flex flex-row"><img class="rounded" src="http://localhost/ecommerce${item.path_imagem}" width="40">
                  <div class="ml-2"><span class="font-weight-bold d-block">${item.name}</span><span class="spec">Descrição</span></div>
                </div>
                <div class="d-flex flex-row align-items-center"><span class="d-block">${item.quantity}</span><span
                    class="d-block ml-5 font-weight-bold">R$ ${item.price_total}</span>
                </div>
              </div>
              <hr>
                  `);
                })
                $("#clientePedido").html(`${response[0].name_user}`)
                $("#enderecoPedido").html(`${response[0].street}`)
                $("#totalPedido").html(`R$ ${total}`)
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