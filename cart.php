<?php
include_once "header.php";
include_once "checkLogin.php";
include_once "interface.php";
?>
<section>

  <div class="container">
    <div class="py-5 text-center">
      <h2>Finalização</h2>
    </div>

    <div class="row">
      <div class="col-md-4 order-md-2 mb-4">
        <?php 

        echo "<h4 class='d-flex justify-content-between align-items-center mb-3'>";
        echo "<span class='text-muted'>Carrinho</span>";
        echo "</h4>";
        echo "<ul class='list-group mb-3'>";
        
        $total = 0;
      
        if(isset($_SESSION["carrinho"]))
        {

        
   foreach($_SESSION["carrinho"] as $key => $value)
      {     
            $total += $value["quantidade"] * $value["preco"]; 
            echo "<li class='list-group-item d-flex justify-content-between lh-condensed'>";
            echo "<div>";
            echo "<h6 class='my-0'>{$value["nome"]}</h6>";
            echo "<small class='text-muted'>Qtd. {$value["quantidade"]}</small>";
            echo "</div>";
            echo "<span class='text-muted'>R$ {$value["preco"]} </span>";
            echo "</li>";
      }

          echo "<li class='list-group-item d-flex justify-content-between'>";
          echo "<span>Total R$</span>";
          echo "<strong>R$ {$total}</strong>";
          echo "</li>";
        }
 ?>

        </ul>

      </div>
      <div class="col-md-8 order-md-1">
        <h4 class="mb-3">Faturamento</h4>
        <form id="form-checkout">
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="firstName">Nome</label>
              <input type="text" class="form-control" id="name" placeholder="" value="">
            </div>
          </div>

          <div class="mb-3">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" placeholder="you@example.com">
          </div>

          <div class="mb-3">
            <label for="address">Endereço</label>
            <input type="text" class="form-control" id="address">
          </div>

          <div class="row">
            <div class="col-md-3 mb-3">
              <label for="zip">CEP</label>
              <input type="text" class="form-control" id="zip" placeholder="">
            </div>
          </div>

          <hr class="mb-4">

          <h4 class="mb-3">Pagamento</h4>

          <div class="d-block my-3">
            <div class="custom-control custom-radio">
              <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked>
              <label class="custom-control-label" for="credit">Cartão de Crédito</label>
            </div>
            <div class="custom-control custom-radio">
              <input id="debit" name="paymentMethod" type="radio" class="custom-control-input">
              <label class="custom-control-label" for="debit">Cartão de Débito</label>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="cc-name">Nome no Cartão</label>
              <input type="text" class="form-control" id="cc-name" placeholder="">
              <small class="text-muted">Nome escrito no cartão</small>
            </div>
            <div class="col-md-6 mb-3">
              <label for="cc-number">Número Cartão</label>
              <input type="text" class="form-control" id="cc-number" placeholder="">
            </div>
          </div>
          <div class="row">
            <div class="col-md-3 mb-3">
              <label for="cc-expiration">Vencimento</label>
              <input type="text" class="form-control" id="cc-expiration" placeholder="">
            </div>
            <div class="col-md-3 mb-3">
              <label for="cc-expiration">CVV</label>
              <input type="text" class="form-control" id="cc-cvv" placeholder="">
            </div>
          </div>
          <hr class="mb-4">
          <?php 
         
         if(isset($_SESSION["carrinho"]))
         {
            echo "<button class='btn btn-primary btn-lg btn-block' type='submit'>Finalizar</button>";
         }
         ?>
        </form>
      </div>
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

  <script type="text/JavaScript">


    $('#form-checkout').submit(function(e)
 {
    e.preventDefault()
    var name = $('#name').val();
    var email = $('#email').val();
    var address = $('#address').val(); 
    var zipcode = $('#zip').val();
    var ccname = $('#cc-name').val();
    var ccnumber = $('#cc-name').val();
    var ccexpiration = $('#cc-expiration').val();
    var cccvv = $('#cc-cvv').val();

    // if(!name)
    // {
    //     $("#modal-text").text("Informe o Nome");
    //     $("#modal-login").modal()
    //     return 
    // }

    // if(!email)
    // {
    //     $("#modal-text").text("Informe o E-mail");
    //     $("#modal-login").modal()
    //     return 
    // }

    // if(!address)
    // {
    //     $("#modal-text").text("Informe o Endereço");
    //     $("#modal-login").modal()
    //     return 
    // }
    
    // if(!zipcode)
    // {
    //     $("#modal-text").text("Informe o CEP");
    //     $("#modal-login").modal()
    //     return 
    // }

    // if(!ccname || !ccexpiration || !cccvv || ccnumber)
    // {
    //   $("#modal-text").text("Preencha todos os campos do pagamento.");
    //     $("#modal-login").modal()
    //     return 
    // }

    const payload = {
      id_pedido: 0,
      endereco: address,
      cep: zipcode,
      nome: name,
    }

    $.ajax({
        url: 'http://localhost/ecommerce/handleOrder.php',
        method: 'POST',
        data: payload,
        dataType: 'json',
        success: function (data) {
          if (data.code == 200){
        alert("Success: " +data.msg);
        //ou uma forma de ver todo conteúdo do retorno é
        console.log(data);
        //ou apenas o conteúdo do elemento msg
        console.log(data.msg);
    } 
        },
        error: function (response) {
          console.log("response",response) 
       }
    })
 })   

  
</script>

</section <?php
// layout do rodapé
?>