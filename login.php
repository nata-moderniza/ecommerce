<?php
// layout do cabeçalho
include_once "header.php";
?>

<style>
.form-signin {
  width: 100%;
  max-width: 330px;
  padding: 15px;
  margin: 0 auto;
}

.form-signin .checkbox {
  font-weight: 400;
}

.form-signin .form-control {
  position: relative;
  box-sizing: border-box;
  height: auto;
  padding: 10px;
  font-size: 16px;
}

.form-signin .form-control:focus {
  z-index: 2;
}

.form-signin input[type="email"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}

.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}
</style>

<body class="text-center">
  <form class="form-signin" id="form-login">
    <h1 class=" h3 mb-3 font-weight-normal">Faça Login</h1>
    <label for="inputEmail" class="sr-only">Email</label>
    <input type="email" class="form-control mt-2" id="input-email-login" placeholder="Email" name="email" autofocus>
    <label for="inputPassword" class="sr-only">Senha</label>
    <input type="password" id="input-senha-login" class="form-control mt-3" name="senha" placeholder="Senha">
    <div class="checkbox mb-3">
      <a style="cursor: pointer;" href="register.php">
        <label>
          Registrar-se
        </label>
      </a>
    </div>
    <button id="btn-login" class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>

  </form>
</body>


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
          window.location.href = "http://localhost/ecommerce/index.php";
        },
        error: function (response) {
          window.location.href = "http://localhost/ecommerce/index.php";
       }
    })
 })   

  
</script>

<?php
// layout do rodapé
?>