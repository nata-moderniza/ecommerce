<?php
include_once "interface.php";

session_start();

$idProduct = isset($_POST["id"]) ? $_POST["id"] : null;
$nomeProduto = isset($_POST["nome"]) ? $_POST["nome"] : null; 
$preco = isset($_POST["preco"]) ? $_POST["preco"] : null; 

if(isset($idProduct))
{


   $daoProduct = $factory->getProductDao();
   $product =  $daoProduct->getById($idProduct);
     

   if(isset($_SESSION["carrinho"][$idProduct]))
   {

      if($_SESSION["carrinho"][$idProduct]["quantidade"]+1 > $product['quantity'])
      {
         echo "Code: 01";
         return;
      }

    $_SESSION["carrinho"][$idProduct]["quantidade"]++;
    echo "Code: 00";
   }
   else{

      if(1 > $product['quantity'])
      {
         echo "Code: 01";
         return;
      }

    $_SESSION["carrinho"][$idProduct] = array("quantidade" => 1, "nome" => $nomeProduto, "preco" => $preco);
    echo "Code: 00";

   }
   
}

?>