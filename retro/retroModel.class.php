<?php
require_once('../../config/config.class.php');
class retroModel 
{
    var $con;

    function __construct()
    {
        $this->conexion     =   new config;
    }

    function ListarRetro()
    {
        if ( $con = $this->conexion->conectar() )
        {
            $sql = "SELECT 
                        ar.id, 
                        ar.fecha,
                        ar.estado_factura,
                        u.nombre usuario, 
                        ar.localidad,
                        ar.total_horas,
                        ar.report, ar.factura, ar.comprobante_pago
                    FROM arriendo_retro ar
                    INNER JOIN usuarios u ON u.id=ar.usuario
                    ORDER BY ar.id DESC";
            $res    =   $con->query($sql);
            $this->conexion->cerrar();
            return $res;
        }

    function ListarRetroUsuario($id)
    {
        if ( $con = $this->conexion->conectar() )
        {
            $sql = "SELECT 
                        ar.id, 
                        ar.fecha,
                        ar.estado_factura,
                        u.nombre usuario, 
                        ar.localidad,
                        ar.total_horas,
                        ar.report, 
                        ar.factura, 
                        ar.comprobante_pago
                    FROM arriendo_retro ar
                    INNER JOIN usuarios u ON u.id=ar.usuario
                    WHERE ar.usuario = $id
                    ORDER BY ar.id DESC";
            $res    =   $con->query($sql);
            $this->conexion->cerrar();
            return $res;
        }
    }
    }
}
?>