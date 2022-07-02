<?php
include_once "interface.php";

$id = @$_GET["id"];

$dao = $factory->getProviderDao();

var_dump($id);

if(intval($id) > 0)
{
$dao->deleteProvider($id);
}

header("Location: providers.php");
exit;

?>