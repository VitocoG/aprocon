<?php 
require_once '../../config/config.class.php';

class proveedores
{
	var $con;

	/*===================================
	=            CONSTRUCTOR            =
	===================================*/
	function __construct()
		{
			$this->conexion = new config;
		}
	/*=====  End of CONSTRUCTOR  ======*/

	
    public function ListarDatosInicio( )
	{
		if ( $con   = $this->conexion->conectar() ):
			$sql	= "SELECT
							id, 
							nombre, 
							giro, 
							localidad, 
							ciudad, 
							oc
						FROM
							proveedores";
			$res	=	$con->query( $sql );
			$this->conexion->cerrar();
			return $res;
		endif;
	}
    
}
