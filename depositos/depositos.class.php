<?php 
session_start();
require_once ( '../../config/config.class.php' );

 class depositos
 {
 	var $con; 


	function __construct()
	{
		$this->conexion 	=	new config;
	}


 	function ListarDepositos()
 	{
		if ($con=$this->conexion->conectar())
		 {
			$sql 	=	"SELECT 
                        	d.id as id, 
                            u.nombre as nombre, 
                            d.monto as monto, 
                            d.detalle as detalle, 
                            d.fecha fecha 
                        FROM depositos d 
                        INNER JOIN usuarios u ON u.id=d.usuario 
                        WHERE year(d.fecha)= year(now())
                        ORDER BY d.id DESC";

			$res=$con->query($sql);
			$this->conexion->cerrar();
			return $res;
		}
		else 
		{
			echo"no se pudo ListarDepositos";
		}
	}


 	function ListarDepositosFecha()
 	{
		if ($con=$this->conexion->conectar())
		 {
			$sql 	=	"SELECT DATE_FORMAT(fecha, '%d-%m-%y') fechas, monto FROM depositos WHERE usuario = ".$_SESSION['id']." ORDER BY fecha DESC LIMIT 1 ";

			$res=$con->query($sql);
			$this->conexion->cerrar();
			return $res;
		}
		else 
		{
			echo"no se pudo ListarDepositosFecha";
		}
	}


 	function ListarDepositoTotal()
 	{
		if ($con=$this->conexion->conectar())
		 {
			$sql 	=	"SELECT SUM(monto) monto FROM depositos WHERE usuario =".$_SESSION['id']."";

			$res=$con->query($sql);
			$this->conexion->cerrar();
			return $res;
		}
		else 
		{
			echo"no se pudo ListarDepositosFecha";
		}
	}


 	function ListarDepositosFiltro( $filtro )
 	{
		if ($con=$this->conexion->conectar())
		 {
			$sql 	=	"SELECT d.id as id, u.nombre as nombre, d.monto as monto, d.detalle as detalle, d.fecha fecha FROM depositos d INNER JOIN usuarios u ON u.id=d.usuario WHERE u.nombre = '$filtro' ORDER BY d.id DESC";

			$res=$con->query($sql);
			$this->conexion->cerrar();
			return $res;
		}
		else 
		{
			echo"no se pudo ListarDepositosFiltro";
		}
	}
	
	


 	function ListarUsuariosDeposito()
 	{
		if ($con=$this->conexion->conectar())
		 {
			$sql 	=	"SELECT * 
			            FROM usuarios
			            WHERE (perfil=2 OR perfil=3 OR perfil=5 OR perfil=1)
			            AND estado ='ACTIVO'
			            ORDER BY nombre";

			$res=$con->query($sql);
			$this->conexion->cerrar();
			return $res;
		}
		else 
		{
			echo"no se pudo ListarUsuariosDeposito";
		}
	}
 } ?>