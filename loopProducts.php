<?php
include_once "header.php";
include_once "interface.php"
?>
<section>
  <div class="album py-5 bg-light">
    <div class="container mt-3">

      <?php

        $dao = $factory->getProductDao();
        $products = $dao->getProductsLoop('');
        echo "<div class='row'>";  
          foreach ($products as $product) {
            
            $caminhoImagem = "http://localhost/ecommerce". $product['path_imagem'];
               
            echo "<div class='col-md-4'>";
            echo  "<div class='card mb-4 box-shadow'>";
            echo  "<div class='card-header'>";
            echo  "<h4 class='my-0 font-weight-normal'>{$product['name']}</h4>";
            echo  "</div>";
            echo  "<div class='card-body'>";
            echo  "<img class='img-fluid border-0' src='{$caminhoImagem}' alt='Card image cap'>";
            echo  "<h3 class='card-title pricing-card-title'>R$ {$product['price']}</h3>";
            echo  "<ul class='list-unstyled mt-3 mb-4'>";
            if($product['quantity'] > 0)
            echo  "<li>Estoque: {$product['quantity']}</li>";
            else
            echo  "<li>Produto Indisponível</li>";

            echo  "</ul>";

            if($product['quantity'] > 0)
            {
              echo "<button  onClick=addCard({$product['id_product']},".$product['price'].",'". 
              $product['name']."'".") 
              type='button' class='btn btn-lg btn-block btn-outline-primary'>Comprar</button>";
            }
            else{
              echo "<button disabled type='button' class='btn btn-lg btn-block btn-outline-primary'>Sem Estoque</button>";

            }
            echo "</div>";
            echo "</div>";
            echo "</div>";

          }
          echo "</div>";
      ?>

    </div>

  </div>

  <div id="modal-login" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Aviso</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p id="modal-text">Modal body text goes here.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Ok</button>
        </div>
      </div>
    </div>
  </div>

  <script>
  function addCard(idProduto, preco, nome) {

    $.ajax({
      url: 'http://localhost/ecommerce/addProductCart.php',
      method: 'POST',
      dataType: 'json',
      data: {
        id: idProduto,
        nome: nome,
        preco: preco
      },
      success: function(response) {
        if (response.responseText === "Code: 00") {
          $("#modal-text").text("Produto Adicionado ao carrinho");
          $("#modal-login").modal()
        } else if (response.responseText === "Code: 01") {
          $("#modal-text").text("Não é possível comprar mais que a quantidade em estoque");
          $("#modal-login").modal()
        }
      },
      error: function(response) {
        if (response.responseText === "Code: 00") {
          $("#modal-text").text("Produto Adicionado ao carrinho");
          $("#modal-login").modal()
        } else if (response.responseText === "Code: 01") {
          $("#modal-text").text("Não é possível comprar mais que a quantidade em estoque");
          $("#modal-login").modal()
        }
      },
    });

  }
  </script>

</section>
<?php
// layout do rodapé
?>