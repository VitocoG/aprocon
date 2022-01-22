<?php
class compras extends model
{
    var $con;

    function __construct()
    {
        $this->conexion =   new config;
    }


    /* FUNCION PARA LISTAR LOS MATERIALES DEL PROVEEDOR */
    public function listarMaterialesProveedor( $proveedor )
    {
        if( $con = $this->conexion->conectar() ):
            $sql = "SELECT
                        materiales_proveedores.id material,
                        materiales_proveedores.nombre materialNombre
                    FROM
                        mat_prov
                    JOIN materiales_proveedores 
                        ON materiales_proveedores.id = mat_prov.material
                    WHERE
                        proveedor = $proveedor";
            $res = $con->query( $sql );
            $this->conexion->cerrar();
            return $res;
        else:
            echo 'no se pudo listarMaterialesProveedor';
        endif;
    }

    


    /* FUNCION PARA LISTAR LOS MATERIALES DEL PROVEEDOR A LA TABLA DEL DETALLE */
    public function listarBuscar( $material, $proveedor )
    {
        if( $con = $this->conexion->conectar() ):
            $sql = "SELECT
                        mat_prov.material material,
                        materiales_proveedores.nombre descripcion,
                        mat_prov.valor
                    FROM
                        mat_prov
                    JOIN materiales_proveedores 
                        ON materiales_proveedores.id = mat_prov.material
                    WHERE
                        mat_prov.material = $material AND mat_prov.proveedor = $proveedor";
            $res = $con->query( $sql );
            $this->conexion->cerrar();
            foreach( $res as $value ):
            endforeach;
            return $value;
        else:
            echo 'no se pudo listarBuscar';
        endif;
    }

    


    /* FUNCION PARA LISTAR LOS MATERIALES DEL PROVEEDOR A LA TABLA DEL DETALLE */
    public function listarDetalle( $id )
    {
        if( $con = $this->conexion->conectar() ):
            $sql = "SELECT
                        compras_det.id,
                        compras_det.medida,
                        materiales_proveedores.nombre descripcion,
                        materiales_proveedores.id idDescripcion,
                        compras_det.cantidad,
                        compras_det.valor,
                        (
                            compras_det.cantidad * compras_det.valor
                        ) total
                    FROM
                        compras_det
                    JOIN materiales_proveedores 
                        ON materiales_proveedores.id = compras_det.descripcion
                    WHERE
                        compras_det.idEnc = $id";
            $res = $con->query( $sql );
            $this->conexion->cerrar();
            return $res;
        else:
            echo 'no se pudo listarDetalle';
        endif;
    }

    


    /* FUNCION PARA ACTUALIZAR REGISTROS EN EL DETALLE */
    public function UpdateDetalle( $encabezado, $material, $cantidad, $total )
    {
        if( $con = $this->conexion->conectar() ):
            $sql = "UPDATE compras_det
                    SET 
                        cantidad = cantidad + $cantidad,
                        total = total + $total
                    WHERE idEnc = $encabezado
                    AND descripcion = $material";
            $res = $con->query( $sql );
            $this->conexion->cerrar();
            return $res;
        else:
            echo 'no se pudo UpdateDetalle';
        endif;
    }
}
