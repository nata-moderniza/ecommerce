<?php
include_once "interface.php";

session_start();

$idProduct = isset($_POST["id"]) ? $_POST["id"] : null; 


if(isset($idProduct))
{
   if(isset($_SESSION["carrinho"][$idProduct]))
   {
    $_SESSION["carrinho"][$idProduct]["quantidade"]++;
   }
   else{
    $_SESSION["carrinho"][$idProduct] = array("quantidade" => 1, "nome" => "teste", "preco" => 52);
   }
   
}

echo json_encode($idProduct);
?>