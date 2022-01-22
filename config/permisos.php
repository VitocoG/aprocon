<?php
#   SI USUARIO HA INICIADO SESION, CONSULTA SI TIENE PERMISOS PARA ACCEDER AL MODELO
if( $_SESSION ):
    # METODO PARA CONSULTAR PERMISOS
    $permisos   =   $clase->Permisos( $class, $_SESSION['id'] );

    foreach ( $permisos as $key ):
        # SI LA CONSULTA == 1, TIENE ACCESO
        if ( $key[$class] == '1' ):
            require_once $class.'Controller.php';
        else:
            # NO HAY PERMISOS, VUELVE AL LOGIN
            header( 'Location:../login/' );
        endif;
    endforeach;  
else:
    # NO HA INICIADO SESION, VUELVE AL LOGIN
    header( 'Location:/');
endif;