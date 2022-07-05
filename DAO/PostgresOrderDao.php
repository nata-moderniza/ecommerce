<?php

include_once('OrderDAO.php');
include_once('PostgresDAO.php');


class PostgresOrderDao extends PostgresDAO implements OrderDao
{

  private $table_name = 'orders';

  public function Create($order)
  {
    
    $query = "INSERT INTO " . $this->table_name .
      " (id_user, name_user, street, zipcode, situation) VALUES" .
      " (:id_user, :name_user, :street, :zipcode, :situation )";

    $stmt = $this->conn->prepare($query);

    // bind values 
    $stmt->bindValue(":id_user", $order->getId_User());
    $stmt->bindValue(":name_user", $order->getName_User());
    $stmt->bindValue(":street", $order->getStreet());
    $stmt->bindValue(":zipcode", $order->getZipcode());
    $stmt->bindValue(":situation", $order->getSituation());

    if ($stmt->execute()) {
      return $this->conn->lastInsertId();
    } else {
      return false;
    }
  }

  public function GetOrders($name, $id_order, $id_user)
  {
    $orders = array();

    $query = "SELECT orders.id_order, orders.name_user, orders.street, 
    orders.zipcode, orders.situation, users.name as nome_cliente, 
    sum(order_item.price_total) as price_total FROM orders 
	  INNER JOIN users on users.id = orders.id_user 
	  INNER JOIN order_item  on order_item.id_order = orders.id_order";
    
     $needAnd= false;

      if(isset($name) || isset($id_order) || is_int($id_user))
      {
        $query = $query. " WHERE ";   
      }

      if(isset($name) && $name != '')
      {
        $query = $query. " orders.name_user like '%". $name. "%' ";
        $needAnd = true;
      }
   
      if(isset($id_order) && $id_order)
      {
        if($needAnd)
        {
          $query = $query. " AND orders.id_order = :id_order ";

        }
        else{
          $query = $query. " orders.id_order = :id_order ";

        }
      }

      if(is_int($id_user))
      {
        if($needAnd)
        {
          $query = $query. " AND orders.id_user = :id_user ";

        }
        else{
          $query = $query. " orders.id_user = :id_user ";

        }
      }

    $query = $query . " group by  orders.id_order, orders.name_user, orders.street, 
    orders.zipcode, orders.situation, users.name ";

    $stmt = $this->conn->prepare($query);
    

    if(isset($id_order) && $id_order)
     $stmt->bindValue(':id_order', $id_order);  

     if(is_int($id_user))
     $stmt->bindValue(':id_user', $id_user); 
   
    $stmt->execute();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      extract($row);
      $orders[] = $row;
    }

    return $orders;
  }

  public function GetOrdersByNumero($number)
  {
    $orders = array();

    $query = "SELECT orders.id_order, orders.name_user, orders.street, 
    orders.zipcode, orders.situation, users.name as nome_cliente, 
    sum(order_item.price_total) as price_total FROM orders 
	  INNER JOIN users on users.id = orders.id_user 
	  INNER JOIN order_item  on order_item.id_order = orders.id_order 
    group by  orders.id_order, orders.name_user, orders.street, 
    orders.zipcode, orders.situation, users.name";

    $stmt = $this->conn->prepare($query);
    $stmt->execute();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      extract($row);
      $orders[] = $row;
    }

    return $orders;
  }

  public function GetOrdersByName($name)
  {
    $orders = array();

    $query = "SELECT orders.id_order, orders.name_user, orders.street, 
    orders.zipcode, orders.situation, users.name as nome_cliente, 
    sum(order_item.price_total) as price_total FROM orders 
	  INNER JOIN users on users.id = orders.id_user 
	  INNER JOIN order_item  on order_item.id_order = orders.id_order
    WHERE orders.name_user like('%:name_user%') 
    group by  orders.id_order, orders.name_user, orders.street, 
    orders.zipcode, orders.situation, users.name";

    $stmt = $this->conn->prepare($query);
    $stmt->bindValue(":name_user", $name);
    $stmt->execute();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      extract($row);
      $orders[] = $row;
    }

    return $orders;
  }

}