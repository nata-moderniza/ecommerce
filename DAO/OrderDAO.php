<?php
interface OrderDao
{

  public function Create($order);
  public function GetOrders($name, $id_order);
  public function GetOrdersByName($name);
  public function GetOrdersByNumero($number);

}