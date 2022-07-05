<?php
require "interface.php"; 
include_once "version.php";
session_start();

header('Content-Type: application/json');

$name = isset($_POST["name_order"]) ? $_POST["name_order"] : null;
$id_order = isset($_POST["id_order"]) ? $_POST["id_order"] : null; 
$id_user = null;

$daoUser = $factory->getUsuarioDao();

$role = $daoUser->getRoleById($_SESSION["id_usuario"]);

//Tem que trazer os pedidos só do usuario
if($role != "admin")
{
  $id_user = $_SESSION["id_usuario"];
}

$dao = $factory->getOrderDao();
$orders = $dao->getOrders($name, $id_order,$id_user);

$response = array("pedidos"=>$orders, "role"=>$role);

$response = json_encode($response); 

echo $response

?>