<?php

require "interface.php"; 


$request_method=$_SERVER["REQUEST_METHOD"];
	
switch($request_method)
 {
 case 'GET':
  
      // Busca todos os pedidos
      if(!empty($_GET["id"]))
      {
          $id=intval($_GET["id"]);
  
          $dao = $factory->getOrderDao();
          $orders = $dao->getOrders(null, $id);

          if(count($orders) > 0)
          {
            echo json_encode($orders);
            http_response_code(200); 
          }
          else{
            
            echo json_encode(array("Mensagem"=> "Nenhum pedido encontrado."));
            http_response_code(200); 
          }
      }
      else if (!empty($_GET["name"]))
      {

        $name= $_GET["name"];
        
        $dao = $factory->getOrderDao();
        $orders = $dao->getOrders($name, null);

        if(count($orders) > 0)
        {
          echo json_encode($orders);
          http_response_code(200); 
        }
        else{
          
          echo json_encode(array("Mensagem"=> "Nenhum pedido encontrado."));
          http_response_code(200); 
        }
      }
      else
      {
        $dao = $factory->getOrderDao();
        $orders = $dao->getOrders(null, null);

        if(count($orders) > 0)
        {
          echo json_encode($orders);
          http_response_code(200); 
        }
        else{
          
          echo json_encode(array("Mensagem"=> "Nenhum pedido encontrado."));
          http_response_code(200); 
        }
      }  

    break;
 default:
    // Invalid Request Method
    http_response_code(405); // 405 Method Not Allowed
    break;
 }