<?php
include_once "header.php";
include_once "checkLogin.php";
include_once "interface.php";
include_once "checkPermission.php";

$id = @$_GET["id"];

$usuario = null;

if ($id) {
    $dao = $factory->getUsuarioDao();
    $usuario = $dao->getById($id);
}


?>
<section>

    <div class="container mt-3">
        <div class="">
            <h5 class="card-title"> Usuário</h5>
            <form action="handleUser.php" method="get">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label>Nome</label>
                            <input type="text" name="name" class="form-control" value="<?php echo is_null($usuario) ? "" : $usuario->getName(); ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label>Email</label>
                            <input name="email" class="form-control" value="<?php echo is_null($usuario) ? "" : $usuario->getEmail(); ?>">
                        </div>
                    </div>
                </div>

                <?php 
                
                if(is_null($usuario))
                {
                   echo "<div class='row'>";
                   echo "<div class='col-sm-8'>";
                   echo "<div class='form-group'>";
                   echo "<label>Senha</label>";
                   echo "<input name='password' class='form-control' type='password'>";
                   echo "</div>";
                   echo "</div>";
                   echo "</div>";    
                }
               ?>

                <div class="row">
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label for="role">Função</label>
                            <select class="form-control" name="role">
                                <option value="customer" <?= (is_null($usuario) ? "" : $usuario->getRole() == 'customer') ? 'selected' : '' ?>>Cliente</option>
                                <option value="admin" <?= (is_null($usuario) ? "" : $usuario->getRole() == 'admin') ? 'selected' : '' ?>>Administrador</option>
                            </select>
                        </div>
                    </div>
                </div>
        </div>
        <input type='hidden' name='id' value='<?php echo is_null($usuario) ? 0 : $usuario->getId(); ?>' />
        <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
    </div>

    </div>

</section>
<?php
// layout do rodapé
?>