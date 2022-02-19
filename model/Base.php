<?php

include_once(dirname(__DIR__) . '/config/Database.php');

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