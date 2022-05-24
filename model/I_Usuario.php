<?php 

namespace Model;

interface I_Usuario {
    public function getUsuarioId(): int;

    public function setUsuarioId(int $usuario_id);

    public function getRolId(): int;

    public function setRolId(int $rol_id);

    public function getNombre(): string;

    public function setNombre(string $nombre);

    public function getCorreo(): string;

    public function setCorreo(string $correo);

    public function getFecha():string ;

    public function setFecha(string $fecha);

    public function getEstatus():int;

    public function setEstatus(int $estatus);
}