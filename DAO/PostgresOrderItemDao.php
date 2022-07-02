<?php

include_once('OrderItemDAO.php');
include_once('PostgresDAO.php');


class PostgresOrderItemDao extends PostgresDAO implements OrderItemDAO
{

  private $table_name = 'order_item';

  public function Create($orderItem)
  {
    
    $query = "INSERT INTO " . $this->table_name .
      " (id_order, id_product, price_unit, price_total, quantity) VALUES" .
      " (:id_order, :id_product, :price_unit, :price_total, :quantity )";

    $stmt = $this->conn->prepare($query);

    // bind values 
    $stmt->bindValue(":id_product", $orderItem->getIdProduct());
    $stmt->bindValue(":id_order", $orderItem->getIdOrder());
    $stmt->bindValue(":price_unit", $orderItem->getPriceUnit());
    $stmt->bindValue(":price_total", $orderItem->getPriceTotal());
    $stmt->bindValue(":quantity", $orderItem->getQuantity());

    
    if ($stmt->execute()) {
      return $this->conn->lastInsertId();
    } else {
      return false;
    }
  }

}