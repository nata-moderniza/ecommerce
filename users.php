<?php
include_once "header.php";
include_once "checkLogin.php";
include_once "interface.php";
include_once "checkPermission.php"
?>
<section>

    <div class="container mt-3">

        <div class="">
            <h5 class="card-title"> Usuários</h5>
            <form method="get">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Nome</label>
                            <input type="text" name="name"  class="form-control" value="<?php echo isset($_REQUEST['name']) ? $_REQUEST['name'] : '' ?>">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Id</label>
                            <input  name="id" class="form-control" value="<?php echo isset($_REQUEST['id']) ? $_REQUEST['id'] : '' ?>">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label>&nbsp;</label>
                            <div>
                                <button type="submit" name="submit" value="search" id="submit" class="btn btn-primary"><i class="fa fa-fw fa-search"></i> Pesquisar</button>
                            </div>
                        </div>
                    </div>
                </div>
                
            </form>
        </div>

        <?php

        $dao = $factory->getUsuarioDao();
        $usuarios = $dao->getUsers();

        // display the products if there are any

        echo "<table class='table table-striped table-bordered'>";
        echo "<thead>";
        echo "<tr class='bg-primary text-white'>";
        echo "    <th>Id</th>";
        echo "    <th>Nome</th>";
        echo "    <th>Email</th>";
        echo "    <th>Role</th>";
        echo "    <th>Ações</th>";
        echo "</tr>";
        echo "</thead>";

        echo "<tbody>";
        foreach ($usuarios as $usuario) {

            echo "<tr>";
                echo "<td>{$usuario->getId()}</td>";
                echo "<td>{$usuario->getName()}</td>";
                echo "<td>{$usuario->getEmail()}</td>";
                echo "<td>{$usuario->getRole()}</td>";
                echo "<td align='center'>";
                echo "<a href='usersAdd.php?id={$usuario->getId()}' class='text-primary'><i class='fa fa-fw fa-edit'></i> Editar</a>"; 
                echo "<a href='modifica_usuario.php?id={$usuario->getId()}' class='text-danger' ><i class='fa fa-fw fa-trash'></i> Deletar</a>";
            echo "</td>";
            echo "</tr>";
        }

        echo "</tbody>";

        echo "</table>";

        echo "<a href='usersAdd.php' class='btn btn-primary left-margin'>";
        echo "Novo";
        echo "</a>";


        ?>
    </div>

</section>
<?php
// layout do rodapé
?>