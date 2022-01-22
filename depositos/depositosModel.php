<?php 
require_once ( '../../config/config.class.php' );

class depositos extends model
{
 	var $con; 


	function __construct()
	{
		$this->conexion 	=	new config;
	}


 	function ListarDepositos()
 	{
		if ($con = $this->conexion->conectar()):
			$sql 	=	"SELECT 
                        	d.id as id, 
                            u.nombre as nombre, 
                            d.monto as monto, 
                            d.detalle as detalle, 
                            d.fecha fecha 
                        FROM depositos d 
                        INNER JOIN usuarios u ON u.id=d.usuario 
                        WHERE year(d.fecha) = year(now())
                        ORDER BY d.id DESC";

			$res=$con->query($sql);
			$this->conexion->cerrar();
			return $res;
		else:
			echo"no se pudo ListarDepositos";
		endif;
	}


 	function ListarDepositosFecha()
 	{
		if ($con=$this->conexion->conectar()):
			$sql 	=	"SELECT 
							DATE_FORMAT(fecha, '%d-%m-%y') fechas, 
							monto 
						FROM depositos 
						WHERE usuario = ".$_SESSION['id']."
						ORDER BY fecha DESC LIMIT 1 ";

			$res=$con->query($sql);
			$this->conexion->cerrar();
			return $res;
		else:
			echo"no se pudo ListarDepositosFecha";
		endif;
	}


 	function ListarDepositoTotal()
 	{
		if ($con=$this->conexion->conectar()):
			$sql 	=	"SELECT SUM(monto) monto FROM depositos WHERE usuario =".$_SESSION['id']."";

			$res=$con->query($sql);
			$this->conexion->cerrar();
			return $res;
		else:
			echo"no se pudo ListarDepositosFecha";
		endif;
	}


 	function ListarDepositosFiltro( $usuario, $mes, $anio )
 	{
		if ($con=$this->conexion->conectar()):
			$condicion	=	( $usuario == 0 )	?	" "	:	" depositos.usuario = $usuario
			AND ";
			$sql 	=	"SELECT
							depositos.id,
							usuarios.nombre,
							depositos.monto,
							depositos.detalle,
							DATE_FORMAT(depositos.fecha, '%d-%m-%Y') fecha
						FROM depositos
						JOIN usuarios
							ON usuarios.id = depositos.usuario
						WHERE $condicion
						MONTH(depositos.fecha) = $mes
						AND YEAR(depositos.fecha) = $anio
						ORDER BY depositos.id DESC";

			$res=$con->query($sql);
			$this->conexion->cerrar();
			return $res;
		else:
			echo"no se pudo ListarDepositosFiltro";
		endif;
	}
	
	


 	function ListarUsuariosDeposito()
 	{
		if ($con =$this->conexion->conectar()):
			$sql 	=	"SELECT * 
			            FROM usuarios
			            WHERE (perfil=2 OR perfil=3 OR perfil=5 OR perfil=1)
			            AND estado ='ACTIVO'
			            ORDER BY nombre";

			$res=$con->query($sql);
			$this->conexion->cerrar();
			return $res;
		else:
			echo"no se pudo ListarUsuariosDeposito";
		endif;
	}
 } ?>