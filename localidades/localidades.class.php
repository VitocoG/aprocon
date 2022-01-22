<?php 
require_once('../../config/config.class.php');

class localidades
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

	

	/*=========================================================
	=            VERIFICAR SI EXISTE FORMA DE PAGO            =
	=========================================================*/
	function Verificar( $nombre )
	{
		if ( $con 	= $this->conexion->conectar() )
		{
			$sql	=	"SELECT * FROM formadepagos WHERE nombre = {$nombre}";
			$res	=	$con->query( $sql );
			$cont 	= $res->num_rows;
			$this->conexion->cerrar();
			return $cont;
		}
		else
		{
			echo "no se puede Verificar Forma de Pago";
		}
	}
	/*=====  End of VERIFICAR SI EXISTE FORMA DE PAGO  ======*/	
}
?>