<?php
  require_once('Database.class.php');

  class Client {

    public static function create_client($email, $name, $city, $telephone) {
      $database = new Database();
      $conn = $database->getConnection();

      $query = $conn -> prepare('INSERT INTO cliente (email, name, city, telephone)
        VALUES (:email, :name, :city, :telephone);');
      $query->bindParam(':email', $email);
      $query->bindParam(':name', $name);
      $query->bindParam(':city', $city);
      $query->bindParam(':telephone', $telephone);

      if($query->execute()) {
        header('HTTP/1.1 201 Cliente creado correctamente.');
      } else {
        header('HTTP/1.1 404 Cliente no se ha creado correctamente.');
      }

    }

    public static function delete_client($id) {
      $database = new Database();
      $conn = $database->getConnection();

      $query = $conn -> prepare('DELETE FROM cliente WHERE id=:id');
      $query->bindParam(':id', $id);

      if($query->execute()) {
        header('HTTP/1.1 201 Cliente borrado correctamente.');
      } else {
        header('HTTP/1.1 404 Cliente no se ha borrar correctamente.');
      }
   
    }

    public static function get_all_client() {
      $database = new Database();
      $conn = $database->getConnection();

      $query = $conn -> prepare('SELECT * FROM cliente');

      if($query->execute()) {
        $result = $query->fetchAll();
        echo json_encode($result);
        header('HTTP/1.1 201 OK');
      } else {
        header('HTTP/1.1 404 Cliente no se ha consultar los clientes.');
      }
   
    }

    public static function update_client($id, $email, $name, $city, $telephone) {
      $database = new Database();
      $conn = $database->getConnection();

      $query = $conn -> prepare('UPDATE cliente SET email=:email, name=:name, city=:city, telephone=:telephone WHERE id=:id');      
      $query->bindParam(':id', $id);
      $query->bindParam(':email', $email);
      $query->bindParam(':name', $name);
      $query->bindParam(':city', $city);
      $query->bindParam(':telephone', $telephone);

      if($query->execute()) {
        header('HTTP/1.1 201 Cliente actualizado correctamente.');
      } else {
        header('HTTP/1.1 404 Cliente no se ha actualizado correctamente.');
      }
    }

  }
?>