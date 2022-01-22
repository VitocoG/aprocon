<?php require_once ( '../../config/core.class.php' );

$core 			=	new core;

$id 		=	$_REQUEST['id'];
$nombre 	= "'".$_REQUEST['nombre']."'" ;
$peticion	= $_REQUEST['p'];


switch ( $peticion )
{
	case 'nuevo':
		if ( $verificar	= $core->SelectByKey( 'localidades', $nombre ) )
			{
				header( 'Location:create.php' );
			}
			else
			{
				$datos 		= 	array( 'nombre' => $nombre );
				$core->Create( 'localidades', $datos );
				header( 'Location:index.php' );
			}
		break;

	case 'actualizar':
		$datos 			= 	array('nombre' => $nombre );
		if ( $update	=	$core->Update( 'localidades', $datos, $id ) )
			{
				header( 'Location:index.php' );
			}
			break;

	case 'eliminar':
		if( $query = $core->Delete( 'localidades', $id ) )
			{
				header( 'Location:index.php' );
			}
			break;
}
?>