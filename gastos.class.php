<?php 
session_start();

require_once '../../config/config.class.php';

class gastos 
{
	var $con;

	function __construct()
	{
		$this->conexion 	= 	new config;
	}


	function ListarGastosUsuario( $id, $mes, $anio )
	{
		if ( $con = $this->conexion->conectar() )
		{
			$sql 	= 	"SELECT 
			                    g.id, 
			                    DATE_FORMAT(g.fecha, '%d-%m-%Y') fecha ,
			                    u.nombre usuario, 
			                    DATE_FORMAT(g.fecha_documento, '%d-%m-%Y') fecha_documento , 
			                    g.num_documento documento, 
			                    g.detalle, 
			                    g.total, 
			                    g.archivo 
			            FROM gastos g 
			            INNER JOIN usuarios u ON u.id=g.usuario 
			            WHERE u.id = ".$id." AND MONTH(g.fecha)=".$mes." 
			            AND YEAR(g.fecha)=".$anio." 
			            ORDER BY g.id DESC";
			$res	=	$con->query( $sql );
			$this->conexion->cerrar();
			return $res;
		}
		else
		{
			echo "no se puede ListarGastosUsuario";			
		}
	}


	function ListarGasto()
	{
		if ( $con = $this->conexion->conectar() )
		{
			$sql 	= 	"SELECT g.id, DATE_FORMAT(g.fecha, '%d-%m-%Y') fecha ,u.nombre usuario, DATE_FORMAT(g.fecha_documento, '%d-%m-%Y') fecha_documento , g.num_documento documento, g.detalle, g.total, g.archivo FROM gastos g INNER JOIN usuarios u ON u.id=g.usuario WHERE MONTH(g.fecha)=MONTH(now()) ORDER BY g.id DESC";
			$res	=	$con->query( $sql );
			$this->conexion->cerrar();
			return $res;
		}
		else
		{
			echo "no se puede ListarGastos";			
		}
	}


	function ListarGastoTotal()
	{
		if ( $con = $this->conexion->conectar() )
		{
			$sql 	= 	"SELECT SUM(total) gasto from gastos where usuario = ".$_SESSION['id'];
			$res	=	$con->query( $sql );
			$this->conexion->cerrar();
			return $res;
		}
		else
		{
			echo "no se puede ListarGastoTotal";			
		}
	}
}
 ?>