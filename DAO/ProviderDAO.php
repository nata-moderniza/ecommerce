<?php
interface ProviderDao
{

  public function Create($provider);
  public function UpdateById(&$provider);
  public function getById($id);
  public function getProviders();
  public function deleteProvider($id);
}
