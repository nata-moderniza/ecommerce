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
  <form class="form-signin" id="form-register">
    <h1 class=" h3 mb-3 font-weight-normal">Faça o seu Cadastro</h1>
    <label class="sr-only">Nome</label>
    <input type="text" class="form-control mt-2" id="name" placeholder="Nome" name="name" autofocus>
    <label for="inputEmail" class="sr-only">Email</label>
    <input type="email" class="form-control mt-2" id="email" placeholder="Email" name="email">
    <label for="inputPassword" class="sr-only">Senha</label>
    <input type="password" id="senha" class="form-control mt-3" name="senha" placeholder="Senha">
    <label for="inputPassword" class="sr-only">Confirmação de Senha</label>
    <input type="password" id="confirmarsenha" class="form-control mt-3" name="confirmarsenha"
      placeholder="Confirmação de Senha">
    <label id="lbl-senha" class="text-danger"></label>
    </div>
    <button id="btn-login" class="btn btn-lg btn-primary btn-block" type="submit">Registrar</button>

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

  $('#senha').keyup((e) => {
    if(e.target.value !== $('#confirmarsenha').val())
    $("#lbl-senha").text("As senhas não coicidem");
     else {
      $("#lbl-senha").text("");

     }
  })
    
  $('#confirmarsenha').keyup((e) => {
    if(e.target.value !== $('#senha').val())
    $("#lbl-senha").text("As senhas não coicidem");
     else {
      $("#lbl-senha").text("");

     }
  })

  $('#form-register').submit(function(e)
 {
    e.preventDefault()
    var nome  = $('#name').val();
    var email = $('#email').val();
    var senha = $('#senha').val();
    var confirmasenha = $('#confirmarsenha').val();
    
    
    if(!nome)
    {
        $("#modal-text").text("Informe o Nome");
        $("#modal-login").modal()
        return 
    }

    if(!email)
    {
        $("#modal-text").text("Informe o E-mail");
        $("#modal-login").modal()
        return 
    }

    if(!senha || !confirmasenha)
    {
        $("#modal-text").text("Informe a Senha");
        $("#modal-login").modal()
        return
    }

    if(senha !== confirmasenha)
    {
        $("#modal-text").text("As senhas não são iguais.");
        $("#modal-login").modal()
        return
    }

    $.ajax({
        url: 'http://localhost/ecommerce/handleUser.php',
        method: 'GET',
        data: {id: 0, name:nome, email: email, role: "user",password: senha },
        dataType: 'json',
        success: function (data) {
        },
        error: function (response) {
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
       }
    })
 })   

  
</script>

<?php
// layout do rodapé
?>