<?php 
  ini_set('display_errors', 1);
  error_reporting(E_ALL);

  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: GET');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../model/Usuario.php';

  // Obten los datos enviados por la URL
  $data = $_GET;

  $usuario = new Usuario();

  // Asignar datos
  $usuario->setRolId( htmlspecialchars(strip_tags( $data['rol_id'] )) );
  $usuario->setNombre( htmlspecialchars(strip_tags( $data['nombre'] )) );
  $usuario->setCorreo( htmlspecialchars(strip_tags( $data['correo'] )) );
  $usuario->setFecha( date('Y-m-d H:m:s') );
  $usuario->setEstatus( 1 );

  // Crear usuario
  if($usuario->create()) {
    echo json_encode(
      array('message' => 'Usuario creado exitosamente!')
    );
  } else {
    echo json_encode(
      array('message' => 'Error al crear el usuario.')
    );
  }