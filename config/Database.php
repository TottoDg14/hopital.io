<?php 

namespace Config;

use PDO;
use PDOException;

class Database {

  // Conexion a Base de Datos
  public static function conectar() {
    $connection = null;

    try { 
      $connection = new PDO('mysql:host=localhost;dbname=hospital', 'hospital', '*H05p1t4l*');
      $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
      echo 'Connection Error: ' . $e->getMessage();
    }

    return $connection;
  }
}