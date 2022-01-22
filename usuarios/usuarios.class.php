<?php 
require_once('../../config/config.class.php');

class usuarios
{
	var $con;

	/*===================================
	=            CONSTRUCTOR            =
	===================================*/
	function __construct()
		{
			$this->conexion 	= 	new config;
		}
	/*=====  End of CONSTRUCTOR  ======*/

	

	/*=========================================================
	=            VERIFICAR SI EXISTE USUARIO            =
	=========================================================*/
	function Verificar( $nombre, $rut, $email )
	{
		if ( $con 	= $this->conexion->conectar() )
		{
			$sql	=	"SELECT * FROM usuarios WHERE nombre = {$nombre} or rut = {$rut} or email = {$email}";
			$res	=	$con->query( $sql );
			$cont 	= $res->num_rows;
			$this->conexion->cerrar();
			return $cont;
		}
		else
		{
			echo "no se puede Verificar Usuario";
		}
	}
	/*=====  End of VERIFICAR SI EXISTE USUARIO  ======*/	


	/*================================================
	=            VERIFICAR USUARIO Y PASS            =
	================================================*/
	function Login( $email, $pass)
	{
		if ( $con 	=	$this->conexion->conectar() )
		{
			$sql 	=	"SELECT * FROM usuarios WHERE email = '".$email."' AND pass = '".$pass."'";
			$res 	= 	$con->query( $sql );
			$this->conexion->cerrar();

			$row 	= 	$res->num_rows;

			if ( $row > 0)
			{
				session_start();
				while ( $fila = $res->fetch_assoc() )
				{
					$_SESSION['nombre'] 	=	$fila['nombre'];
					$_SESSION['perfil'] 	=	$fila['perfil'];
					$_SESSION['id'] 	    =	$fila['id'];
					$_SESSION['localidad'] 	=	$fila['localidad'];
				}
			}
			return $row;
		}
	}	
	/*=====  End of VERIFICAR USUARIO Y PASS  ======*/



	/*=================================================
	=            Listar Todos los Usuarios            =
	=================================================*/
	function ListarTodosLosUsuarios()
	{
		if ( $con 	= 	$this->conexion->conectar() )
		{
			$sql 	= 	"SELECT u.id, u.rut, u.nombre, b.nombre as banco, u.tipo_cuenta, u.num_cuenta, u.email, per.nombre as perfil, l.nombre as localidad, u.estado FROM usuarios u INNER JOIN bancos b ON b.id = u.banco Inner JOIN localidades as l ON l.id=u.localidad INNER JOIN perfiles as per ON per.id=u.perfil ORDER BY u.estado, u.nombre";
			$res 	= 	$con->query( $sql );
			$this->conexion->cerrar();
			return $res;
		}
		else
		{
			echo "no se pudo ListarTodosLosUsuarios" ;
		}
	}
	/*=====  End of Listar Todos los Usuarios  ======*/
}
?>