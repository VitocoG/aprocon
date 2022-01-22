<?php 
require_once '../../config/config.class.php';

class horas_extras extends model
{
	var $con;

	/*===================================
	=            CONSTRUCTOR            =
	===================================*/
	function __construct()
		{
			$this->conexion=new config;
		}
    /*=====  End of CONSTRUCTOR  ======*/
    

    public function listarTodosUsuarios( $localidades, $selectLocalidad )
    {
        if ( $con = $this->conexion->conectar() ):
            $sql = "SELECT
                        trabajadores.id,
                        trabajadores.nombre,
                        trabajadores.apellido,
                        localidades.id localidadId,
                        localidades.nombre localidad
                    FROM
                        trabajadores
                    JOIN localidades ON localidades.id = trabajadores.localidad
                    WHERE
                        trabajadores.activo = 0
                        ".$localidades.$selectLocalidad."
                    ORDER BY
                        localidades.nombre,
                        trabajadores.apellido,
                        trabajadores.nombre";
            $res = $con->query( $sql );
            $this->conexion->cerrar();
            return $res;
        endif;
    }

    #   FUNCION PARA VER EL TOTAL DE HORAS DE CADA TRABAJADOR EN EL INDEX
    public function listarTotalHoras( $mes, $anio, $trabajador )
    {
        if( $con    =   $this->conexion->conectar() ):
        $sql    =   "SELECT
                        SUM(total_horas ) total_horas
                    FROM
                        horas_extras
                    WHERE
                        fecha_inicio LIKE '".$anio."-".$mes."%' AND trabajador = $trabajador";
            $res    =   $con->query( $sql );
            $this->conexion->cerrar();
            foreach ($res  as $value):
            endforeach;
            return $value;                            
        else:
            echo 'No se pudo listarTodoIndex';
        endif;
    }


    public function listarDetalle( $trabajador, $anio, $mes )
    {
        if( $con    =   $this->conexion->conectar() ):
            $sql    =   "SELECT
                            horas_extras.id,
                            DATE_FORMAT(
                                horas_extras.fecha_inicio,
                                '%d-%m-%Y %H:%i'
                            ) fecha_inicio,
                            DATE_FORMAT(
                                horas_extras.fecha_termino,
                                '%d-%m-%Y %H:%i'
                            ) fecha_termino,
                            horas_extras.total_horas,
                            horas_extras.motivo,
                            horas_extras.trabajador,
                            usuarios.alias jefe_terreno,
                            usuarios.localidad localidad,
                            horas_extras.ods,
                            horas_extras.estado
                        FROM
                            horas_extras
                        JOIN usuarios ON usuarios.id = horas_extras.jefe_terreno
                        WHERE
                            trabajador = $trabajador AND fecha_inicio LIKE '".$anio."-".$mes."%'";
            $res    =   $con->query( $sql );
            $this->conexion->cerrar();
            return $res;                            
        else:
            echo 'No se pudo listarDetalle';
        endif;        
    }


    
    public function listarJefesDeTerreno( $trabajador )
    {
        if( $con    =   $this->conexion->conectar() ):
            $sql    =   "SELECT
                            usuarios.id,
                            usuarios.nombre usuario,
                            trabajadores.nombre,
                            trabajadores.apellido,
                            trabajadores.localidad
                        FROM
                            trabajadores
                        JOIN usuarios ON usuarios.localidad = trabajadores.localidad
                        WHERE trabajadores.id = $trabajador
                        AND usuarios.estado = 'ACTIVO'
                        AND ( usuarios.perfil = 1 OR usuarios.perfil = 3 )";
            $res    =   $con->query( $sql );
            $this->conexion->cerrar();
            return $res;
        else:
            echo 'no se pudo listarJefesDeTerreno';
        endif;
    }


    
    public function listarHorasActivas( $localidad )
    {
        if( $con    =   $this->conexion->conectar() ):
            $sql    =   "SELECT
                            horas_extras.id,
                            trabajadores.id trabajadoresId,
                            trabajadores.nombre,
                            trabajadores.apellido,
                            DATE_FORMAT(
                                horas_extras.fecha_inicio,
                                '%d-%m-%Y %H:%i'
                            ) fecha_inicio,
                            usuarios.alias jefe_terreno,
                            localidades.nombre localidad
                        FROM
                            horas_extras
                        JOIN trabajadores ON trabajadores.id = horas_extras.trabajador
                        JOIN usuarios ON usuarios.id = horas_extras.jefe_terreno
                        JOIN localidades ON localidades.id = trabajadores.localidad
                        WHERE usuarios.estado = 'ACTIVO'
                        AND horas_extras.estado = 1"
                        .$localidad;
            $res    =   $con->query( $sql );
            $this->conexion->cerrar();
            return $res;
        else:
            echo 'no se pudo listarJefesDeTerreno';
        endif;
    }


    public function validarTrabajador( $trabajador )
    {
        if( $con = $this->conexion->conectar() ):
            $sql = "SELECT activo FROM trabajadores WHERE id = $trabajador";
            $res = $con->query( $sql );
            $this->conexion->cerrar();
            foreach ( $res as $value ):
            endforeach;
            return $value;
        else:
            echo 'no se pudo validarTrabajador';
        endif;
    }


	function pdf( $id )
	{
		if( $con = $this->conexion->conectar() ):
			$sql =	"SELECT 
						he.id, 
						he.fecha_inicio, 
						he.fecha_termino, 
						he.total_horas, 
						tra.nombre, 
						tra.apellido, 
						car.nombre cargo, 
						usu.nombre jefe_terreno, 
						he.motivo, 
						he.ods 
					FROM horas_extras he 
					JOIN trabajadores tra 
						ON tra.id = he.trabajador 
					JOIN usuarios usu 
						ON usu.id = he.jefe_terreno 
					JOIN cargos car 
						ON car.id = tra.cargo 
					WHERE he.id = $id";
			$res = $con->query( $sql );
			$this->conexion->cerrar();
			return $res;
		endif;
	}


}
?>