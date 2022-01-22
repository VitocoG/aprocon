<?php   

$id             =   $_REQUEST['id'];
$nombre         =   $_REQUEST['nombre'];
$rut            =   $_REQUEST['rut'];
$direccion      =   $_REQUEST['direccion'];
$giro           =   $_REQUEST['giro'];
$telefono       =   $_REQUEST['telefono'];
$mail           =   $_REQUEST['mail'];
$ciudad         =   $_REQUEST['ciudad'];
$peticion       =   $_REQUEST['p'];
$datos          = array(
                        'nombre'    => $nombre,
                        'rut'       => $rut,
                        'direccion' => $direccion,
                        'giro'      => $giro,
                        'telefono'  => $telefono,
                        'mail'      => $mail,
                        'ciudad'    => $ciudad,
                    );

switch ($peticion):
    case 'save':
        $model->Create( $clase, $datos );
        break;

    case 'update':
        $model->Update( $clase, $datos, $id );
        break;

        case 'delete':
            $model->Delete( $clase, $id );
            break;

    case 'create':
        require_once ( 'createView.php');
        break;

    case 'edit':
        require_once ( 'updateView.php' );
        break;
    
    default:
        require_once ( 'indexView.php' );
        break;
endswitch;
header ( 'Location:../'.$clase );
?>