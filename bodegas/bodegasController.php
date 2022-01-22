<?php

$id         =   ( isset( $_POST['id'] ) )           ?   $_POST['id']                    :   NULL;
$nombre     =   ( isset( $_POST['nombre'] ) )       ?   strtoupper( $_POST['nombre'] )  :   NULL;
$localidad  =   ( isset( $_POST['localidad'] ) )    ?   $_POST['localidad']             :   NULL;
$usuario    =   ( isset( $_POST['usuario'] ) )      ?   $_POST['usuario']               :   NULL;

$p          =   $_POST['p'];

$datos      =   array(  'nombre'    =>  $nombre,
                        'localidad' =>  $localidad,
                        'usuario'   =>  $usuario
                    );
switch ($p):
    case 'update':
        $model->Update( $class, $datos, $id );
        require_once $class.'View.php';
        break;

    case 'delete':
        $model->Delete( $class, $id );
        $clase->eliminarBodegas('bodega'.$id);
        require_once $class.'View.php';
        break;


    case 'save':
        $model->Create( $class, $datos );
        $idBodega   =   $model->ShowAll( $class, '' );
        foreach( $idBodega as $row ):
        endforeach;
        $clase->agregarBodegas( 'bodega'.$row['id'] );
        require_once $class.'View.php';
        break;

    case 'edit':
        require_once $class.'Edit.php';
        break;


    case 'create':
        require_once $class.'Create.php';
        break;

    
    default:
        require_once $class.'View.php';
        break;
endswitch;
?>