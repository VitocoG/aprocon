<?php
# VARIABLES DE LOS FORMULARIOS
    # VARIABLES DE LA TABLA HORAS EXTRAS
    $id             = $_REQUEST['id']              ??  NULL;
    $fecha_inicio   = $_POST['fecha_inicio']    ??  date( 'Y-m-d H:i' );
    $fecha_termino  = $_POST['fecha_termino']   ??  '0000-00-00 00:00';
    $total_horas    = $_POST['total_horas']     ??  '0';
    $motivo         = isset( $_POST['motivo'] ) ?   strtoupper( $_POST['motivo'] ) : NULL;
    $trabajador     = $_POST['trabajador']      ??  NULL;
    $jefe_terreno   = $_POST['jefe_terreno']    ??  $_SESSION['id'];
    $ods            = $_POST['ods']             ??  NULL;
    $estado         = $_POST['estado']          ??  '0';

    # VARIABLES DE FILTRO EN FORMULARIOS
    $localidad      =   $_POST['localidad']     ??  "0";
    $mes            =   $_POST['mes']           ??  date( 'm' ); 
    $anio           =   $_POST['anio']          ??  date( 'Y' );
    $p              =   $_REQUEST['p']             ??  NULL;

# ARREGLOS
$datosHoras         =   array(
                            'fecha_inicio'  =>  $fecha_inicio, 
                            'fecha_termino' =>  $fecha_termino,
                            'total_horas'   =>  $total_horas, 
                            'motivo'        =>  $motivo,
                            'trabajador'    =>  $trabajador, 
                            'jefe_terreno'  =>  $jefe_terreno,
                            'ods'           =>  $ods,   
                            'estado'        =>  $estado
                        ); 
#SWITCH
switch ($p):  
    /* ELIMINAR UN REGISTRO */
    case 'Delete':
        if( $clase->Delete( $class, $id ) ):
            # METODO PARA BUSCAR REGISTROS DEL TRABAJADOR POR SU ID 
            $nombreTrabajador = $clase->ShowById( 'trabajadores', $trabajador );
            $listarDetalle  =   $clase->listarDetalle( $trabajador, $anio, $mes );
            require_once $class.'Detalle.php';
        else:
            echo 'no se pudo Delete';
        endif;
        break;


    
    /* MOSTRAR LAS HORAS DEL JEFE DE TERRENO EN EL MES */
    case 'JefeTerreno':
        $horas = $clase->ShowAll( $class, ' WHERE jefe_terreno = '.$_SESSION['id'].' AND fecha_inicio LIKE "'.$anio.'-'.$mes.'%" AND estado = 0' );
        require_once $class.$p.'.php';
        break;


    /* MOSTRAR LAS HORAS ACTIVAS */
    case 'HorasActivas':
        /* SI EL USUARIO ES JEFE DE TERRENO */
        if( $_SESSION['perfil'] == 3 ):
            /* PUEDE VER HORAS ACTIVAS DE LA LOCALIDAD */
            $horasActivas = ' AND trabajadores.localidad = '.$_SESSION['localidad'];
        /* SI EL USUARIO ES ADMINISTRADOR DE SISTEMA */
        elseif( $_SESSION['perfil'] == 1 ):
            /* PUEDE VER TODAS LAS HORAS ACTIVAS */
            $horasActivas = '';
        endif;
            # REQUIERE TABLA CON LAS HORAS ACTIVAS
        $listarHorasActivas = $clase->listarHorasActivas( $horasActivas );
        require_once $class.'ListarHoras.php';
        break;

    #   IMPRIMIR PDF DE LA HORA EXTRA GENERADA
    case 'Pdf':
        # CLASE PARA MOSTRAR LOS REGISTROS DE LA HORA EXTRA GENERADA EN UN PDF
        $informe    =   $clase->pdf( $id );
        # CLASE PARA GENERAR UN PDF
        require_once '../../public/dompdf/autoload.inc.php';
        # VISTA CON TODO LO NECESARIO PARA IMPRIMIR EL PDF
        require_once 'pdf.php';
        break;

    #   METODO PARA GUARDAR LOS CAMBIOS DE EDICION DE LA HORA EXTRA
    case 'Save':
        if( $clase->Update( $class, $datosHoras, $id ) ):
            # METODO PARA BUSCAR REGISTROS DEL TRABAJADOR POR SU ID 
            $nombreTrabajador = $clase->ShowById( 'trabajadores', $trabajador );
            $listarDetalle  =   $clase->listarDetalle( $trabajador, $anio, $mes );
            require_once $class.'Detalle.php';
        else:
            require_once $class.'Edit.php';
        endif;
        break;

    #   FORMULARIO PARA EDITAR REGISTROS DE HORA EXTRA DE UN TRABAJADOR ESPECIFICO
    case 'Edit':
        #   BUSCAMOS LA HORA EXTRA A MODIFICAR
        $ShowById   =   $clase->ShowById( $class, $id );
        # METODO PARA LISTAR LOS JEFES DE TERRENO DE LA LOCALIDAD DEL TRABAJADOR
        $listarJefesDeTerreno = $clase->listarJefesDeTerreno( $trabajador );
        #   METODO PARA MOSTRAR LOS TRABAJADORES DE LA LOCALIDAD
        $SelectByKey = $clase->SelectByKey( 'trabajadores', 'localidad', $localidad, ' ORDER BY apellido, nombre' );
        require_once $class.$p.'.php';
        break;


    # FORMULARIO PARA CREAR HORAS EXTRAS DESDE UN TRABAJADOR
    case 'CreateTrabajador':
        # METODO PARA BUSCAR REGISTROS DEL TRABAJADOR POR SU ID 
        $ShowById   =   $clase->ShowById( 'trabajadores', $trabajador );
        # METODO PARA LISTAR LOS JEFES DE TERRENO DE LA LOCALIDAD DEL TRABAJADOR
        $listarJefesDeTerreno = $clase->listarJefesDeTerreno( $trabajador );
        $validarTrabajador = $clase->validarTrabajador( $trabajador );
        require_once $class.$p.'.php';
        break;

    case 'SaveAdmin':
        ### GUARDA LA HORA CREADA EN LA BD
        if( $clase->Create( $class, $datosHoras ) ):
        ### SI CREA LA HORA, EL TRABAJADOR QUEDA EN ESTADO "1" ( TRABAJANDO )
            $datosTrabajador = array( 'estado' => '1' );
            $clase->Update( 'trabajadores', $datosTrabajador, $trabajador );
            /* SI EL USUARIO ES JEFE DE TERRENO */
            if( $_SESSION['perfil'] == 3 ):
                /* PUEDE VER HORAS ACTIVAS DE LA LOCALIDAD */
                $horasActivas = ' AND trabajadores.localidad = '.$_SESSION['localidad'];
            /* SI EL USUARIO ES ADMINISTRADOR DE SISTEMA */
            elseif( $_SESSION['perfil'] == 1 ):
                /* PUEDE VER TODAS LAS HORAS ACTIVAS */
                $horasActivas = '';
            endif;
                # REQUIERE TABLA CON LAS HORAS ACTIVAS
            $listarHorasActivas = $clase->listarHorasActivas( $horasActivas );
            require_once $class.'ListarHoras.php';
       else:
        ### SI NO SE CREA LA HORA, REQUIERE EL FORMULARIO PARA CREAR HORAS EXTRAS
            # METODO PARA BUSCAR REGISTROS DEL TRABAJADOR POR SU ID 
            $ShowById   =   $clase->ShowById( 'trabajadores', $trabajador );
            # METODO PARA LISTAR LOS JEFES DE TERRENO DE LA LOCALIDAD DEL TRABAJADOR
            $listarJefesDeTerreno = $clase->listarJefesDeTerreno( $trabajador );
            require_once $class.'CreateTrabajador.php';
        endif;
        break;

    case 'Stop':
        ### FINALIZA HORA EXTRA ACTIVA
            # CONVERTIR HORA, PARA CALCULAR EL TOTAL
            $inicio =   strtotime( $fecha_inicio );
            $fin    =   strtotime( date( 'Y-m-d H:i' ) );
            $total  =   ( $fin - $inicio )/3600;
            # ARREGLO CON DATOS A ACTUALIZAR EN EL MODELO HORAS EXTRAS
            $datosHoras = array( 
                                'fecha_termino' => date( 'Y-m-d H:i' ),
                                'total_horas'   =>  $total,
                                'estado'        => '0'
                                );
            # METODO PARA ACTUALIZAR REGISTROS DE LA HORA EXTRA FINALIZADA
            $clase->Update( $class, $datosHoras, $id );
            # EL TRABAJADOR QUEDA EN ESTADO "0" ( SIN HORA EXTRA ACTIVA )
                $datosTrabajador = array( 'estado' => '0' );
                $clase->Update( 'trabajadores', $datosTrabajador, $trabajador );
            # REQUERIR TABLA CON HORAS EXTRAS ACTIVAS
        /* SI EL USUARIO ES JEFE DE TERRENO */
        if( $_SESSION['perfil'] == 3 ):
            /* PUEDE VER HORAS ACTIVAS DE LA LOCALIDAD */
            $horasActivas = ' AND trabajadores.localidad = '.$_SESSION['localidad'];
        /* SI EL USUARIO ES ADMINISTRADOR DE SISTEMA */
        elseif( $_SESSION['perfil'] == 1 ):
            /* PUEDE VER TODAS LAS HORAS ACTIVAS */
            $horasActivas = '';
        endif;
            # REQUIERE TABLA CON LAS HORAS ACTIVAS
        $listarHorasActivas = $clase->listarHorasActivas( $horasActivas );
        require_once $class.'ListarHoras.php';
        break;

    case 'Detalle':
        # METODO PARA BUSCAR REGISTROS DEL TRABAJADOR POR SU ID 
        $nombreTrabajador = $clase->ShowById( 'trabajadores', $trabajador );
        $listarDetalle  =   $clase->listarDetalle( $trabajador, $anio, $mes );
        require_once $class.$p.'.php';
        break;
    
    default:
    # FORMULARIO DE INICIO
        /* PARA FILTRAR POR LOCALIDAD */
        $selectLocalidad =  $localidad > 0  ?   ' AND localidades.id = '.$localidad : '';
        /* SI EL USUARIO ES JEFE DE CONTRATO O ASISTENTE ADMINISTRATIVO */
        $localidades          =   ( $_SESSION['perfil'] == 2 || $_SESSION['perfil'] == 6 ) ?
        /* PUEDE VER LOS TRABAJADORES DE LAS LOCALIDADES DEL CONTRATO */   
                                ' AND localidades.contrato = '.$_SESSION['contrato']  :
                                /* SI EL USUARIO ES JEFE DE TERRENO */   
                                    ( ( $_SESSION['perfil'] == 3 ) ? 
                                    /* SOLO PUEDE VER LOS TRABAJADORES DE SU LOCALIDAD */
                                    ' AND localidades.id = '.$_SESSION['localidad'] : 
                                        /* SI EL USUARIO ES ADMINISTRADOR DEL SISTEMA */
                                        ( ( $_SESSION['perfil'] == 1 ) ? 
                                        /* PUEDE VER TODOS LOS TRABAJADORES */
                                        '' : $localidades ) );
        /* METODO PARA VER LOS TRABAJADORES Y FILTRAR POR LOCALIDAD */                                        
        $listarTodosUsuarios=   $clase->listarTodosUsuarios( $localidades, $selectLocalidad );
        /* SI EL USUARIO ES JEFE DE TERRENO */
        $loc                =   ( $_SESSION['perfil'] == 3 ) ?
                            /* PUEDE VER SU LOCALIDAD */
                            ' WHERE id = '.$_SESSION['localidad'] :
                                /* SI EL USUARIO ES JEFE DE CONTRATO O ASISTENTE ADMINISTRATIVO */
                                ( ( $_SESSION['perfil'] == 2 || $_SESSION['perfil'] == 6 ) ?
                                /* PUEDE VER LAS LOCALIDADES DE SU CONTRATO */
                                ' WHERE contrato ='.$_SESSION['contrato'] : 
                                    /* DE LO CONTRARIO, PUEDE VER TODAS LAS LOCALIDADES */
                                    '' );
        /* METODO PARA MOSTRAR LAS LOCALIDADES */                            
        $listarLocalidades  =   $clase->ShowAll( 'localidades' , $loc.' ORDER BY nombre' );
        /* METODO PARA MOSTRAR LOS MESES */
        $listarMeses        =   $clase->ShowAll( 'meses' , ' ' );
        require_once $class.'View.php'; 
        break;
endswitch;