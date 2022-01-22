<?php
require_once '../../config/model.class.php';
class bodegas
{
    var $con;

    function __construct()
    {
        $this->conexion =   new config;
    }


    function ListarBodegas()
    {
        if( $con    =   $this->conexion->conectar() ):
            $sql    =   "SELECT 
                            bodegas.id,
                            bodegas.nombre,
                            localidades.nombre localidad,
                            contratos.nombre contrato,
                            usuarios.nombre usuario
                        FROM bodegas
                        JOIN localidades
                            ON localidades.id = bodegas.localidad
                        JOIN contratos
                            ON contratos.id = localidades.contrato
                        JOIN usuarios
                            ON usuarios.id = bodegas.usuario
                        ORDER BY contratos.id, localidades.nombre";
            $res    =   $con->query( $sql );
            $this->conexion->cerrar();
            return $res;
        endif;
    }


    function agregarBodegas( $bodega )
    {
        if( $con = $this->conexion->conectar() ):
            $sql    =   "ALTER TABLE stock ADD $bodega INT NOT NULL AFTER material";
            $res    =   $con->query( $sql );
            $this->conexion->cerrar();
            return $res;
        endif;
    }


    function eliminarBodegas( $bodega )
    {
        if( $con = $this->conexion->conectar() ):
            $sql    =   "ALTER TABLE stock DROP $bodega";
            $res    =   $con->query( $sql );
            $this->conexion->cerrar();
            return $res;
        endif;
    }

}

?>