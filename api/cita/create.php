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
  $paciente = new Usuario( $data['paciente'] );
  $responsable = new Usuario( $data['responsable'] );

  $nro = $cita->max() + 10000;

  // Asignar datos
  $cita->setPacienteId( htmlspecialchars(strip_tags( $paciente->getUsuarioId())) );
  $cita->setResponsableId( htmlspecialchars(strip_tags( $responsable->getUsuarioId() )) );
  $cita->setCorrelativo('NC' . $nro);
  $cita->setFecha( htmlspecialchars(strip_tags( $data['fecha'] )) );
  $cita->setEstatus( 1 );

  // Crear cita
  if($cita->create()) {
    echo json_encode(
      array('message' => 'Cita '. $cita->getCorrelativo() .' agendada exitosamente!')
    );
  } else {
    echo json_encode(
      array('message' => 'Error al agendar la cita.')
    );
  }