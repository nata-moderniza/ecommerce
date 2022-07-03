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

  public function GetItensByOrder($orderId)
  {
    $ordersItem = array();

    $query = "select order_item.id_order, orders.name_user, orders.street, order_item.id_product, product.name, order_item.quantity,
    order_item.price_unit, order_item.price_total, product.path_imagem from order_item
    INNER JOIN product on product.id_product = order_item.id_product
    INNER JOIN orders on orders.id_order = order_item.id_order 
    where order_item.id_order = :id_order";

    $stmt = $this->conn->prepare($query);
    $stmt->bindValue(":id_order", $orderId);
    $stmt->execute();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      extract($row);
      $ordersItem[] = $row;
    }

    return $ordersItem;
  }

}