<?php
require_once '../../config/config.class.php';

class ingresos
{
    var $con;
    
    function __construct()
    {
        $this->conexion     =    new config;
    }


    function mostrarBodega( $usuario )
    {
        if( $con    =   $this->conexion->conectar() ):
            $sql    =   "SELECT 
                            bodegas.id,
                            bodegas.nombre,
                            localidades.nombre localidad
                        FROM bodegas 
                        JOIN localidades
                            ON localidades.id = bodegas.localidad
                        WHERE bodegas.usuario = $usuario";
            $res    =   $con->query( $sql );
            $this->conexion->cerrar();


            foreach ( $res as $value ):
                $_SESSION['bodegaId']       =   $value['id'];
                $_SESSION['bodegaNombre']   =   $value['nombre'].' '.$value['localidad'];
            endforeach;
            return $res;
        endif;
    }


    function buscarMaterial( $buscar )
    {
        if( $con    = $this->conexion->conectar() ):
            $sql    = "
                        SELECT *
                        FROM materiales
                        WHERE 
                            c_barras LIKE '%$buscar%'
                        OR
                            c_sap LIKE '%$buscar%'
                        OR
                            nombre LIKE '%$buscar%'
            "; 
            $res    =   $con->query( $sql );
            $this->conexion->cerrar();
            return $res; 
        endif;
    }


    function mostrarMaterial( $id_enc )
    {
        if( $con    =   $this->conexion->conectar() ):
            $sql    =   "SELECT 
                            ingresos_det.id,
                            materiales.c_sap c_sap,
                            materiales.id materiales,
                            materiales.nombre material,
                            ingresos_det.valor, 
                            ingresos_det.cantidad,
                            ingresos_det.ingresos_enc id_enc
                        FROM ingresos_det 
                        JOIN materiales
                            ON materiales.id = ingresos_det.material
                        WHERE ingresos_enc = $id_enc
                        ORDER BY ingresos_det.id DESC";
            $res    =   $con->query( $sql );
            $this->conexion->cerrar();
            return $res;
        endif;
    }

    function verificarMaterial( $material, $encabezado)
    {
        if( $con    =  $this->conexion->conectar() ):
            $sql    =   "SELECT *
                        FROM ingresos_det 
                        WHERE material = $material
                        AND ingresos_enc = $encabezado";
            $res    =   $con->query( $sql );
            $this->conexion->cerrar();
            return $res;
        endif;
    }

    function modificarCantidad( $cantidad, $valor, $material, $encabezado )
    {
        if( $con    =  $this->conexion->conectar() ):
            $sql    =   "UPDATE ingresos_det
                        SET cantidad = ( cantidad + $cantidad ), 
                        valor = $valor
                        WHERE material = $material
                        AND ingresos_enc = $encabezado";
            $res    =   $con->query( $sql );
            $this->conexion->cerrar();
            return $res;
        endif;
    }

    function verificarMaterialStock( $bodega, $material )
    {
        if( $con    =  $this->conexion->conectar() ):
            $sql    =   "SELECT 
                            id,
                            bodega$bodega
                        FROM stock
                        WHERE material = $material";
            $res    =   $con->query( $sql );
            $this->conexion->cerrar();
             return $res;
        endif;
    }

    

    function listarEncabezadosBodega( $bodega )
    {
        $condicion  =   ( $_SESSION['perfil'] == 3 )    ? 'WHERE almacen = '.$bodega : 
                                                        ( ( $_SESSION['perfil'] == 4 )  ?   'WHERE localidades.contrato = '.$_SESSION['contrato'] :   '' );
        if( $con    =  $this->conexion->conectar() ):
            $sql    =   "SELECT
                            ingresos_enc.id,
                            bodegas.nombre almacen,
                            localidades.nombre localidad,
                            ingresos_enc.fecha,
                            #proveedores.nombre proveedor,
                            ingresos_enc.num_factura,
                            ingresos_enc.total
                         FROM ingresos_enc
                         #JOIN proveedores
                            #ON proveedores.id = ingresos_enc.proveedor
                         JOIN bodegas
                             ON bodegas.id = ingresos_enc.almacen
                         JOIN localidades
                             ON localidades.id = bodegas.localidad
                        $condicion";
            $res    =   $con->query( $sql );
            $this->conexion->cerrar();
            return $res;
        endif;
    }


    function numeroEncabezado()
    {
        if( $con    =   $this->conexion->conectar() ):
            $sql    =   "SELECT 
                            id 
                        FROM ingresos_enc 
                        ORDER BY id DESC 
                        LIMIT 1";
            $res    =   $con->query( $sql );
            $this->conexion->cerrar();
            $listar =   mysqli_fetch_assoc( $res );
            return $listar['id'];
        endif;
    }


    function deleteStock( $bodega, $material )
    {
        if( $con    =   $this->conexion->conectar() ):
            $sql    =   "UPDATE stock SET bodega$bodega = '0' WHERE material = $material";
            $res    =   $con->query( $sql );
            $this->conexion->cerrar();
            return $res;
        endif;
    }
}
