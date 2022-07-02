<?php

include_once('DaoFactory.php');
include_once('PostgresUsuarioDao.php');
include_once('PostgresProviderDao.php');
include_once('PostgresProductDao.php');
include_once('PostgresProductStockDao.php');



class PostgresDaofactory extends DaoFactory
{

  // specify your own database credentials
  private $host = "localhost";
  private $db_name = "Ecommerce";
  private $port = "5432";
  private $username = "postgres";
  private $password = "postgres";
  public $conn;

  // get the database connection
  public function getConnection()
  {

    $this->conn = null;

    try {
      $this->conn = new PDO("pgsql:host=" . $this->host . ";port=" . $this->port . ";dbname=" . $this->db_name, $this->username, $this->password);
    } catch (PDOException $exception) {
      echo "Connection error: " . $exception->getMessage();
    }
    return $this->conn;
  }

  public function getUsuarioDao()
  {

    return new PostgresUsuarioDao($this->getConnection());
  }

  public function getProviderDao()
  {

    return new PostgresProviderDao($this->getConnection());
  }

  public function getProductDao()
  {

    return new PostgresProductDao($this->getConnection());
  }

  public function getProductStockDao()
  {

    return new PostgresProductStockDao($this->getConnection());
  }

}
