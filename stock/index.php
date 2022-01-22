<?php 

session_start();
date_default_timezone_set( 'America/Santiago' );
if($_SESSION):

    $class	=	'stock';

    require_once '../../config/model.class.php';
    $model  =   new model;

    require_once $class.'Model.php';
    $clase  = new $class;

    require_once '../../config/permisos.php';
else:
    header('Location:../login/');
endif;
?>