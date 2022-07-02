<?php
// layout do cabeçalho
include_once "header.php";
?>


<section>
       <form id="form-login">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="input-email-login" placeholder="Email" name="email" >
        </div>
        <div class="form-group">
            <label for="senha">Senha</label>
            <input type="password" id="input-senha-login" class="form-control" name="senha" placeholder="Senha">
        </div>
        <button type="submit" id="btn-login"  class="btn btn-primary">Entrar</button>
</form>

</section>

<div id="modal-login" class="modal modal-warning" tabindex="-1" role="dialog">
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
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>


<script type="text/JavaScript">


$('#form-login').submit(function(e)
 {
    e.preventDefault()
    var email = $('#input-email-login').val();
    var senha = $('#input-senha-login').val();
    
    if(!email)
    {
        $("#modal-text").text("Informe o E-mail");
        $("#modal-login").modal()
        return 
    }

    if(!senha)
    {
        $("#modal-text").text("Informe a Senha");
        $("#modal-login").modal()
        return
    }

    $.ajax({
        url: 'http://localhost/ecommerce/handleLogin.php',
        method: 'POST',
        data: {email: email, senha:senha},
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

<?php
// layout do rodapé
?>