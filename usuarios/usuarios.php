<?php 
require_once '../../config/core.class.php';
require_once '../usuarios/usuarios.class.php';

$core 		=	new core;
$usuarios 	=	new usuarios;	

$id 			=	$_REQUEST['id'];
$nombre 		=	"'".$_REQUEST['nombre']."'";
$rut 			=	"'".$_REQUEST['rut']."'";
$banco			=	"'".$_REQUEST['banco']."'";
$tipo_cuenta 	=	"'".$_REQUEST['tipo_cuenta']."'";
$num_cuenta 	=	"'".$_REQUEST['num_cuenta']."'";
$email			=	"'".$_REQUEST['email']."'";
$perfil			=	"'".$_REQUEST['perfil']."'";
$localidad		=	"'".$_REQUEST['localidad']."'";
$estado			=	"'".$_REQUEST['estado']."'";
$pass			=	"'".$_REQUEST['pass']."'";
$peticion		=	$_REQUEST['p'];


switch ( $peticion )
{
	case 'nuevo':
		
				$datos 		= 	array( 
					'rut'			=>	$rut,	
					'nombre'		=>  $nombre,
					'banco'			=>	$banco,
					'tipo_cuenta'	=>	$tipo_cuenta,
					'num_cuenta'	=>	$num_cuenta,
					'email'			=>	$email,
					'perfil'		=>	$perfil,
					'localidad'		=> 	$localidad,
					'estado'		=>	$estado,
					);
				if( $core->Create( 'usuarios', $datos ) )
					{
						header( 'Location:index.php' );
					}
			
		break;

	case 'actualizar':
		$datos 			= 	array( 
					'rut'			=>	$rut,	
					'nombre'		=>  $nombre,
					'banco'			=>	$banco,
					'tipo_cuenta'	=>	$tipo_cuenta,
					'num_cuenta'	=>	$num_cuenta,
					'email'			=>	$email,
					'perfil'		=>	$perfil,
					'localidad'		=> 	$localidad,
					'estado'		=>	$estado,
					 );
		if ( $update	=	$core->Update( 'usuarios', $datos, $id ) )
			{
				header( 'Location:index.php' );
			}
			break;

	case 'eliminar':
		if( $query = $core->Delete( 'usuarios', $id ) )
			{
				header( 'Location:index.php' );
			}
			break;
}
?>