<?php
interface UsuarioDao
{

  public function Create($usuario);
  //public function remove($usuario);
  public function removePorId($id);
  public function UpdateById(&$usuario);
  public function getById($id);
  public function getByLogin($email);
  public function getUsers();
  public function getRoleById($id);

}
