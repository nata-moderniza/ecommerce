<?php
include_once "header.php";
include_once "checkLogin.php";
include_once "interface.php";
include_once "checkPermission.php"
?>
<section>
  <div class="album py-5 bg-light">
    <div class="container mt-3">

      <?php

        $dao = $factory->getProductDao();
        $products = $dao->getProducts();
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
            echo  "<h1 class='card-title pricing-card-title'>$0 <small class='text-muted'>/ mo</small></h1>";
            echo  "<ul class='list-unstyled mt-3 mb-4'>";
            echo  "<li>Estoque: {$product['quantity']}</li>";
            echo  "</ul>";
            echo "<button  onClick=addCard({$product['id_product']},".$product['quantity'].") 
            type='button' class='btn btn-lg btn-block btn-outline-primary'>Comprar</button>";
            echo "</div>";
            echo "</div>";
            echo "</div>";

          }
          echo "</div>";
      ?>

    </div>

  </div>

  <script>
  function addCard(idProduto, quantidade, nome) {
    console.log("idProduto", idProduto)

    $.ajax({
      url: 'http://localhost/ecommerce/addProductCart.php',
      method: 'POST',
      dataType: 'json',
      data: {
        id: idProduto
      },
      success: function(response) {
        console.log("response", response)
        $('#imagem').val(response); // display success response from the server
      },
      error: function(response) {
        console.log("response", response)

        $('#imagem').html(response); // display error response from the server
      }
    });

  }
  </script>

  <?php 
   
   foreach($_SESSION["carrinho"] as $key => $value)
   {

    echo $value["nome"];    
   }
   
 ?>

</section>
<?php
// layout do rodapé
?>