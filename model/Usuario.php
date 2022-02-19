<?php 

include_once(dirname(__DIR__) . '/model/X_Usuario.php');

class Usuario extends X_Usuario {

  /**
   * Crea una instancia con los datos 
   * de un usuario en especifico o en blanco
   * 
   * @param string $correo Correo del usuario
   * 
   * @return Usuario Instancia del Usuario
   */
  public function __construct(string $correo = '')
  {
    parent::__construct();

    if(!empty($correo))
      $this->read($correo);

    return $this;
  }

  /** 
   * Busca los datos de un usuario 
   * por su correo 
   * 
   * @param int $correo Correo del usuario
   * 
   * @return boolean|Usuario Falso si el usuario no existe
   */
  public function read(string $correo) {
    // Crear query
    $stmt = $this->db->prepare("SELECT * FROM {$this->_table} WHERE correo = :correo");

    // Asignar valores
    $stmt->bindParam(':correo', $correo);
    
    // Ejecutar query
    $stmt->execute();

    if($usuario = $stmt->fetch()) {
      $this->setUsuarioId($usuario['usuario_id']);
      $this->setRolId($usuario['rol_id']);
      $this->setNombre($usuario['nombre']);
      $this->setCorreo($usuario['correo']);
      $this->setFecha($usuario['fecha']);
      $this->setEstatus($usuario['estatus']);

      return $this;
    }

    return false;
  }

  /**
   * Crear usuario con los datos suministrados 
   * a traves del API
   * 
   * @return boolean Falso si el usuario no se crea
   */
  public function create() {
    // Crear Query
    $stmt = $this->db->prepare("INSERT INTO ". $this->_table ." (rol_id, nombre, correo, fecha, estatus) VALUES (:rol_id, :nombre, :correo, :fecha, :estatus)");

    // Obtener datos
    $rol    = $this->getRolId();
    $nombre = $this->getNombre();
    $correo = $this->getCorreo();
    $fecha  = $this->getFecha();
    $estatus= $this->getEstatus();

    // Ingresa los valores
    $stmt->bindParam(':rol_id', $rol);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':correo', $correo);
    $stmt->bindParam(':fecha', $fecha);
    $stmt->bindParam(':estatus', $estatus);

    // Ejecutar query
    if($stmt->execute()) {
      return true;
    }

    // Imprimir error
    printf("Error: %s.\n", $stmt->error);

    return false;
  }
}