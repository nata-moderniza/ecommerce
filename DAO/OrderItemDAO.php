<?php
interface OrderItemDao
{

  public function Create($orderItem);
  public function GetItensByOrder($idOrder);

}