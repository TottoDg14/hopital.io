<?php 
  ini_set('display_errors', 1);
  error_reporting(E_ALL);

  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: GET');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../model/Cita.php';
  include_once '../../model/Usuario.php';

  // Obten los datos enviados por la URL
  $data = $_GET;

  $cita = new Cita( $data['correlativo'] );
  $responsable = new Usuario( $data['responsable'] );

  if($responsable->getRolId() !== 1) {
    echo json_encode(
      array('message' => 'Usted no tiene posee permisos para esta accion')
    );
    return;
  }

  if($cita->getResponsableId() !== $responsable->getUsuarioId()) {
    echo json_encode(
      array('message' => 'Esta cita no esta en su agenda')
    );
    return;
  }

  // Asignar datos
  $cita->setEstatus( $data['estatus'] );

  $estatus = $cita->getEstatus() == 0 ? 'Cancelada' : 'Aprobada';

  // Actualizar cita
  if($cita->update()) {
    echo json_encode(
      array('message' => 'Cita '. $cita->getCorrelativo() .' '. $estatus)
    );
  } else {
    echo json_encode(
      array('message' => 'No se ha actualizado la cita')
    );
  }