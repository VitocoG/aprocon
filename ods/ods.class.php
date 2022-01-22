<?php 
session_start();
require_once ( '../../config/config.class.php' );

 class ods
 {
 	var $con; 


	function __construct()
	{
		$this->conexion 	=	new config;
	}



	function mostrar_ods( $condicion, $tipo )
	{
		if ($con=$this->conexion->conectar())
		 {
			$sql 	=	"SELECT 
								ODS.id,
								codigo,
								horaInicio,
								horaTermino, 
								usuarios.nombre jefeTerreno, 
								cumplimiento_contratista, cumplimiento_ito
							FROM ODS 
							INNER JOIN itos ON itos.id=ODS.ito
							INNER JOIN actividad ac ON ac.id=ODS.actividad
							INNER JOIN brigadas bri ON bri.id=ODS.brigada
							INNER JOIN usuarios ON usuarios.id=ODS.jefeTerreno
							WHERE ( $condicion ) 
							AND tipo_orden = $tipo
							ORDER BY ODS.id DESC";

			$res=$con->query($sql);
			$this->conexion->cerrar();
			return $res;
		}
		else 
		{
			echo"no se pudo mostrar_ods";
		}
	}



	function mostrar_ods_usuario( $id )
	{
		if ($con=$this->conexion->conectar())
		 {
			$sql 	=	"SELECT 
							ODS.id,
                            codigo,
                            horaInicio,
                            horaTermino, 
							cierre, 
							descripcion,
                            itos.nombre ito,
                            ac.nombre actividad,
                            bri.nombre brigada,
							direccion
                        FROM ODS 
                        INNER JOIN itos ON itos.id=ODS.ito
                        INNER JOIN actividad ac ON ac.id=ODS.actividad
                        INNER JOIN brigadas bri ON bri.id=ODS.brigada
                        WHERE jefeTerreno = $id
						ORDER BY ODS.id DESC";

			$res=$con->query($sql);
			$this->conexion->cerrar();
			return $res;
		}
		else 
		{
			echo"no se pudo mostrar_ods";
		}
	}


	function contar_ods( $condicion, $tipo_orden )
	{
		if ( $con=$this->conexion->conectar() )
		{
			$sql 	=	"SELECT * 
						FROM ODS
						WHERE ($condicion)
						AND tipo_orden = '".$tipo_orden."'";
			$res	=	$con->query($sql);
			$this->conexion->cerrar();
			$rows 	= 	$res->num_rows;
			return $rows;
		}
		else 
		{
			echo"no se pudo contar_ods";
		}
	}


	function contar_ods_cumplen( $condicion, $tipo_orden )
	{
		if ( $con=$this->conexion->conectar() )
		{
			$sql 	=	"SELECT * 
						FROM ODS
						WHERE ($condicion)
						AND tipo_orden = {$tipo_orden}
						AND cumplimiento_contratista = 1";
			$res	=	$con->query($sql);
			$this->conexion->cerrar();
			$rows 	= 	$res->num_rows;
			return $rows;
		}
		else 
		{
			echo"no se pudo contar_ods_cumplen";
		}
	}


	function contar_ods_cumplen_ito( $condicion, $tipo_orden )
	{
		if ( $con=$this->conexion->conectar() )
		{
			$sql 	=	"SELECT * 
			FROM ODS
			WHERE ($condicion)
			AND tipo_orden = {$tipo_orden}
			AND cumplimiento_ito = 1";
			$res	=	$con->query($sql);
			$this->conexion->cerrar();
			$rows 	= 	$res->num_rows;
			return $rows;
		}
		else 
		{
			echo"no se pudo contar_ods_cumplen_ito";
		}
	}
 }



  ?>