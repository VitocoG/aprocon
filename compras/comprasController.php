<?php

if( $_SESSION ):
/* VARIABLES DEL ENCABEZADO DE LA COMPRA */
$id             =   $_REQUEST['id']                     ??  NULL;
$fecha          =   $_POST['fecha']                     ??  date( 'Y-m-d' );
$formaPago      =   isset( $_POST['formaPago'] )        ?   strtoupper( $_POST['formaPago'] ) :   NULL;
$cotizacion     =   $_POST['cotizacion']                ??  NULL;
$proveedor      =   $_REQUEST['proveedor']              ??  NULL;
$total          =   $_POST['total']                     ??  0;
$solicita       =   $_POST['solicita']                  ??  $_SESSION['id'];
$finalizada     =   $_POST['finalizada']                ??  0;
$aprobada       =   $_POST['aprobada']                  ??  0;

/* VARIABLES DEL DETALLE DE LA CCOMPRA */
$idDet          =   $_POST['idDet']                     ??  NULL;
$medida         =   isset( $_POST['medida'] )           ?   strtoupper( $_POST['medida'] )    :   NULL;
$descripcion    =   isset( $_POST['descripcion'] )      ?   strtoupper( $_POST['descripcion'] )   :   NULL;
$cantidad       =   $_POST['cantidad']                  ??  0;
$valor          =   $_POST['valor']                     ??  0;
$total          =   $_POST['total']                     ??  0;


/* VARIABLE PARA BUSCAR MATERIAL EN EL DETALLE */
$buscar         =   $_POST['buscar']                    ??  NULL;

$nombreUsuario = $_POST['nombreUsuario'] ?? NULL;

/* VARIABLE DE ACCION */
$p              =   $_REQUEST['p']                      ??  NULL;

/* ARREGLO DEL ENCABEZADO */
$datosEnc       =   array(
                        'fecha'         =>  $fecha,
                        'formaPago'     =>  $formaPago,
                        'cotizacion'    =>  $cotizacion,
                        'proveedor'     =>  $proveedor,
                        'total'         =>  $total,
                        'solicita'      =>  $solicita,
                        'finalizada'    =>  $finalizada,
                        'aprobada'      =>  $aprobada 
                    );

/* ARREGLO DEL DETALLE */
$datosDet       =   array(
                        'medida'        =>  $medida,
                        'descripcion'   =>  $descripcion,
                        'cantidad'      =>  $cantidad,
                        'valor'         =>  $valor,
                        'total'         =>  $total,
                        'idEnc'         =>  $id 
                    );  
                    
                    
/* ARRAY PARA EDITAR EL TOTAL */
$datosTotal     =   array( 'total' => $total );                 

                


switch ($p):
    /* METODO PARA GUARDAR BORRADOR */
    case 'Save':
        /* ACTUALIZA EL TOTAL DE LA COMPRA */
        $clase->Update( $class.'_enc', $datosTotal, $id );
        /* SI ES ADMINISTRADOR, MUESRTRA LAS COMPRAS APROBADAS, SINO LAS GUARDADAS */
        $finalizada   =   ( $_SESSION['id'] > 11 ) ? 0 : 1;
        $SelectByKey = $clase->SelectByKey( $class.'_enc', 'finalizada', $finalizada, ' AND aprobada = 0 ORDER BY fecha' );
        /* VISTA PRINCIPAL */
        require_once $class.'View.php';
        break;


    /* ----------------------------------------------------------------------------------------------- */
    /* METODO PARA AUTORIZAR LA SOLICITUD Y GENERAR LA ORDEN DE COMPRA */
    case 'Autorizar':
        /* SE CAMBIA ESTADO A APROBADO = 1 */
        $datosAprobada   =   array( 'aprobada'   =>  1 );
        $clase->Update( $class.'_enc', $datosAprobada, $id );
        /* SE BUSCAN LOS REGISTROS DE LA COMPRA FINALIZADA */
        $ShowById = $clase->ShowById( $class.'_enc', $id );
        /* SE REGISTRA LA ORDEN DE COMPRA */
        $datosOC        =   array( 'fecha'  =>   date( 'Y-m-d'), 'autoriza' => $_SESSION['id'], 'solicita' => $ShowById['solicita'], 'compra' => $id );
        $clase->Create( 'oc', $datosOC );
        header( 'Location:../oc');
        break;

    
    /* ----------------------------------------------------------------------------------------------- */
    /* PARA IR A LA LISTA DE SOLICITUDES DESDE LAS NOTIFICACIONES */
    case 'oc':
        $fin = array('finalizado' => 1 );
        $clase->Update( 'notificaciones', $fin, $_REQUEST['idOC'] );
        $SelectByKey = $clase->SelectByKey( $class.'_enc', 'aprobada', 0, ' ORDER BY fecha' );
        require_once $class.'View.php';
        break;





    /* ----------------------------------------------------------------------------------------------- */
   /* PARA FINALIZAR LA SOLICITUD */
    case 'Close':
        /* ARRAY CON LA NUEVA FECHA INDICANDO QUE ESTA FINALIZADA */
        $datosEncFin = array('fecha' => $fecha, 'finalizada' => 1 );
        /* SE ACTUALIZAN LA NUEVA FECHA INDICANDO QUE YA ESTA FINALIZADA LA COMPRA */
        $clase->Update( $class.'_enc', $datosEncFin, $id );
        /* ACTUALIZA EL TOTAL DE LA COMPRA */
        $clase->Update( $class.'_enc', $datosTotal, $id );

        /* SI ES USUARIO, SE ENVIA NOTIFICACION A ADMINISTRACION */
        if( $_SESSION['perfil'] !=1 )
        {
            $datosOC = array('descripcion' => 'Solicitud de Compra de '.$solicita, 'url' => '?p=' );
            $clase->Create( 'notificaciones', $datosOC );
        }

        /* SI ES ADMINISTRADOR, MUESTRA FINALIZADAS */
        $finalizada   =   ( $_SESSION['id'] > 11 ) ? 0 : 1;
        $SelectByKey = $clase->SelectByKey( $class.'_enc', 'finalizada', $finalizada, ' AND aprobada = 0 ORDER BY fecha' );
        
        /* VISTA PRINCIPAL */
        require_once $class.'View.php';
        break;


    /* ----------------------------------------------------------------------------------------------- */
   /* PARA ELIMINAR REGISTRO DEL DETALLE */
    case 'DeleteDet':
        if( $clase->Delete( $class.'_det', $id ) ):
            $listarMaterialesProveedor = $clase->listarMaterialesProveedor( $proveedor );
            /* METODO PARA BUSCAR REGISTROS DE UN MATERIAL POR SU ID */
            if( $buscar == NULL ):
                $listarBuscar['material'] = '';
                $listarBuscar['descripcion'] = '';
            else:
                $listarBuscar = $clase->listarBuscar( $descripcion, $proveedor );
            endif;
            /* METODO PARA MOSTRAR REGISTROS INGRESADOS EN LA TABLA */
            $listarDetalle    =   $clase->listarDetalle( $id );
            require_once $class.'EditDet.php';
        else:
            echo 'no se pudo Eliminar';
        endif;
        break;

    /* ----------------------------------------------------------------------------------------------- */
   /* FORMULARIO PARA EDITAR EL ENCABEZADO */
    case 'EditEnc':
        $ShowById   =   $clase->ShowById( $class.'_enc', $id );
        require_once $class.$p.'.php';
        break;

    /* ----------------------------------------------------------------------------------------------- */
   /* FORMULARIO PARA EDITAR EL DETALLE */
    case 'EditDet':
        $clase->Update( $class.'_enc', $datosEnc, $id );
            $listarMaterialesProveedor = $clase->listarMaterialesProveedor( $proveedor );
            /* METODO PARA BUSCAR REGISTROS DE UN MATERIAL POR SU ID */
            if( $buscar == NULL ):
                $listarBuscar['material'] = '';
                $listarBuscar['descripcion'] = '';
            else:
                $listarBuscar = $clase->listarBuscar( $descripcion, $proveedor );
            endif;
            /* METODO PARA MOSTRAR REGISTROS INGRESADOS EN LA TABLA */
            $listarDetalle    =   $clase->listarDetalle( $id );
            $Solicita = $clase->ShowById( $class.'_enc', $id);
            $idSolicita = $Solicita['solicita'];
            $nombreSolicita = $clase->ShowById('usuarios', $idSolicita );
            require_once $class.$p.'.php'; 
        break;

    /* ----------------------------------------------------------------------------------------------- */
   /* FORMULARIO PARA CREAR EL ENCABEZADO */
    case 'CreateEnc':
        $ShowById   =   $clase->ShowById( 'proveedores', $proveedor );
        require_once $class.$p.'.php';
        break;

    /* ----------------------------------------------------------------------------------------------- */
   /* GUARDA EL ENCABEZADO Y ABRE FORMULARIO DEL DETALLE */
    case 'CreateDet':
        /* SI SE ALMACENAN LOS REGISTROS DEL ENCABEZADO.... */
        if( $clase->Create( $class.'_enc', $datosEnc ) ): 
            if( !isset( $_POST['id'] ) ):
                /* METODO PARA BUSCAR EL ID DEL ENCABEZADO GUARDADO */ 
                $listarUltimoEnc = $clase->ShowAll( $class.'_enc', ' ORDER BY id DESC LIMIT 1');
                foreach( $listarUltimoEnc as $valor ):
                    $id = $valor['id'];
                endforeach;
            endif;

            /* METODO PARA MOSTRAR LOS PRODUCTOS DEL PROVEEDOR */
            $listarMaterialesProveedor = $clase->listarMaterialesProveedor( $proveedor );
            if( $buscar == NULL ):
                $listarBuscar['material'] = '';
                $listarBuscar['descripcion'] = '';
            else:
                $listarBuscar = $clase->listarBuscar( $descripcion, $proveedor );
            endif;
            /* METODO PARA MOSTRAR REGISTROS INGRESADOS EN LA TABLA */
            $listarDetalle    =   $clase->listarDetalle( $id );
            require_once $class.$p.'.php';        
        else:
            echo 'no se pudo listarUltimoIdEnc';
        endif;         
        break; 


    /* ----------------------------------------------------------------------------------------------- */
   /* FORMULARIO PARA BUSCAR EL MATERIAL */
    case 'search':
        /* METODO PARA MOSTRAR LOS PRODUCTOS DEL PROVEEDOR */
        $listarMaterialesProveedor = $clase->listarMaterialesProveedor( $proveedor );
        /* METODO PARA BUSCAR REGISTROS DE UN MATERIAL POR SU ID */
         $listarBuscar = $clase->listarBuscar( $buscar, $proveedor );
        /* METODO PARA MOSTRAR REGISTROS INGRESADOS EN LA TABLA */
        $listarDetalle    =   $clase->listarDetalle( $id );
        $Solicita = $clase->ShowById( $class.'_enc', $id);
        $idSolicita = $Solicita['solicita'];
        $nombreSolicita = $clase->ShowById('usuarios', $idSolicita );
        require_once $class.'CreateDet.php';
        break;


    /* ----------------------------------------------------------------------------------------------- */
   /* FORMULARIO PARA AGREGAR MATERIALES A LA BD */
    case 'add':
        /* VERIFICA SI EL MATERIAL EXISTE EN EL DETALLE */
        if( $verificar = $clase->SelectByKey( $class.'_det', 'descripcion', $descripcion,  ' AND idEnc = '.$id ) ):
            /*  SI EXISTE ACTUALIZA */
            if( $verificar->num_rows > 0 ):
                $UpdateDetalle  =   $clase->UpdateDetalle( $id, $descripcion, $cantidad, ( $valor * $cantidad ) );
            /* SI NO EXISTE, LA CREA */
            else:
                $CreateDetalle = $clase->Create( $class.'_det', $datosDet );
            endif;
        else:
            echo 'NO SE PUDO VERIFICAR';
        endif;
        
        $listarMaterialesProveedor = $clase->listarMaterialesProveedor( $proveedor );
        /* METODO PARA BUSCAR REGISTROS DE UN MATERIAL POR SU ID */
        if( $buscar == NULL ):
            $listarBuscar['material'] = '';
            $listarBuscar['descripcion'] = '';
        else:
            $listarBuscar = $clase->listarBuscar( $descripcion, $proveedor );
        endif;
        /* METODO PARA MOSTRAR REGISTROS INGRESADOS EN LA TABLA */
        $listarDetalle    =   $clase->listarDetalle( $id );
        $Solicita = $clase->ShowById( $class.'_enc', $id);
        $idSolicita = $Solicita['solicita'];
        $nombreSolicita = $clase->ShowById('usuarios', $idSolicita );
        require_once $class.'EditDet.php';
        break;


    /* ELIMINAR UN REGISTRO DEL DETALLE */
    /* ---------------------------------------------------------------------------------------------- */
    case 'delete_det':
        if( $clase->Delete( $class.'_det', $idDet ) ):      
            /* METODO PARA MOSTRAR LOS PRODUCTOS DEL PROVEEDOR */
            $listarMaterialesProveedor = $clase->listarMaterialesProveedor( $proveedor );
            /* METODO PARA BUSCAR REGISTROS DE UN MATERIAL POR SU ID */
            if( $buscar == NULL ):
                $listarBuscar['material'] = '';
                $listarBuscar['descripcion'] = '';
            else:
                $listarBuscar = $clase->listarBuscar( $descripcion, $proveedor );
            endif;
            /* METODO PARA MOSTRAR REGISTROS INGRESADOS EN LA TABLA */
            $listarDetalle    =   $clase->listarDetalle( $id );
            require_once $class.'CreateDet.php';
        endif;
        break;
    
    /* ----------------------------------------------------------------------------------------------- */
    default:
        $finalizada   =   ( $_SESSION['id'] > 11 ) ? 0 : 1;
        $SelectByKey = $clase->SelectByKey( $class.'_enc', 'finalizada', $finalizada, ' AND aprobada = 0 ORDER BY fecha' );
        require_once $class.'View.php';
        break;
endswitch;

else:
    header('Location:../login/');
endif;