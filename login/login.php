<?php /*
session_start();
$email 		=	$_POST['txtEmail']; 
$pass 		=	$_POST['txtPass']; 


require_once '../usuarios/usuarios.class.php';
$usuarios 	= 	new usuarios;
$verificar 	= $usuarios->Login( $email, $pass );


if( $verificar == 1 ) 
	{
        $usuarios->contrato( $_SESSION['localidad'] );
		if( $_SESSION['perfil']==1 )
		{
			$header = '../saldos/';
		} 
		else
		{
			$header = '/gastos/gastos';
		}
	}
	else
	{
	    $header = 'index.php';
	}
header( 'Location:'.$header );*/

header( 'Location:/');
?>