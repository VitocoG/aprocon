<?php
class materiales_proveedores extends model
{
    var $con;

    public function __construct( )
    {
        $this->conexion = new config;   
    }

    public function ListarInicio( )
    {
        if( $con    =   $this->conexion->conectar() ):
            $sql    =   "SELECT
                            materiales_proveedores.id,
                            materiales_proveedores.nombre,
                            categoria_materiales.nombre categoria
                        FROM
                            materiales_proveedores
                        JOIN categoria_materiales 
                            ON categoria_materiales.id = materiales_proveedores.categoria";
            $res    =   $con->query( $sql );
            $this->conexion->cerrar();
            return $res;
        else:
            echo 'no se pudo ListarInicio';
        endif;                            
    }

    public function ListarMatProv( $proveedor )
    {
        if( $con    =   $this->conexion->conectar() ):
            $sql    =   "SELECT
                            mat_prov.id,
                            materiales_proveedores.nombre material,
                            proveedores.nombre proveedor,
                            mat_prov.valor
                        FROM
                            mat_prov
                        JOIN materiales_proveedores ON materiales_proveedores.id = mat_prov.material
                        JOIN proveedores ON proveedores.id = mat_prov.proveedor
                        WHERE
                            mat_prov.proveedor = $proveedor";
            $res    =   $con->query( $sql );
            $this->conexion->cerrar();
            return $res;
        else:
            echo 'no se pudo ListarMatProv';
        endif;                            
    }

    public function VerificarMatProv( $material, $proveedor )
    {
        if( $con    =   $this->conexion->conectar() ):
            $sql    =   "SELECT * FROM mat_prov
                        WHERE material = $material
                            AND proveedor = $proveedor";
            $res    =   $con->query( $sql );
            $this->conexion->cerrar();
            return $res->num_rows;
        else:
            echo 'no se pudo VerificarMatProv';
        endif;                            
    }

    public function ListarModal( $proveedor )
    {
        if( $con    =   $this->conexion->conectar() ):
            $sql    =   "SELECT
                            mat_prov.id,
                            materiales_proveedores.nombre material,
                            proveedores.nombre proveedor,
                            mat_prov.valor
                        FROM
                            mat_prov
                        JOIN materiales_proveedores ON materiales_proveedores.id = mat_prov.material
                        JOIN proveedores ON proveedores.id = mat_prov.proveedor
                        WHERE
                            mat_prov.material = $proveedor";
            $res    =   $con->query( $sql );
            $this->conexion->cerrar();
            return $res;
        else:
            echo 'no se pudo ListarModal';
        endif;                            
    }
}

?>