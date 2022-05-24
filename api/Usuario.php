<?php

namespace Api;

use Model\Usuario as ModelUsuario;

class Usuario 
{
    public $_msg;

    public function create()
    {
        $correo = isset($_GET['correo']) ? $_GET['correo'] : "" ;
        if ( !$this->verifyCorreo($correo) ) {
            echo $this->_msg; 
            return;
        }

        $nombre = isset($_GET['nombre']) ? $_GET['nombre'] : 'Dr. Anonimo ' . date('YmdHis') ;
        $rol_id = isset($_GET['rol_id']) ? $_GET['rol_id'] : 1 ;

        $usuario = new ModelUsuario();
        $usuario->setRolId( $rol_id );
        $usuario->setNombre( $nombre );
        $usuario->setCorreo( $correo );
        $usuario->setFecha( date('Y-m-d H:m:s') );
        $usuario->setEstatus( 1 );

        if( $usuario->create())
            echo json_encode( array('message' => 'Usuario creado exitosamente!') );
        else
            echo json_encode( array('message' => 'Error al crear el usuario.') );

        return;
    }

    public function verifyCorreo($correo)
    {
        if ( empty($correo) ) {
            $this->_msg = json_encode( array('message' => 'El correo no puede estar vacio.') );
            return false;
        }

        $usuario = new ModelUsuario($correo);
        if ( $usuario->getUsuarioId() > 0 ) {
            $this->_msg = json_encode( array('message' => 'Este correo ya esta registrado.') );
            return false;
        }

        return true;
    }
}