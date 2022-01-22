<?php require_once ( '../../config/core.class.php' );

$core 			=	new core;

$id 		=	$_REQUEST['id'];
$nombre 	= "'".$_REQUEST['nombre']."'" ;
$peticion	= $_REQUEST['p'];


switch ( $peticion )
{
	case 'nuevo':
		if ( $verificar	= $core->SelectByKey( 'cargos', $nombre ) )
			{
				header( 'Location:create.php' );
			}
			else
			{
				$datos 		= 	array( 'nombre' => $nombre );
				$core->Create( 'cargos', $datos );
				header( 'Location:index.php' );
			}
		break;

	case 'actualizar':
		$datos 			= 	array('nombre' => $nombre );
		if ( $update	=	$core->Update( 'cargos', $datos, $id ) )
			{
				header( 'Location:index.php' );
			}
			break;

	case 'eliminar':
		if( $query = $core->Delete( 'cargos', $id ) )
			{
				header( 'Location:index.php' );
			}
			break;
}
?>