<!DOCTYPE HTML>
<html lang=pt-br>

<head>
  <meta charset="UTF-8">
  <title>Teste</title>

  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link href="//fonts.googleapis.com/css?family=Open+Sans:400,300,600" rel="stylesheet" type="text/css">
  <link href="css/style.css" rel="stylesheet" type="text/css">


  <script src="https://code.jquery.com/jquery-3.1.1.min.js">
  < script src = "https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
  integrity = "sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
  crossorigin = "anonymous" >
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
  </script>


</head>

<body>
  <header>
    <div>
      <?php
            require "interface.php";
            include_once "version.php";
            if (is_session_started() === FALSE) {
                session_start();
            }

            echo " <ul class='top-admin-menu navbar-nav m-auto'>";

            if (isset($_SESSION["nome_usuario"])) {

                // Vai no banco verificar a permissão de Admin

                $dao = $factory->getUsuarioDao();
                $role = $dao->getRoleById($_SESSION["id_usuario"]);

                if($role == "admin")
                {
                    echo "<li class='top-admin-menu-item'>";
                    echo "<a href='products.php'>Produtos</a>";
                    echo "</li>";
                    echo "<li class='top-admin-menu-item'>";
                    echo "<a href='providers.php'>Fornecedores</a>";
                    echo "</li>";
                    // echo "<li class='top-admin-menu-item'>";
                    // echo "<a href='usuarios.php'>Pedidos</a>";
                    // echo "</li>";
                    echo "<li class='top-admin-menu-item'>";
                    echo "<a href='users.php'>Usuários</a>";
                    echo "</li>";
                }

                echo "<li class='top-admin-menu-item'>";
                echo "<a href='orders.php'>Pedidos</a>";
                echo "</li>";

            }
            echo "<ul/>";
            ?>
    </div>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
      <div class="container">
        <a class="navbar-brand" href="index.php">Ecommerce</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
          aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarsExampleDefault">
          <ul class="navbar-nav m-auto">
            <li class="nav-item active">
              <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="loopProducts.php">Produtos</a>
            </li>
          </ul>

          <form class="form-inline my-2 my-lg-0">
            <div class="input-group input-group-sm">
              <input id="text-filter-produto" type="text" class="form-control" placeholder="Pesquisar">
              <div class="input-group-append">
                <button onClick=searchProduct() type="button" class="btn btn-secondary btn-number">
                  <i class="fa fa-search"></i>
                </button>
              </div>
            </div>

            <?php 
    $total = 0;

    
              echo "<a class='btn btn-success btn-sm ml-3' href='cart.php'>";
              echo "<i class='fa fa-shopping-cart'></i> Carrinho";
              //echo "<span class='badge badge-light'>{$total}</span>";
              echo "</a>";
   
 ?>



            <?php
                        include_once 'version.php';

                        if (is_session_started() === FALSE) {
                            session_start();
                        }

                        if (isset($_SESSION["nome_usuario"])) {
                            // Informações de login
                            echo "<span>" . $_SESSION["nome_usuario"];
                            echo "<a href='handleLogout.php'> Sair </a></span>";
                        } else {
                            echo "<a class='btn btn-info btn-sm ml-3' href='login.php'>
                            <i class='fa fa-user'></i> Entrar
                                </a>";
                        }
                        ?>
          </form>
        </div>
      </div>
    </nav>


    <script>
    function searchProduct() {

      var pesquisa = $("#text-filter-produto").val();

      if (pesquisa)
        window.location.href = `http://localhost/ecommerce/loopProducts.php?name=${pesquisa}`;
      else
        window.location.href = `http://localhost/ecommerce/loopProducts.php`;


    }
    </script>

  </header>