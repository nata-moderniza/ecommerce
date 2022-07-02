<?php
include_once "interface.php";

$id = @$_GET["id"];
$name = @$_GET["name"];
$email = @$_GET["email"];
$description = @$_GET["description"];
$phone  = @$_GET["phone"];

$provider= new Provider($id,$name,$description, $phone, $email);

$dao = $factory->getProviderDao();

if(intval($id) == 0)
{
$dao->Create($provider);
}
else
{
 $dao->UpdateById($usuario);
}

header("Location: providers.php");
exit;

?>