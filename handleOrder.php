<?php
include_once "interface.php";

// Inicia sessão 
session_start();

$id_order = $_POST["id_pedido"];
$street = $_POST["endereco"];
$cep = $_POST["cep"];
$name_user = $_POST["nome"];
$id_user = $_SESSION["id_usuario"];
$itens = $_SESSION["carrinho"];

$order = new Order(0, $id_user, "Natã", "RUA A", "95043200", "1");


$dao = $factory->getOrderDao();
$daoItem = $factory->getOrderItemDao();
$daoStock = $factory->getProductStockDao();

$createOrder = $dao->Create($order);

    if($createOrder)
    {
      
       foreach($_SESSION["carrinho"] as $key => $value)
       {
         $item = new OrderItem($createOrder, $key, $value["quantidade"], $value["preco"],
         $value["quantidade"] * $value["preco"]); 
            
         // Se criar baixa o estoque 
         if($daoItem->Create($item))
         {
            $stock = $daoStock->getByProductId($key);
            
            if($stock)
            {
                var_dump($stock);

                $quantidadeAtual = $stock["quantity"] -  $value["quantidade"];

                $stockModel = new ProductStock($key , $quantidadeAtual, $value["preco"]);
                $daoStock->updateByProduct($stockModel);
            }
            
         }     
       }
          
       if(isset($_SESSION["carrinho"])) {
        unset($_SESSION["carrinho"]);
    }
    }

?>