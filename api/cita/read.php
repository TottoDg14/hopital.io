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

  $cita = new Cita();
  $responsable = new Usuario( $data['responsable'] );

  if($responsable->getRolId() !== 1) {
    echo json_encode(
      array('message' => 'Usted no tiene posee permisos para esta accion')
    );
    return;
  }

  $citas = $cita->readAll($responsable->getUsuarioId());

  // Armar datos
  $lista = [];
  foreach ($citas as $_cita) {
    
    if ($_cita->getEstatus() <> 1) {
      $estatus = $_cita->getEstatus() == 0 ? 'Cancelada' : 'Aprobada';
    } else {
      $estatus = 'Sin Confirmar';
    }

    array_push($lista, [
      'correlativo' => $_cita->getCorrelativo(),
      'fecha' => $_cita->getFecha(),
      'estatus' => $estatus
    ]);
  }

  // Crear cita
  if(count($lista) > 0) {
    echo json_encode(
      array('citas' => $lista)
    );
  } else {
    echo json_encode(
      array('message' => 'No posee citas agendadas.')
    );
  }