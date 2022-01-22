<?php 
$id 	= 	$_REQUEST['id'];

require_once 'usuarios.class.php';
$usuarios 	= new usuarios;

$usuarios->UpdateUsuariosEstado( $id );

header( 'Location:index.php' );
 ?>