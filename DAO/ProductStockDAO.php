<?php
interface ProductStockDao
{

  public function create($productStock);
  public function update($productStock);
  public function updateByProduct($productStock);
  public function getByProductId($productId);

}