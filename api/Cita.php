<?php

namespace Api;

use Model\Cita as ModelCita;
use Model\Usuario;

class Cita 
{    
    private $cita;

    private $paciente;

    private $responsable;

    public $_msg;

    public function create()
    {
        $correo = isset($_GET['responsable']) ? $_GET['responsable'] : "" ;
        if ( !$this->verifyResponsable($correo) ) {
            echo $this->_msg; 
            return;
        }

        $correo = isset($_GET['paciente']) ? $_GET['paciente'] : "" ;
        if ( !$this->verifyPaciente($correo) ) {
            echo $this->_msg; 
            return;
        }

        $cita = new ModelCita();
        $cita->setPacienteId( $this->paciente->getUsuarioId() );
        $cita->setResponsableId( $this->responsable->getUsuarioId() );
        $cita->setEstatus( 1 );

        $fecha = isset($_GET['fecha']) ? htmlspecialchars(strip_tags( $_GET['fecha'] )) : date('Y-m-d H:i:s') ;
        $cita->setFecha( $fecha );
        
        $nro = $cita->max() + 10000;
        $cita->setCorrelativo('NC' . $nro);

        if( $cita->create())
            echo json_encode( array('message' => 'Cita '. $cita->getCorrelativo() .' agendada exitosamente!') );
        else
            echo json_encode( array('message' => 'Error al agendar la cita.') );

        return;
    }

    public function confirm()
    {
        $correo = isset($_GET['responsable']) ? $_GET['responsable'] : "" ;
        if ( !$this->verifyResponsable($correo) ) {
            echo $this->_msg; 
            return;
        }

        $correlativo = isset($_GET['correlativo']) ? $_GET['correlativo'] : "" ;
        if ( !$this->verifyCita($correlativo) ) {
            echo $this->_msg;
            return;
        }

        $status = isset($_GET['estatus']) ? $_GET['estatus'] : 1 ;
        $this->cita->setEstatus( $status );

        $estatus = $status == 0 ? 'Cancelada' : 'Aprobada';
        if ( $this->cita->update() ) 
            echo json_encode( array('message' => 'Cita '. $correlativo .' '. $estatus) );
        else
            echo json_encode( array('message' => 'No se ha actualizado la cita') );

        return;
    }

    public function read()
    {
        $correo = isset($_GET['responsable']) ? $_GET['responsable'] : "" ;
        if ( !$this->verifyResponsable($correo) ) {
            echo $this->_msg; 
            return;
        }

        $cita = new ModelCita();
        $result = $cita->readAll($this->responsable->getUsuarioId());
        $lista = [];
        foreach ($result as $r) {
            
            if ($r->getEstatus() <> 1)
                $estatus = $r->getEstatus() == 0 ? 'Cancelada' : 'Aprobada';
            else
                $estatus = 'Sin Confirmar';
            

            array_push($lista, [
                'correlativo' => $r->getCorrelativo(),
                'fecha' => $r->getFecha(),
                'estatus' => $estatus
            ]);
        }

        // Crear cita
        if(count($lista) > 0) 
            echo json_encode( array('citas' => $lista) );
        else 
            echo json_encode( array('message' => 'No posee citas agendadas.') );
    
        return;
    }

    public function verifyCita($correlativo)
    {
        if( empty($correlativo) )
        {
            $this->_msg = json_encode( array('message' => 'Debe indicar el numero de la cita') );
            return false;
        }

        $this->cita = new ModelCita( $correlativo );
        if( $this->cita->getResponsableId() !== $this->responsable->getUsuarioId() ) {
            $this->_msg = json_encode( array('message' => 'Esta cita no esta en su agenda') );
            return;
        }
        return true;
    }

    public function verifyPaciente($correo)
    {
        if( empty($correo) )
        {
            $this->_msg = json_encode( array('message' => 'Este paciente no esta registrado') );
            return false;
        }

        $this->paciente = new Usuario($correo);
        return true;
    }

    public function verifyResponsable($correo)
    {
        if( empty($correo) )
        {
            $this->_msg = json_encode( array('message' => 'Es necesario especificar el responsable') );
            return false;
        }

        $this->responsable = new Usuario($correo);
        if($this->responsable->getRolId() !== 1) {
            $this->_msg = json_encode( array('message' => 'Usted no tiene posee permisos para esta accion') );
            return false;
        }

        return true;
    }
}