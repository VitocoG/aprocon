<?php 

session_start();

$class	=	'login';

require_once '../../config/model.class.php';
$model  =   new model;

require_once '../usuarios/usuariosModel.php';
$usuarios   =   new usuarios;

require_once $class.'Controller.php';
?>