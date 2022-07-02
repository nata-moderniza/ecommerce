<?php

include_once('ProductStockDAO.php');
include_once('PostgresDAO.php');


class PostgresProductStockDao extends PostgresDAO implements ProductStockDao
{

  private $table_name = 'product_stock';

  public function Create($productStock)
  {

    $query = "INSERT INTO " . $this->table_name .
      " (id_product, quantity, price) VALUES" .
      " (:id_product, :quantity, :price )";

    $stmt = $this->conn->prepare($query);

    // bind values 
    $stmt->bindValue(":id_product", $productStock->getIdProduct());
    $stmt->bindValue(":quantity", $productStock->getQuantity());
    $stmt->bindValue(":price", $productStock->getPrice());

    if ($stmt->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public function update($productStock)
  {
    $products = array();

    $query = "SELECT id_product, product.name, product.description, provider.id_provider, provider.name as NameProvider FROM
              " . $this->table_name ." INNER JOIN provider on provider.id_provider = product.id_provider".   
      " WHERE product.is_deleted = false ORDER BY product.id_product ASC";

    $stmt = $this->conn->prepare($query);
    $stmt->execute();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      extract($row);
      $products[] = $row;
    }

    return $products;
  }

  public  function updateByProduct($productStock)
  {
    
    $query = "UPDATE " . $this->table_name .
      " SET price = :price, quantity = :quantity" .
      " WHERE id_product = :id_product";

    $stmt = $this->conn->prepare($query);

    // bind parameters
    $stmt->bindValue(":price", $productStock->getPrice());
    $stmt->bindValue(":quantity", $productStock->getQuantity());
    $stmt->bindValue(':id_product', $productStock->getIdProduct());


    // execute the query
    if ($stmt->execute()) {
      return true;
    }

    return false;
  }
  
}
