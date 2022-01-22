<?php

$id             =   $_POST['id']                ?? NULL;
$fecha_inicio   =   $_POST['fecha_inicio']      ?? date( 'Y-m-d H:i' );
$fecha_termino  =   $_POST['fecha_termino'];
$total_horas    =   $_POST['total_horas']       ?? '0';
$motivo         =   isset( $_POST['motivo'] )   ?   strtoupper( $_POST['motivo'] )  :   NULL;
$trabajador     =   $_POST['trabajador'];
$jefe_terreno   =   $_POST['jefe_terreno']      ?? $_SESSION['id'];
$ods            =   $_POST['ods'];
$estado         =   $_POST['estado']            ?? 0;
   
$loc            =   $_POST['localidad']         ?? $_SESSION['localidad'];
$mes            =   $_POST['mes']               ?? date('m');
$anio           =   $_POST['anio']              ?? date('Y');

$p              =   $_REQUEST['p']              ?? NULL;

$datos          =   array( 
                            'fecha_inicio'  => $fecha_inicio,
                            'fecha_termino' => $fecha_termino,
                            'total_horas'   => $total_horas, 
                            'motivo'        => $motivo, 
                            'trabajador'    => $trabajador,
                            'jefe_terreno'  => $jefe_terreno,
                            'ods'           => $ods, 
                            'estado'        => $estado
                        );

$datos_trabajador=  array(
                            'estado'        => $estado
                        );                        

if(!$_SESSION):
    header( 'Location:../../' );
else:
switch ($p):
    case 'update':
        $clase->Update( $class, $datos, $id );
        require_once $class.'View.php';
        break;


    case 'delete':
        $clase->Delete( $class, $id );
        require_once $class.'View.php';
        break;

    #   DETENER LA HORA EXTRA
    case 'stop':
        #   BUSCAMOS LA HORA EXTRA A ACTUALIZAR
        $query  =   $clase->ShowById( $class, $id, '' );
        $inicio     =   strtotime( $query['fecha_inicio'] );
        #   CONVERTIMOS LA HORA DE TERMINO PARA SACAR LA DIFERENCIA DE HORAS
        $termino    =   strtotime( date( 'Y-m-d H:i' ) );
        $diferencia =   ($termino - $inicio )/3600 ;
        #   CREAMOS EL ARRAY CON LOS DATOS ACTUALIZADOS
        $datos = array( 'fecha_termino' =>  date( 'Y-m-d H:i' ),
                        'total_horas'   =>  $diferencia,
                        'estado'        =>  $estado
                    );
        #   ACTUALIZAMOS LOS REGISTROS DE LA HORA EXTRA                    
        $clase->Update( $class, $datos, $id );
        #   MODIFICAMOS EL ATRIBUTO "ESTADO" PARA INDICAR QUE EL TRABAJADOR ESTA LIBRE
        $datos_trabajador['estado'] = 0;
        #   ACTUALIZAMOS EL REGISTRO DEL TRABAJADOR
        $clase->Update( 'trabajadores', $datos_trabajador, $trabajador );
        #   LLAMAMOS A LA VISTA PRINCIPAL DEL JEFE DE TERRENO
        require_once './JefeTerreno.php';/**/
        break;

    #   COMENZAR LA HORA EXTRA
    case 'start':
        $datos['estado']    =   1;
        $clase->Create( $class, $datos );
        $datos_trabajador['estado'] = 1;
        $clase->Update( 'trabajadores', $datos_trabajador, $trabajador );
        require_once './JefeTerreno.php';
        break;

    case 'pdf':
        require_once 'pdf.php';
        break;    

    case 'new':
        require_once $class.'Create.php';
        break;

    case 'pdf':
        require_once './pdf/horas.php';
        break;

    case 'edit':
        require_once './update.php';
        break;

    case 'details':
        $trabajadores   =   $clase->ShowById( 'trabajadores', $trabajador, '' );
        require_once 'details.php';
        break;
    
    default:
        if( $_SESSION['perfil'] == 1 || $_SESSION['perfil'] == 2 || $_SESSION['perfil'] == 6 ):
            #   SI EL USUARIO ES ADMINISTRADOR, SE LLAMA A LA VISTA PRINCIPAL
            require_once $class.'View.php';
        else:
            #   SI NO ES ADMINISTRADOR, LLAMAMOS A LA VISTA DE JEFES DE TERRENO
            require_once './JefeTerreno.php';
        endif;
    break;
endswitch;
endif;
?>