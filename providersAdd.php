<?php
include_once "header.php";
include_once "checkLogin.php";
include_once "interface.php";
include_once "checkPermission.php";

$id = @$_GET["id"];

$provider = null;

if ($id) {
    $dao = $factory->getProviderDao();
    $provider = $dao->getById($id);
}
?>
<section>

    <div class="container mt-3">
        <div class="">
            <h5 class="card-title"> Fornecedor</h5>
            <form action="handleProvider.php" method="get">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label>Nome</label>
                            <input type="text" name="name" class="form-control" value="<?php echo is_null($provider) ? "" : $provider->getName(); ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label>Email</label>
                            <input name="email" class="form-control" value="<?php echo is_null($provider) ? "" : $provider->getEmail(); ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label>Descrição</label>
                            <input name="description" class="form-control" value="<?php echo is_null($provider) ? "" : $provider->getDescription(); ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label>Telefone</label>
                            <input name="phone" class="form-control" value="<?php echo is_null($provider) ? "" : $provider->getPhone(); ?>">
                        </div>
                    </div>
                </div>
        </div>
        <input type='hidden' name='id' value='<?php echo is_null($provider) ? 0 : $provider->getId(); ?>' />
        <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
    </div>

    </div>

</section>
<?php
// layout do rodapé
?>