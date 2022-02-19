<?php 

include_once(dirname(__DIR__) . '/model/X_Cita.php');

class Cita extends X_Cita {

  /**
   * Crea una instancia con los datos 
   * de una cita en especifico o en blanco
   * 
   * @param string $correlativo Correlatiivo de la cita
   * 
   * @return Cita Instancia de la cita
   */
  public function __construct(string $correlativo = '')
  {
    parent::__construct();

    if(!empty($correlativo))
      $this->read($correlativo);

    return $this;
  }

  /** 
   * Busca los datos de una cita 
   * por su correlativo
   * 
   * @param int $correlativo Correlativo de la cita
   * 
   * @return boolean|Cita Falso si la cita no existe
   */
  public function read(string $correlativo) {
    // Crear query
    $stmt = $this->db->prepare("SELECT * FROM {$this->_table} WHERE correlativo = :correlativo");

    // Asignar valores
    $stmt->bindParam(':correlativo', $correlativo);
    
    // Ejecutar query
    $stmt->execute();

    if($cita = $stmt->fetch()) {
      $this->setCitaId($cita['cita_id']);
      $this->setPacienteId($cita['paciente_id']);
      $this->setResponsableId($cita['responsable_id']);
      $this->setCorrelativo($cita['correlativo']);
      $this->setFecha($cita['fecha']);
      $this->setEstatus($cita['estatus']);

      return $this;
    }

    return false;
  }

  /** 
   * Busca los datos de todas las citas
   * agendadas con un responsable
   * 
   * @param int $responsable_id Identificador del responsable
   * 
   * @return boolean|Cita[] Falso si el responsable no tiene citas
   */
  public function readAll(int $responsable_id) {
    // Crear query
    $stmt = $this->db->prepare("SELECT * FROM {$this->_table} WHERE responsable_id = :responsable_id");

    // Asignar valores
    $stmt->bindParam(':responsable_id', $responsable_id);
    
    // Ejecutar query
    $stmt->execute();

    $citas = [];
    while ($cita = $stmt->fetch()) {
      array_push($citas, new self($cita['correlativo']));
    }

    return $citas;
  }

  /**
   * Agendar cita con los datos suministrados 
   * a traves del API
   * 
   * @return boolean Falso si la cita no se agenda correctamente
   */
  public function create() {
    // Crear Query
    $stmt = $this->db->prepare("INSERT INTO {$this->_table} (paciente_id, responsable_id, correlativo, fecha, estatus) VALUES (:paciente_id, :responsable_id, :correlativo, :fecha, :estatus)");

    // Obtener datos
    $paciente       = $this->getPacienteId();
    $responsable    = $this->getResponsableId();
    $correlativo    = $this->getCorrelativo();
    $fecha          = $this->getFecha();
    $estatus        = $this->getEstatus();

    // Ingresa los valores
    $stmt->bindParam(':paciente_id', $paciente);
    $stmt->bindParam(':responsable_id', $responsable);
    $stmt->bindParam(':correlativo', $correlativo);
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

  /**
   * Obtiene la cantidad de citas agendadas
   * 
   * @return int Cantidad de citas
   */
  public function max() {
    $stmt = $this->db->prepare("SELECT COUNT(*) FROM {$this->_table}");
    $stmt->execute();
    return $stmt->fetchColumn();
  }

  /**
   * Actualiza el estatus de una cita
   * 
   * @return boolean Falso si no se actualizo la cita
   */
  public function update() {
    // Crear Query
    $stmt = $this->db->prepare("UPDATE {$this->_table} SET estatus = :estatus WHERE correlativo = :correlativo");

    // Obtener datos
    $estatus = $this->getEstatus();
    $correlativo = $this->getCorrelativo();

    // Ingresa los valores
    $stmt->bindParam(':estatus', $estatus);
    $stmt->bindParam(':correlativo', $correlativo);

    // Execute query
    if($stmt->execute()) {
      return true;
    }

    // Print error if something goes wrong
    printf("Error: %s.\n", $stmt->error);

    return false;
  }
}