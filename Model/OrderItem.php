<?php
class OrderItem
{

  private $Id_Order;
  private $Id_Order_Item;
  private $Quantity;
  private $Price_Unit;
  private $Price_Total;
  private $Id_Product;


  public function __construct($Id_Order, $Id_Product, $Quantity, $Price_Unit, $Price_Total)
  {
    $this->Id_Order = $Id_Order;
    $this->Id_Product = $Id_Product;
    $this->Quantity = $Quantity;
    $this->Price_Unit = $Price_Unit;
    $this->Price_Total = $Price_Total;

  }
  
  public function getIdOrder()
  {
    return $this->Id_Order;
  }
  public function setIdOrder($id)
  {
    $this->Id_Order = $id;
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

  public function getPriceUnit()
  {
    return $this->Price_Unit;
  }
  public function setPriceUnit($price)
  {
    $this->Price_Unit = $price;
  }

  public function getPriceTotal()
  {
    return $this->Price_Total;
  }
  public function setPriceTotal($price)
  {
    $this->Price_Total = $price;
  }


}