<?php
interface ProductDao
{

  public function Create($product);
  public function getProducts();
  public function getById($idProduct);
  public function updateById($product);
  public function getProductsLoop($name);

}