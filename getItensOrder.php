<?php 
// Métodos de acesso ao banco de dados 
require "interface.php"; 

// Recupera o login 
$idPedido = isset($_POST["id_pedido"]) ? $_POST["id_pedido"]: FALSE; 

$dao = $factory->getOrderItemDao();   
$itens = $dao->GetItensByOrder($idPedido);

echo json_encode($itens)
?>