<?php
namespace Model;

use Config\Database;

class Base {

    public $db;

    /**
     * Construccion de modelos
     * 
     * @param object $db Conexion a la base de dato
     */
    public function __construct()
    {
        $this->db = Database::conectar();
    }
}