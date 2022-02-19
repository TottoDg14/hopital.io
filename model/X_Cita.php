<?php
include_once(dirname(__DIR__) . '/model/Base.php');
include_once(dirname(__DIR__) . '/model/I_Cita.php');

class X_Cita extends Base implements I_Cita {
    public $_table = 'cita';
  
    private int $cita_id = 0;
  
    private int $paciente_id = 0;

    private int $responsable_id = 0;

    private string $correlativo;
  
    private string $fecha;
  
    private int $estatus;

    public function getCitaId(): int 
    {
        return $this->cita_id;
    }

    public function setCitaId(int $cita_id)
    {
        $this->cita_id = $cita_id;
        return $this;
    }

    public function getPacienteId(): int
    {
        return $this->paciente_id;
    }

    public function setPacienteId(int $paciente_id)
    {
        $this->paciente_id = $paciente_id;
        return $this;
    }

    public function getResponsableId(): int
    {
        return $this->responsable_id;
    }

    public function setResponsableId(int $responsable_id)
    {
        $this->responsable_id = $responsable_id;
        return $this;
    }

    public function getCorrelativo(): string
    {
        return $this->correlativo;
    }

    public function setCorrelativo(string $correlativo)
    {
        $this->correlativo = $correlativo;
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