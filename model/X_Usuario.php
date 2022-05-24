<?php

namespace Model;

class X_Usuario extends Base implements I_Usuario {
    public $_table = 'usuario';
  
    private $usuario_id = 0;
  
    private $rol_id = 0;
  
    private $nombre;
  
    private $correo;
  
    private $fecha;
  
    private $estatus;

    public function getUsuarioId(): int 
    {
        return $this->usuario_id;
    }

    public function setUsuarioId(int $usuario_id)
    {
        $this->usuario_id = $usuario_id;
        return $this;
    }

    public function getRolId(): int
    {
        return $this->rol_id;
    }

    public function setRolId(int $rol_id)
    {
        $this->rol_id = $rol_id;
        return $this;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre)
    {
        $this->nombre = $nombre;
        return $this;
    }

    public function getCorreo(): string
    {
        return $this->correo;
    }

    public function setCorreo(string $correo)
    {
        $this->correo = $correo;
        return $this;
    }

    public function getFecha():string
    {
        return $this->fecha;
    }

    public function setFecha(string $fecha)
    {
        $this->fecha = $fecha;
        return $this;
    }

    public function getEstatus():int
    {
        return $this->estatus;
    }

    public function setEstatus(int $estatus){
        $this->estatus = $estatus;
        return $estatus;
    }
}