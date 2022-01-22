<?php

require_once '../../config/config.class.php';

class entrega extends model
{
 var $con;

 function __construct()
 {
     $this->conexion    =   new config;
 }


 function ListarAbiertas( $recibe, $clases, $id )
 {
     if( $con = $this->conexion->conectar() ):
        $sql    = /*"SELECT
                        entrega_enc.id,
                        entrega_enc.fecha,
                        localidades.nombre localidad,
                        $recibe recibe,
                        entrega_enc.concepto,
                        entrega_enc.total
                    FROM entrega_enc
                    JOIN localidades ON localidades.id = entrega_enc.localidad
                    JOIN $clases ON $clases.id = entrega_enc.recibe
                    WHERE entrega_enc.estado = 0
                    AND entrega_enc.entrega = $entrega";*/
        
        "SELECT 
                        entrega_enc.id,
                        entrega_enc.fecha,
                        $recibe recibe,
                        entrega_enc.concepto,
                        localidades.nombre localidad,
                        entrega_enc.total 
                    FROM entrega_enc
                    JOIN $clases
                        ON $clases.id = entrega_enc.recibe
                    JOIN localidades
                        ON localidades.id = entrega_enc.localidad
                    WHERE entrega_enc.id = $id
                    AND entrega_enc.estado = 0;";
        $res    =   $con->query( $sql);
        $this->conexion->cerrar();
        return $res;
     else:
        echo 'no se pudo ListarEntrega';
     endif;
 }


 function ListarEntrega(  $clases, $id )
 {
     if( $con = $this->conexion->conectar() ):
        $sql    = "SELECT 
                        entrega_enc.id,
                        entrega_enc.fecha,
                        entrega_enc.concepto,
                        localidades.nombre localidad,
                        entrega_enc.total, 
                        entrega_enc.observaciones, 
                        entrega_enc.archivo
                    FROM entrega_enc
                    JOIN $clases
                        ON $clases.id = entrega_enc.recibe
                    JOIN localidades
                        ON localidades.id = entrega_enc.localidad
                    WHERE entrega_enc.id = $id
                    AND entrega_enc.estado = 1;";
        $res    =   $con->query( $sql);
        $this->conexion->cerrar();
        return $res;
     else:
        echo 'no se pudo ListarEntrega';
     endif;
 }



 function ListarRecibo( $id )
 {
     if( $con = $this->conexion->conectar() ):
        $sql    = "SELECT
        entrega_enc.id,
        entrega_enc.fecha,
        entrega_enc.concepto,
        localidades.nombre,
        entrega_enc.total,
        entrega_enc.observaciones,
        usuarios.nombre entrega,
        entrega_enc.estado,
        entrega_enc.archivo,
        localidades.nombre localidad
    FROM entrega_enc
    JOIN localidades
        ON localidades.id = entrega_enc.localidad
    JOIN usuarios
        ON usuarios.id = entrega_enc.entrega
    WHERE entrega_enc.id = $id";
       $res    =   $con->query( $sql);
        $this->conexion->cerrar();
        return $res;
     else:
        echo 'no se pudo ListarEntrega';
     endif;
 }

 public function MostrarTodasAbiertas( )
 {
    if( $con = $this->conexion->conectar() ):
       $sql    = "SELECT * FROM entrega_enc";
      $res    =   $con->query( $sql);
       $this->conexion->cerrar();
       return $res;
    else:
       echo 'no se pudo MostrarTodasAbiertas';
    endif;
}
}
?>