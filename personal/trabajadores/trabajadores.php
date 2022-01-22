<?php 
require_once '../../config/core.class.php';

$core 		=	new core;	

$id 			=	$_REQUEST['id'];
$peticion		=	$_REQUEST['p'];
$estado         =	"'".$_REQUEST['estado']."'";

//##########    DATOS PERSONALES    ##########
$nombre 		=	"'".$_REQUEST['nombre']."'";
$apellido       =	"'".$_REQUEST['apellido']."'";
$rut            =	"'".$_REQUEST['rut']."'";
$fecha          =	"'".$_REQUEST['fecha']."'";
$domicilio      =	"'".$_REQUEST['domicilio']."'";
$localidad      =	"'".$_REQUEST['localidad']."'";
$ecivil         =	"'".$_REQUEST['ecivil']."'";
$telefono       =	"'".$_REQUEST['telefono']."'";
$estudios       =	"'".$_REQUEST['estudios']."'";
$titulo         =   "'".$_REQUEST['titulo']."'";
$licencia       =	"'".$_REQUEST['licencia']."'";
$talla          =   ( empty( $_REQUEST['talla'] ) ) ? "NULL" : "'".$_REQUEST['talla']."'";
$calzado        =   ( empty( $_REQUEST['calzado'] ) ) ? "NULL" : "'".$_REQUEST['calzado']."'";
$alergia        =   ( empty( $_REQUEST['alergia'] ) ) ? "NULL" : "'".$_REQUEST['alergia']."'";
$observaciones  =	( empty( $_REQUEST['observaciones'] )) ? "NULL" : "'".$_REQUEST['observaciones']."'";

//##########    DATOS LABORALES    ##########
$cargo 			=	"'".$_REQUEST['cargo']."'";
$ingreso        =	"'".$_REQUEST['ingreso']."'";
$retiro         =   ( empty( $_REQUEST['retiro'] )) ? "NULL" : "'".$_REQUEST['retiro']."'";
$supervisor     =	"'".$_REQUEST['supervisor']."'";
$brigada        =	( empty( $_REQUEST['brigada'] )) ? "NULL" : "'".$_REQUEST['brigada']."'";

//##########    DATOS PREVISIONALES    ##########
$afp            =	"'".$_REQUEST['afp']."'";
$salud          =	"'".$_REQUEST['salud']."'";
$cargas         =	"'".$_REQUEST['cargas']."'";
$accidenteNombre=	( empty( $_REQUEST['accidenteNombre'] )) ? "NULL" : "'".$_REQUEST['accidenteNombre']."'";
$accidenteNumero=	( empty( $_REQUEST['accidenteNumero'] )) ? "NULL" : "'".$_REQUEST['accidenteNumero']."'";
$estado         =	"'".$_REQUEST['estado']."'";





switch ( $peticion )
{
	case 'nuevo':
		
				$datos 		= 	array( 
					'nombre'		    =>  $nombre,
					'apellido '			=>	$apellido ,
					'rut'	            =>	$rut,
					'fecha'             =>  $fecha,
					'domicilio'         =>  $domicilio,
					'localidad'         =>  $localidad,
					'ecivil'            =>  $ecivil,
					'telefono'          =>  $telefono,
					'estudios'          =>  $estudios,
					'titulo'            =>  $titulo,
					'licencia'          =>  $licencia,
					'talla'             =>  $talla,
					'calzado'           =>  $calzado,
					'alergia'           =>  $alergia,
					'observaciones'     =>  $observaciones,
					'cargo'             =>  $cargo,
					'ingreso'           =>  $ingreso,
					'retiro'            =>  $retiro,
					'supervisor'        =>  $supervisor,
					'brigada'           =>  $brigada,
					'afp'               =>  $afp,
					'salud'             =>  $salud,
					'cargas'            =>  $cargas,
					'accidenteNombre'   =>  $accidenteNombre,
					'accidenteNumero'   =>  $accidenteNumero,
					'activo'            =>  $estado
					);
				if( $core->Create( 'trabajadores', $datos ) )
					{
						header( 'Location:index.php' );
					}
			
		break;

	case 'actualizar':
		$datos 			= 	array( 
					'nombre'		    =>  $nombre,
					'apellido '			=>	$apellido ,
					'rut'	            =>	$rut,
					'fecha'             =>  $fecha,
					'domicilio'         =>  $domicilio,
					'localidad'         =>  $localidad,
					'ecivil'            =>  $ecivil,
					'telefono'          =>  $telefono,
					'estudios'          =>  $estudios,
					'titulo'            =>  $titulo,
					'licencia'          =>  $licencia,
					'talla'             =>  $talla,
					'calzado'           =>  $calzado,
					'alergia'           =>  $alergia,
					'observaciones'     =>  $observaciones,
					'cargo'             =>  $cargo,
					'ingreso'           =>  $ingreso,
					'retiro'            =>  $retiro,
					'supervisor'        =>  $supervisor,
					'brigada'           =>  $brigada,
					'afp'               =>  $afp,
					'salud'             =>  $salud,
					'cargas'            =>  $cargas,
					'accidenteNombre'   =>  $accidenteNombre,
					'accidenteNumero'   =>  $accidenteNumero,
					'activo'            =>  $estado
					 );
		if ( $update	=	$core->Update( 'trabajadores', $datos, $id ) )
			{
				header( 'Location:index.php' );
			}
			break;

	case 'eliminar':
		if( $query = $core->Delete( 'trabajadores', $id ) )
			{
				header( 'Location:index.php' );
			}
			break;
}
?>