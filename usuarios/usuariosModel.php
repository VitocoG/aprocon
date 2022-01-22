<?php 
require_once('../../config/config.class.php');

class usuarios extends model
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
			$sql 	=	"SELECT * 
                        FROM usuarios 
                        WHERE email = '".$email."' 
                        AND pass = '".$pass."'";
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
			$sql 	= 	"SELECT 
							u.id, 
							u.rut, 
							u.nombre, 
							u.email, 
							per.nombre as perfil, 
							l.nombre as localidad, 
							u.estado 
						FROM usuarios u 
						JOIN localidades as l 
							ON l.id = u.localidad 
						JOIN perfiles as per 
							ON per.id = u.perfil 
						ORDER BY u.estado, u.nombre";
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
	
	
	/*=====  End of Listar Todos los Usuarios  ======*/


	function contrato( $localidad )
	{
		if( $con	=	$this->conexion->conectar() ):
			$sql	=	"SELECT * FROM localidades WHERE id = $localidad";
			$res	=	$con->query( $sql );
			$this->conexion->cerrar();

			if( $res->num_rows > 0 ):
				foreach ( $res as $value ):
					$_SESSION['contrato'] = $value['contrato'];
				endforeach;
			endif;
		else:
			print( "no se puede contrato()" );
		endif;

	}
}
?>