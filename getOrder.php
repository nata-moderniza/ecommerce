<?php
require "interface.php"; 

header('Content-Type: application/json');

$name = isset($_POST["name_order"]) ? $_POST["name_order"] : null;
$id_order = isset($_POST["id_order"]) ? $_POST["id_order"] : null; 

$dao = $factory->getOrderDao();
$orders = $dao->getOrders($name, $id_order);

$orders = json_encode($orders);
echo $orders;

?>