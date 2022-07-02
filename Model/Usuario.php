<?php
class Usuario
{

  private $Id;
  private $Email;
  private $Password;
  private $Name;
  private $Role;

  public function __construct($id, $email, $password, $name, $role)
  {
    $this->Id = $id;
    $this->Email = $email;
    $this->Password = $password;
    $this->Name = $name;
    $this->Role = $role;
  }

  public function getId()
  {
    return $this->Id;
  }
  public function setId($id)
  {
    $this->Id = $id;
  }

  public function getEmail()
  {
    return $this->Email;
  }
  public function setEmail($email)
  {
    $this->Email = $email;
  }

  public function getPassword()
  {
    return $this->Password;
  }
  public function setPassword($password)
  {
    $this->Password = $password;
  }

  public function getName()
  {
    return $this->Name;
  }
  public function setName($name)
  {
    $this->Name = $name;
  }

  public function getRole()
  {
    return $this->Role;
  }
  public function setRole($role)
  {
    $this->Role = $role;
  }
}
