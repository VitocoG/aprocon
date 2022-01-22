<?php
$id         =   ( isset( $_POST['id'] ) )       ?   $_POST['id']        :   NULL;
$usuario    =   ( isset( $_POST['usuario'] ) )  ?   $_POST['usuario']   :   NULL;
$monto      =   ( isset( $_POST['monto'] ) )    ?   $_POST['monto']     :   NULL;
$detalle    =   ( isset( $_POST['detalle'] ) )  ?   $_POST['detalle']   :   NULL;
$fecha      =   ( isset( $_POST['fecha'] ) )    ?   $_POST['fecha']     :   date( 'Y-m-d');
$p          =   ( isset( $_POST['p'] ) )        ?   $_POST['p']         :   NULL;


$datos      =   array(
                    'usuario'   =>  $usuario,
                    'monto'     =>  $monto,
                    'detalle'   =>  strtoupper( $detalle ),
                    'fecha'     =>  $fecha
                    );
switch ($p):
    case 'update':
        $model->Update( $class, $datos, $id );
        require_once $class.'View.php';
        break;

    case 'save':
        $model->Create( $class, $datos );
        require_once $class.'Create.php';
        break;

    case 'delete':
        $model->Delete( $class, $id );
        require_once $class.'View.php';        

    case 'edit':
        $depositos  =   $model->ShowById( $class, $id );
        require_once $class.'Edit.php';
        break;

    case 'create':
        require_once $class.'Create.php';
        break;
    
    default:
        $usuarios   =   $clase->ShowAll( 'usuarios', ' WHERE perfil !=4 AND estado = "ACTIVO" ORDER BY nombre' );
        $meses  =   $clase->ShowAll( 'meses' , '' );
        require_once $class.'View.php';
        break;
endswitch;

?>  