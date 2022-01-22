<?php require_once ( '../../config/core.class.php' );

$core 			=	new core;

$id 		=	$_REQUEST['id'];
$nombre 	= "'".$_REQUEST['nombre']."'" ;
$rut 	= "'".$_REQUEST['rut']."'" ;
$peticion	= $_REQUEST['p'];


switch ( $peticion )
{
	case 'nuevo':
		if ( $verificar	= $core->SelectByKey( 'itos', $rut ) )
			{
				header( 'Location:create.php' );
			}
			else
			{
				$datos 		= 	array( 
					'nombre'	=> 	$nombre,
					'rut'		=>	$rut
				 );
				$core->Create( 'itos', $datos );
				header( 'Location:index.php' );
			}
		break;

	case 'actualizar':
		$datos 			= 	array(
			'nombre' 	=> $nombre,
			'rut'		=>	$rut 
		);
		if ( $update	=	$core->Update( 'itos', $datos, $id ) )
			{
				header( 'Location:index.php' );
			}
			break;

	case 'eliminar':
		if( $query = $core->Delete( 'itos', $id ) )
			{
				header( 'Location:index.php' );
			}
			break;
}
?>