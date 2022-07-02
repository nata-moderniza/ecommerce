<?php 

include_once "version.php";
		

// Verifica se existe os dados da sessão de login 
if(!isset($_SESSION["id_usuario"]) || !isset($_SESSION["nome_usuario"])) 
{ 
    require "interface.php";

    error_log("SEM USUÀRIO LOGADO - Vai para login.php");
    header("Location: login.php"); 
    exit; 
} 
else {
    $dao = $factory->getUsuarioDao();
    $role = $dao->getRoleById($_SESSION["id_usuario"]);

    if($role != "admin")
    {
        error_log("SEM USUÀRIO LOGADO - Vai para login.php");
        header("Location: login.php");
        exit;
    }

}
?>