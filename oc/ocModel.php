<?php
require_once '../../config/config.class.php';

class oc extends model
{
    var $con;

    public function __construct()
    {
        $this->conexion = new config;
    }


    public function mostrarOC()
    {
        if( $con = $this->conexion->conectar() )
        {
            $sql    =   "SELECT
                            oc.id,
                            usuarios.nombre solicita, 
                            oc.autoriza,
                            proveedores.nombre proveedor,
                            oc.fecha,
                            compras_enc.total total, 
                            oc.compra
                        FROM
                            oc
                        JOIN compras_enc ON compras_enc.id = oc.compra
                        JOIN proveedores ON proveedores.id=compras_enc.proveedor
                        JOIN usuarios ON usuarios.id=oc.solicita";
            $res    = $con->query( $sql );
            $this->conexion->cerrar();
            return $res;
        }
        else
        {
            echo 'no se pudo mostrarOC';
        }
    }
}



?>