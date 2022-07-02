<?php
class Provider
{

  private $Id_Provider;
  private $Name;
  private $Description;
  private $Phone;
  private $Email;


  public function __construct($Id_Provider, $Name,  $Description,  $Phone, $Email)
  {
    $this->Id_Provider = $Id_Provider;
    $this->Name = $Name;
    $this->Description = $Description;
    $this->Phone = $Phone;
    $this->Email = $Email;
  }
  

  public function getId()
  {
    return $this->Id_Provider;
  }
  public function setId($id)
  {
    $this->Id_Provider = $id;
  }

  public function getEmail()
  {
    return $this->Email;
  }
  public function setEmail($email)
  {
    $this->Email = $email;
  }

  public function getName()
  {
    return $this->Name;
  }
  public function setName($name)
  {
    $this->Name = $name;
  }

  public function getDescription()
  {
    return $this->Description;
  }
  public function setDescription($description)
  {
    $this->Description = $description;
  }

  public function getPhone()
  {
    return $this->Phone;
  }
  public function setPhone($phone)
  {
    $this->Phone = $phone;
  }
}
