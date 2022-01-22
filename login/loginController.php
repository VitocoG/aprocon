<?php

$email      =   ( isset( $_POST['txtEmail'] ) ) ? $_POST['txtEmail']: NULL;
$pass       =   ( isset( $_POST['txtPass'] ) )  ? $_POST['txtPass'] : NULL;
$p          =   ( isset( $_REQUEST['p'] ) )     ? $_REQUEST['p']    : NULL;

$verificar  =   $usuarios->Login( $email, $pass );

switch ($p):
    case 'destroy':
        session_destroy();
        header( 'Location:./' );
        break;
    
    default:
        if( $_SESSION ):
            $usuarios->contrato( $_SESSION['localidad'] );
            require_once 'inicio.php';
        else:
            require_once $class.'View.php';
        endif; 
    break;
endswitch;