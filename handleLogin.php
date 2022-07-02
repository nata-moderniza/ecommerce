<?php 
// Métodos de acesso ao banco de dados 
require "interface.php"; 

// Inicia sessão 
session_start();

// Recupera o login 
$login = isset($_POST["email"]) ? addslashes(trim($_POST["email"])) : FALSE; 
$senha = isset($_POST["senha"]) ? trim($_POST["senha"]) : FALSE; 
 
// Usuário não forneceu a senha ou o login 
if(!$login || !$senha) 
{ 
    echo "login = " . $login . " / senha = " . $senha . "<br>";
    echo "Você deve digitar sua senha e login!<br>"; 
    echo "<a href='login.php'>Efetuar Login</a>";
    exit; 
}  

$dao = $factory->getUsuarioDao();   
$usuario = $dao->getByLogin($login);


$senhaMontada = md5($login.$senha);

$problemas = FALSE;
if($usuario) {
    // Agora verifica a senha 
    if(!strcmp($senhaMontada, $usuario->getPassword())) 
    { 
        // TUDO OK! Agora, passa os dados para a sessão e redireciona o usuário 
        $_SESSION["id_usuario"]= $usuario->getId(); 
        $_SESSION["nome_usuario"] = stripslashes($usuario->getName());

        $age = array("Peter"=>35, "Ben"=>37, "Joe"=>43);

        echo json_encode(['code'=>200, 'msg'=>'Teste']); 
         
         
        exit; 
    } else {
        echo json_encode('Login com erro'); 

        $problemas = TRUE; 
    }
} else {
    echo json_encode('Login com erro'); 
    $problemas = TRUE; 
}

if($problemas==TRUE) {
     
    exit; 
}
?>
