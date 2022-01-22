<?php 
require_once('../../config/config.class.php');

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

	


	function Listar($localidad)
	{
		if ( $con 	= $this->conexion->conectar() ):
			$sql	=	"SELECT 
			                    he.id, 
			                    t.nombre nombre, 
			                    t.apellido apellido, 
			                    he.motivo motivo, 
			                    t.cargo cargo, 
			                    he.fecha_inicio, 
			                    he.fecha_termino, 
			                    he.total_horas, 
			                    u.nombre jefe_terreno, 
			                    he.ods, t.estado
			             FROM horas_extras he 
			             INNER JOIN trabajadores t ON t.id=he.trabajador 
			             INNER JOIN usuarios u ON u.id=he.jefe_terreno 
			             WHERE t.localidad = $localidad
			             AND YEAR(fecha_inicio) = DATE_FORMAT(now(), '%Y')
                         AND MONTH(fecha_inicio) = DATE_FORMAT(now(), '%m')
			             ORDER BY he.id DESC";
			$res	=	$con->query( $sql );
			$this->conexion->cerrar();
			return $res;
		else:
			echo "no se puede Listar";
		endif;
	}


	function ListarTodo( $localidad, $mes, $anio )
	{
		if ( $con 	= $this->conexion->conectar() ):
			$sql	=	"SELECT 
			                    t.id, 
			                    t.nombre nombre, 
			                    t.apellido apellido, 
			                    SUM(he.total_horas) total_horas 
			             FROM horas_extras he 
			             JOIN trabajadores t 
                            ON t.id = he.trabajador 
			             WHERE t.localidad = $localidad 
			             AND MONTH(fecha_inicio) = $mes 
			             AND YEAR(fecha_inicio) = $anio
			             GROUP BY  t.apellido, t.nombre";
			$res	=	$con->query( $sql );
			$this->conexion->cerrar();
			return $res;
		else:
			echo "no se puede Listar";
		endif;
	}


	function ListarDetalle( $trabajador, $mes, $anio )
	{
		if ( $con 	= $this->conexion->conectar() ):
			$sql	=	"SELECT 
			                * 
			             FROM horas_extras 
			             WHERE trabajador = $trabajador 
			             AND MONTH(fecha_inicio) = $mes 
                         AND YEAR(fecha_inicio) = $anio
                         ORDER BY fecha_inicio DESC";
			$res	=	$con->query( $sql );
			$this->conexion->cerrar();
			return $res;
		else:
			echo "no se puede Listar";
		endif;
	}


	function ListarUsuariosLocalidadEstado( $localidad )
	{
		if ( $con 	= $this->conexion->conectar() ):
			$sql	=	"SELECT 
			                * 
			             FROM trabajadores 
			             WHERE localidad=$localidad 
			             AND estado = 0 
			             AND activo = 0
			             ORDER BY apellido ASC";
			$res	=	$con->query( $sql );
			$this->conexion->cerrar();
			return $res;
		else:
			echo "no se puede Listar";
		endif;
	}


	function ListarJefeTerrenoLocalidad( $localidad )
	{
		if ( $con 	= $this->conexion->conectar() ):
			$sql	=	"SELECT 
			                * 
			            FROM usuarios 
			            WHERE (perfil = 2 OR perfil = 3) 
			            AND localidad = $localidad
			            AND estado = 'ACTIVO'
			            ORDER BY nombre ASC";
			$res	=	$con->query( $sql );
			$this->conexion->cerrar();
			return $res;
		else:
			echo "no se puede ListarJefeTerrenoLocalidad";
		endif;
	}


	function ListarHorasPorJefeTerreno( $jefe_terreno, $mes, $anio )
	{
		if ( $con 	= $this->conexion->conectar() ):
			$sql	=	"SELECT 
                                he.id,
                                DATE_FORMAT(
                                    he.fecha_inicio,
                                    '%d-%m-%Y %H:%i'
                                    ) fecha_inicio,
                                DATE_FORMAT(
                                    he.fecha_termino,
                                    '%d-%m-%Y %H:%i'
                                    ) fecha_termino,
                                he.total_horas, 
			                    he.motivo, 
			                    tra.id trabajador,
			                    tra.nombre nombre, 
			                    tra.apellido apellido, 
			                    he.ods, 
								usu.nombre jefe_terreno, 
								he.estado
			             FROM horas_extras he 
			             JOIN trabajadores tra 
						 	ON tra.id = he.trabajador
			             JOIN usuarios usu 
						 	ON usu.id = he.jefe_terreno
			             WHERE he.jefe_terreno = $jefe_terreno 
                         AND month(fecha_inicio)= $mes
                         AND year(fecha_inicio)= $anio
			             ORDER BY he.fecha_inicio DESC";
			$res	=	$con->query( $sql );
			$this->conexion->cerrar();
			return $res;
		else:
			echo "no se puede Listar";
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