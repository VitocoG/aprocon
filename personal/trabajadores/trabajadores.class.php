<?php 
require_once('../../config/config.class.php');

class trabajadores
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

	


	 /*===================================
    =       LISTAR EN EL INICIO         =
    ===================================*/
	function ListarIndex( $localidad )
	{
		if ( $con 	= $this->conexion->conectar() )
		{
		    $loc    =   ( $localidad >= '0' ) ? "WHERE tra.localidad=$localidad" : " ";
			$sql	=	"SELECT tra.id, lo.nombre localidad,  tra.apellido, tra.nombre, tra.activo, tra.domicilio FROM trabajadores tra INNER JOIN localidades lo ON lo.id=tra.localidad ".$loc." ORDER BY lo.nombre,tra.apellido, tra.id, tra.estado";
			$res	=	$con->query( $sql );
			$this->conexion->cerrar();
			return $res;
		}
		else
		{
			echo "no se puede ListarIndex";
		}
	}
	
	
	function FichaPDF( $id )
	{
	    if ( $con   = $this->conexion->conectar() )
	    {
	        $sql    =   "SELECT tra.id id, 
                    tra.nombre nombre, 
                    tra.apellido apellido, 
                    tra.rut rut, 
                    tra.fecha fecha, 
                    tra.domicilio domicilio, 
                    lo.nombre localidad, 
                    ec.nombre ecivil, 
                    tra.telefono telefono, 
                    es.nombre estudio, 
                    tra.titulo titulo, 
                    tra.licencia licencia, 
                    ta.nombre talla, 
                    cal.nombre calzado, 
                    tra.alergia alergia, 
                    tra.observaciones observaciones, 
                    car.nombre cargo, 
                    tra.ingreso ingreso, 
                    tra.retiro retiro, 
                    usu.nombre supervisor, 
                    bri.nombre brigada, 
                    afp.nombre afp, 
                    sal.nombre salud, 
                    tra.cargas cargas, 
                    tra.accidenteNombre accidenteNombre, 
                    tra.accidenteNumero accidenteNumero

                    FROM trabajadores tra

                INNER JOIN localidades lo ON lo.id=tra.localidad
                INNER JOIN ecivil ec ON ec.id=tra.ecivil
                INNER JOIN estudios es ON es.id= tra.estudios
                INNER JOIN talla ta ON ta.id=tra.talla
                INNER JOIN calzado cal ON cal.id=tra.calzado
                INNER JOIN cargos car ON car.id=tra.cargo
                INNER JOIN usuarios usu ON usu.id=tra.supervisor
                INNER JOIN brigadas bri ON bri.id=tra.brigada
                INNER JOIN afp ON afp.id=tra.afp
                INNER JOIN salud sal ON sal.id=tra.salud
                
                WHERE tra.id=$id";
	    }
	}
}
?>