<?php
class materiales_proveedores extends model
{
    var $con;

    public function __construct()
    {
        $this->conexion = new config;
    }


    # FUNCION PARA LISTAR EN iNDEX
    public function ListarMaterialesIndex(  )
    {
        if ( $con = $this->conexion->conectar() ):
            $sql    =   "SELECT
                            materiales_proveedores.id,
                            materiales_proveedores.nombre,
                            categoria_materiales.nombre categoria
                        FROM
                            materiales_proveedores
                        JOIN categoria_materiales ON categoria_materiales.id = materiales_proveedores.categoria";
            $res    =   $con->query( $sql );
            $this->conexion->cerrar();
            return $res;
        endif;
    }


    # FUNCION PARA MOSTRAR LOS MATERIALES DEL PROVEEDOR SOLICITADO
    public function listarMaterialesProveedor( $proveedor )
    {
        if ( $con = $this->conexion->conectar() ):
            $sql    =   "SELECT
                            mat_prov.id,
                            materiales_proveedores.nombre material,
                            mat_prov.valor,
                            proveedores.nombre proveedor
                        FROM
                            mat_prov
                        JOIN materiales_proveedores ON materiales_proveedores.id = mat_prov.material
                        JOIN proveedores ON proveedores.id = mat_prov.proveedor
                        WHERE
                            proveedores.id = $proveedor";
            $res    =   $con->query( $sql );
            $this->conexion->cerrar();
            return $res;
    endif;
    }
}
