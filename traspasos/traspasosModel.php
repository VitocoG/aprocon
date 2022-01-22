<?php 
class traspasos
{
    var $con;

    function __construct()
    {
        $this->conexion =   new config;
    }

    function bodegaSesion( $idUsuario)
    {
        if( $con    =   $this->conexion->conectar() ):
            $sql    =   "SELECT
                            bodegas.id,
                            bodegas.nombre nombre,
                            localidades.nombre localidad,
                            localidades.contrato contrato
                        FROM
                            bodegas
                        JOIN
                            localidades
                        ON
                            localidades.id = bodegas.localidad
                            WHERE bodegas.usuario = $idUsuario";
            $res    =   $con->query( $sql ); 
            $this->conexion->cerrar();
            if( $res->num_rows > 0 ):
                foreach ( $res as $value ):
                    $_SESSION['idBodega']       =   $value['id'];
                    $_SESSION['nombreBodega']   =   $value['nombre'].' '.$value['localidad'];
                endforeach;
            endif;
            return $res;
        else:
            print_r( 'no se pudo bodegaSesion' );
        endif;
    }
    

    function mostrarBodegas(  )
    {
        if( $con    =   $this->conexion->conectar() ):
            $sql    =   "SELECT
                                bodegas.id,
                               bodegas.nombre nombre,
                               localidades.nombre localidad,
                               localidades.contrato contrato
                           FROM
                               bodegas
                           JOIN
                               localidades
                           ON
                               localidades.id = bodegas.localidad
                           ORDER BY
                               localidades.contrato,
                               bodegas.nombre,
                               localidades.nombre";
            $res    =   $con->query( $sql ); 
            $this->conexion->cerrar();
            return $res;
        else:
            print_r( 'no se pudo mostrarBodegas' );
        endif;
    }


    function ultimoEnc()
    {
        if( $con    =   $this->conexion->conectar() ):
            $sql    =   "SELECT
                            id
                        FROM
                            traspasos_enc
                        ORDER BY
                            id
                        DESC
                        LIMIT 1";
            $res    =   $con->query( $sql ); 
            $this->conexion->cerrar();
            $listarUltimo =   mysqli_fetch_assoc( $res );
            return $listarUltimo['id'] ;
        else:
            print_r( 'no se pudo ultimoEnc' );
        endif;
    }


    function    verificarDetalle( $material, $id_enc )
    {
        if( $con    =   $this->conexion->conectar() ):
            $sql    =   "SELECT
                            *
                        FROM
                            traspasos_det
                        WHERE
                            material = $material AND id_enc = $id_enc";
            $res    =   $con->query( $sql );
            $this->conexion->cerrar();
            return $res;
        else:
            print_r( 'no se pudo verificarDetalle' );
        endif;
    }

    function modificarCantidad( $cantidad, $material, $encabezado )
    {
        if( $con    =  $this->conexion->conectar() ):
            $sql    =   "UPDATE traspasos_det
                        SET cantidad = ( cantidad + $cantidad )
                        WHERE material = $material
                        AND id_enc = $encabezado";
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


    function mostrarMaterial( $id_enc )
    {
        if( $con    =   $this->conexion->conectar() ):
            $sql    =   "SELECT 
                            traspasos_det.id,
                            materiales.c_sap c_sap,
                            materiales.id id_material,
                            materiales.nombre material,
                            traspasos_det.valor, 
                            traspasos_det.cantidad
                        FROM traspasos_det 
                        JOIN materiales
                            ON materiales.id = traspasos_det.material
                        WHERE id_enc = $id_enc
                        ORDER BY traspasos_det.id DESC";
            $res    =   $con->query( $sql );
            $this->conexion->cerrar();
            return $res;
        endif;
    }


    function listarEncabezadosUsuario( )
    {
        if( $con    =   $this->conexion->conectar() ):
            $sql    =   "SELECT
                            traspasos_enc.id,
                            DATE_FORMAT(traspasos_enc.fecha, '%d-%m-%Y') fecha,
                            bodegas.nombre bodega,
                            localidades.nombre localidad,
                            traspasos_enc.destino destino,
                            traspasos_enc.total total
                        FROM
                            traspasos_enc
                        JOIN
                            bodegas
                        ON
                            bodegas.id = traspasos_enc.destino
                        JOIN
                            localidades
                        ON
                            localidades.id = bodegas.localidad";
            $res    =   $con->query( $sql );
            $this->conexion->cerrar();
            return $res;
        else:
            echo 'no se puede listarEncabezadosUsuario';
        endif;
    }


    function eliminarDetalle( $id_det)
    {
        if( $con    =   $this->conexion->conectar() ):
            $sql    =   "DELETE FROM traspasos_det WHERE id = $id_det";
            #$res    =   $con->query( $sql );
            $this->conexion->cerrar();
            echo $sql;#return $res;
        else:
            echo 'no se puede eliminarDetalle';
        endif;
    }


    function listarStockMateriales( $bodega, $material )
    {
        if( $con    =   $this->conexion->conectar() ):
            $sql    =   "SELECT
                            materiales.id,
                            materiales.nombre,
                            ingresos_det.valor, 
                            stock.bodega$bodega
                        FROM
                            ingresos_det
                        JOIN ingresos_enc ON ingresos_enc.id = ingresos_det.ingresos_enc
                        JOIN materiales ON materiales.id = ingresos_det.material
                        JOIN stock ON stock.material = ingresos_det.material
                        WHERE
                            ingresos_enc.almacen = 1 AND ingresos_det.material = $material";
            $res    =   $con->query( $sql );
            $this->conexion->cerrar();
            return $res;
        else:
            echo 'no se puede eliminarDetalle';
        endif;
    }


    function modificaStock( $bodega, $cantidad, $material )
    {
        if( $con    =   $this->conexion->conectar() ):
            $sql    =   "UPDATE
                            stock
                        SET
                            bodega$bodega = ( bodega$bodega + ( $cantidad ) )
                        WHERE
                            material = $material";
            $res    =   $con->query( $sql );
            $this->conexion->cerrar();
            return $res;
        else:
            echo 'no se pudo deleteStock';
        endif;
    }

}
