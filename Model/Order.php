<?php
class Order
{

  private $Id_Order;
  private $Id_User;
  private $Name_User;
  private $Street;
  private $Zipcode;
  private $Situation;


  public function __construct($Id_Order, $Id_User, $Name_User,$Street,$Zipcode,$Situation)
  {   

    $this->Id_Order = $Id_Order;
    $this->Id_User = $Id_User;
    $this->Name_User = $Name_User;
    $this->Street= $Street;
    $this->Zipcode = $Zipcode;
    $this->Situation = $Situation;

  }
  
  public function getId_Order()
  {
    return $this->Id_Order;
  }
  public function setId_Order($id)
  {
    $this->Id_Order = $id;
  }

  public function getId_User()
  {
    return $this->Id_User;
  }
  public function setId_User($id)
  {
    $this->Id_User = $id;
  }

  public function getName_User()
  {
    return $this->Name_User;
  }
  public function setName_User($name)
  {
    $this->Name_User = $name;
  }

  public function getStreet()
  {
    return $this->Street;
  }
  public function setStreet($street)
  {
    $this->Street = $street;
  }

  public function getZipcode()
  {
    return $this->Zipcode;
  }
  public function setZipcode($cep)
  {
    $this->Zipcode = $cep;
  }

  public function getSituation()
  {
    return $this->Situation;
  }
  public function setSituation($situation)
  {
    $this->Situation = $situation;
  }

}