<?php 

namespace Model;

interface I_Cita {
    public function getCitaId(): int;

    public function setCitaId(int $cita_id);

    public function getPacienteId(): int;

    public function setPacienteId(int $paciente_id);

    public function getResponsableId(): int;

    public function setResponsableId(int $responsable_id);

    public function getCorrelativo(): string;

    public function setCorrelativo(string $correlativo);

    public function getFecha():string ;

    public function setFecha(string $fecha);

    public function getEstatus():int;

    public function setEstatus(int $estatus);
}