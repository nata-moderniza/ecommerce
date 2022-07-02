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

}