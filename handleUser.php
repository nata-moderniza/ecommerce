<?php
include_once "interface.php";

$id = @$_GET["id"];
$name = @$_GET["name"];
$email = @$_GET["email"];
$role = @$_GET["role"];
$password  = @$_GET["password"];

$usuario = new Usuario($id,$email,$password,$name, $role);

$dao = $factory->getUsuarioDao();

if(intval($id) == 0)
{
$dao->Create($usuario);
}
else
{
 $dao->UpdateById($usuario);
}

header("Location: users.php");
exit;

?>