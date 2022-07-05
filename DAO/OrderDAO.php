<?php
interface OrderDao
{

  public function Create($order);
  public function GetOrders($name, $id_order, $id_user);
  public function GetOrdersByName($name);
  public function GetOrdersByNumero($number);

}