<?php
include_once "header.php";
include_once "checkLogin.php";
include_once "interface.php";
include_once "checkPermission.php";

$id = @$_GET["id"];

$daoProviders = $factory->getProviderDao();
$providers = $daoProviders->getProviders();

$product = null;

if ($id) {
    $daoProduct = $factory->getProductDao();
    $product =  $daoProduct->getById($id);
}

?>
<section>

  <style>
  input[type="file"] {
    display: none;
  }

  #lblimg {
    padding: 10px 10px;
    background-color: #333;
    color: #FFF;
    text-align: center;
    display: block;
    margin-top: 10px;
    cursor: pointer;
  }
  </style>

  <div class="container">
    <div class="row py-5">
      <div class="col-md-4 order-md-2 mb-4">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
          <span class="text-muted">Imagem</span>
        </h4>

        <img id="imgshow" class="img-fluid border-0" src=<?php echo is_null($product) ? "https://dummyimage.com/600x400/55595c/fff" : 
          "http://localhost/ecommerce". $product['path_imagem'];?> alt="Card image cap">

        <div class="form-group">
          <label onClick=teste() id="lblimg" for="exampleFormControlFile1">Selecionar Imagem</label>
          <input type="file" id="imgload" name="imgload" class="form-control-file" accept="image/png, image/jpeg">
        </div>

      </div>

      <div class="col-md-8 order-md-1">
        <h4 class="mb-3">Produto</h4>
        <form action="handleProduct.php" method="get">
          <div class="row">
            <div class="col mb-3">
              <label for="firstName">Nome</label>
              <input required type="text" name="name" class="form-control"
                value="<?php echo is_null($product) ? "" : $product['name']; ?>">
            </div>
          </div>

          <div class="mb-3">
            <label for="username">Descrição</label>
            <div class="input-group">
              <input name="description" class="form-control"
                value="<?php echo is_null($product) ? "" : $product['description']; ?>">
            </div>
          </div>

          <div class="mb-3">
            <label for="email">Fornecedor</label>
            <select class="form-control" name="provider">
              <option>Selecione</option>
              <?php
                                foreach ($providers as $provider) {
                                ?>
              <option value=<?=  $provider->getId();?>
                <?= (is_null($product) ? "" : $product['id_provider'] == $provider->getId()) ? 'selected' : '' ?>>
                <?php echo $provider->getName(); ?> </option>
              <?php
                                }
                                ?>
            </select>
          </div>
          <div class="mb-3">
            <label for="address">Preço</label>
            <input required name="price" class="form-control"
              value="<?php echo is_null($product) ? "" : $product['price']; ?>">
          </div>
          <div class="mb-3">
            <label for="address2">Estoque</label>
            <input required name="stock" class="form-control"
              value="<?php echo is_null($product) ? "" : $product['quantity']; ?>">
          </div>
          <input type='hidden' name="imagem" id="imagem"></input>
          <input type='hidden' name='id' value='<?php echo is_null($product) ? 0 : $product['id_product']; ?>' />
          <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
      </div>
    </div>
  </div>

</section>

<script type="text/javascript">
function teste() {
  $('#imgload').trigger('click');

}

$('document').ready(function() {


  $("#imgload").change(function() {
    if (this.files && this.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
        $('#imgshow').attr('src', e.target.result);
      }
      reader.readAsDataURL(this.files[0]);

      var form_data = new FormData();
      form_data.append('Arquivo', this.files[0]);
      $.ajax({
        url: 'http://localhost/ecommerce/handleUploadImage.php', // point to server-side controller method
        dataType: 'text', // what to expect back from the server
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
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
  });
});
</script>

<?php
// layout do rodapé
?>