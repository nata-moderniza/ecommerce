<?php
class ProductStock
{

  private $Id_Product_Stock;
  private $Id_Product;
  private $Quantity;
  private $Price;

  public function __construct($Id_Product, $Quantity, $Price)
  {
    $this->Id_Product = $Id_Product;
    $this->Quantity = $Quantity;
    $this->Price = $Price;

  }
  
  public function getIdProduct()
  {
    return $this->Id_Product;
  }
  public function setIdProduct($id)
  {
    $this->Id_Product = $id;
  }

  public function getQuantity()
  {
    return $this->Quantity;
  }
  public function setQuantity($quantity)
  {
    $this->Id_Product = $quantity;
  }

  public function getPrice()
  {
    return $this->Price;
  }
  public function setPrice($price)
  {
    $this->Price = $price;
  }


}
