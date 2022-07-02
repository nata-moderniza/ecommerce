<?php

include_once('UsuarioDao.php');
include_once('PostgresDAO.php');


class PostgresUsuarioDao extends PostgresDAO implements UsuarioDao
{

  private $table_name = 'users';

  public function Create($usuario)
  {

    $query = "INSERT INTO " . $this->table_name .
      " (email, name, password, role) VALUES" .
      " (:email, :name, :password, :role)";

    $stmt = $this->conn->prepare($query);

    // bind values 
    $stmt->bindValue(":email", $usuario->getEmail());
    $stmt->bindValue(":password", md5($usuario->getEmail() . $usuario->getPassword()));
    $stmt->bindValue(":name", $usuario->getName());
    $stmt->bindValue(":role", $usuario->getRole());


    if ($stmt->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public function removePorId($id)
  {
    $query = "DELETE FROM " . $this->table_name .
      " WHERE id = :id";

    $stmt = $this->conn->prepare($query);

    // bind parameters
    $stmt->bindParam(':id', $id);

    // execute the query
    if ($stmt->execute()) {
      return true;
    }

    return false;
  }


  public function UpdateById(&$usuario)
  {

    $query = "UPDATE " . $this->table_name .
      " SET email = :email, name = :name, role = :role" .
      " WHERE id = :id";

    $stmt = $this->conn->prepare($query);

    // bind parameters
    $stmt->bindValue(":email", $usuario->getEmail());
    $stmt->bindValue(":name", $usuario->getName());
    $stmt->bindValue(':role', $usuario->getRole());
    $stmt->bindValue(':id', $usuario->getId());


    // execute the query
    if ($stmt->execute()) {
      return true;
    }

    return false;
  }

  public function getById($id)
  {

    $usuario = null;

    $query = "SELECT
                    id, email, name, password, role
                FROM
                    " . $this->table_name . "
                WHERE
                    id = ?
                LIMIT
                    1 OFFSET 0";

    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $id);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($row) {
      $usuario = new Usuario($row['id'], $row['email'], $row['password'], $row['name'], $row['role']);
    }

    return $usuario;
  }

  public function getByLogin($email)
  {
    var_dump($email);

    $usuario = null;

    $query = "SELECT
                    id, email, name, password, role
                FROM
                    " . $this->table_name . "
                WHERE
                email = ?
                LIMIT
                    1 OFFSET 0";

    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $email);
    $stmt->execute();


    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
      $usuario = new Usuario($row['id'], $row['email'], $row['password'], $row['name'], $row['role']);
    }

    return $usuario;
  }

  public function getUsers()
  {
    $usuarios = array();

    $query = "SELECT
                    id, email, name, password, role
                FROM
                    " . $this->table_name .
      " ORDER BY id ASC";

    $stmt = $this->conn->prepare($query);
    $stmt->execute();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      extract($row);
      $usuarios[] = new Usuario($row['id'], $row['email'], $row['password'], $row['name'], $row['role']);
    }

    return $usuarios;
  }

  public function getRoleById($id)
  {

    $role = "consumer";

    $query = "SELECT
                    role
                FROM
                    " . $this->table_name . "
                WHERE
                    id = ?
                LIMIT
                    1 OFFSET 0";

    $stmt = $this->conn->prepare($query);
    $stmt->bindValue(1, $id);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row) {
      $role = $row['role'];
    }

    return $role;
  }
}
