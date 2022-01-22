<?php
session_start();
$clase          =   'proveedores';

require_once ( '../../config/model.class.php' );
$model          =   new   model;

if( $_SESSION ):
    $permisos   =   $model->Permisos( $clase, 'permisos', $_SESSION['id'] );
    foreach( $permisos as $value ):
        ( $value[ $clase ] > 0 ) ? require_once( $clase.'Controller.php' ) : header( 'Location:../../' );
    endforeach;
else:
    header( 'Location:../../' );
endif;

?>