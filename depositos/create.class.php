<?php 

require_once('../../config/core.class.php');
$core		=	new core;

$id 		= 	$_REQUEST['id'];
$usuario	=	"'".$_REQUEST['usuario']."'";
$monto		=	"'".$_REQUEST['monto']."'";
$detalle	=	"'".$_REQUEST['detalle']."'";
$fecha		= 	"'".date( 'Y-m-d' )."'";
$peticion	=	$_REQUEST['p'];

switch ( $peticion )
{
	case 'nuevo':
		if ( trim( $monto )==false || trim( $detalle )==false )
			{
				header( 'Location:create.php' );
			}
			else
			{
				$datos 		= 	array(  'usuario' 	=> 	$usuario, 
										'monto' 	=> 	$monto,
										'detalle' 	=> 	$detalle,
										'fecha'		=>	$fecha  );
				$core->Create( 'depositos', $datos );
			}
		break;
	
	case 'actualizar':
		$datos 		= 	array(  'usuario' 	=> 	$usuario, 
								'monto' 	=> 	$monto,
								'detalle' 	=>	$detalle );
		$core->Update( 'depositos', $datos, $id );
		break;

	case 'eliminar':
		$core->Delete( 'depositos', $id );
		break;
}


header( 'Location:index.php' );
?>