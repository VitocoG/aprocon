<?php require_once ( '../../config/core.class.php' );

$core 			=	new core;

$id 		=	$_REQUEST['id'];
$nombre 	= "'".$_REQUEST['nombre']."'" ;
$peticion	= $_REQUEST['p'];
$header 	=	header( 'Location:index.php' );


switch ( $peticion )
{
	case 'nuevo':
		if ( $verificar	= $core->SelectByKey( 'brigadas', $nombre ) )
			{
				header( 'Location:create.php' );
			}
			else
			{
				$datos 		= 	array( 'nombre' => $nombre );
				$core->Create( 'brigadas', $datos );
				$header;
			}
		break;

	case 'actualizar':
		$datos 			= 	array('nombre' => $nombre );
		if ( $update	=	$core->Update( 'brigadas', $datos, $id ) )
			{
				$header;
			}
			break;

	case 'eliminar':
		if( $query = $core->Delete( 'brigadas', $id ) )
			{
				$header;
			}
			break;
}
?>