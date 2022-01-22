<?php

$p  =   ( isset( $_POST['p'] ) )    ?   $_POST['p'] :   NULL;

switch ($p):
    case 'usuarios':
        require_once 'usuarios.php';
        break;

    case 'localidades':
        require_once 'localidades.php';
        break;
    
    default:
        require_once $class.'View.php';
        break;
endswitch;

?>