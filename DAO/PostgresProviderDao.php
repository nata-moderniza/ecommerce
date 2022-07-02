<?php

include_once('ProviderDAO.php');
include_once('PostgresDAO.php');


class PostgresProviderDao extends PostgresDAO implements ProviderDAO
{

  private $table_name = 'provider';

  public function Create($provider)
  {

    $query = "INSERT INTO " . $this->table_name .
      " (name, description, phone, email) VALUES" .
      " (:name, :description, :phone, :email)";

    $stmt = $this->conn->prepare($query);

    // bind values 
    $stmt->bindValue(":name", $provider->getName());
    $stmt->bindValue(":description", $provider->getDescription());
    $stmt->bindValue(":phone", $provider->getPhone());
    $stmt->bindValue(":email", $provider->getEmail());

    if ($stmt->execute()) {
      return true;
    } else {
      return false;
    }
  }


  public function UpdateById(&$provider)
  {

    $query = "UPDATE " . $this->table_name .
      " SET email = :email, name = :name, role = :role" .
      " WHERE id = :id";

    $stmt = $this->conn->prepare($query);

    // bind parameters
    $stmt->bindValue(":email", $provider->getEmail());
    $stmt->bindValue(":name", $provider->getName());
    $stmt->bindValue(':role', $provider->getRole());
    $stmt->bindValue(':id', $provider->getId());


    // execute the query
    if ($stmt->execute()) {
      return true;
    }

    return false;
  }

  public function getById($id)
  {

    $provider = null;

    $query = "SELECT
                    id_provider, email, name, description, phone
                FROM
                    " . $this->table_name . "
                WHERE
                id_provider = ? and is_deleted = false
                LIMIT
                    1 OFFSET 0";

    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $id);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
      $provider = new Provider($row['id_provider'], $row['name'], $row['description'], $row['phone'], $row['email']);
    }


    return $provider;
  }

  public function getProviders()
  {
    $providers = array();

    $query = "SELECT
                    id_provider, name, email, phone, description
                FROM
                    " . $this->table_name .
      " WHERE is_deleted = false ORDER BY id_provider ASC";

    $stmt = $this->conn->prepare($query);
    $stmt->execute();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      extract($row);
      $providers[] = new Provider($row['id_provider'], $row['name'], $row['description'], $row['phone'], $row['email']);
    }

    return $providers;
  }

  public function deleteProvider($id)
  {
    $query = "UPDATE " . $this->table_name .
      " SET is_deleted = true" .
      " WHERE id_provider = :id";

    $stmt = $this->conn->prepare($query);

    // bind parameters
    $stmt->bindValue(':id', $id);

    // execute the query
    if ($stmt->execute()) {
      return true;
    }

    return false;
  }
}
