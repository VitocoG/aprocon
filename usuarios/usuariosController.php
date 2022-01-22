<?php
$id             =   ( isset( $_POST['id']))             ?   $_POST['id']            :   NULL;
$rut            =   ( isset( $_POST['rut']))            ?   $_POST['rut']           :   NULL;
$nombre         =   ( isset( $_POST['nombre']))         ?   strtoupper( $_POST['nombre'] )        :   NULL;
$banco          =   ( isset( $_POST['banco']))          ?   $_POST['banco']         :   NULL;
$tipo_cuenta    =   ( isset( $_POST['tipo_cuenta']))    ?   $_POST['tipo_cuenta']   :   NULL;
$num_cuenta     =   ( isset( $_POST['num_cuenta']))     ?   $_POST['num_cuenta']    :   NULL;
$email          =   ( isset( $_POST['email']))          ?   $_POST['email']         :   NULL;
$perfil         =   ( isset( $_POST['perfil']))         ?   $_POST['perfil']        :   NULL;
$localidad      =   ( isset( $_POST['localidad']))      ?   $_POST['localidad']     :   NULL;
$estado         =   ( isset( $_POST['estado']))         ?   strtoupper( $_POST['estado'] )       :   NULL;
$pass           =   ( isset( $_POST['pass']))           ?   $_POST['pass']          :   NULL;

$p              =   ( isset( $_POST['p'] ) )            ?   $_POST['p']             :   NULL;

$datos          = array(
                        'rut'           => $rut,
                        'nombre'        => $nombre,
                        'banco'         => $banco,  
                        'tipo_cuenta'   => $tipo_cuenta,
                        'num_cuenta'    => $num_cuenta,
                        'email'         => $email,
                        'perfil'        => $perfil,   
                        'localidad'     => $localidad, 
                        'estado'        => $estado,   
                        'pass'          => $pass, 
                    );

$datosPermisos = array(
                        'depositos'         => (isset( $_POST['depositos']) )       ? $_POST['depositos']       :   0, 
                        'usuarios'          => (isset( $_POST['usuarios']) )        ? $_POST['usuarios']        :   0, 
                        'trabajadores'      => (isset( $_POST['trabajadores']) )    ? $_POST['trabajadores']    :   0,
                        'saldos'            => (isset( $_POST['saldos']) )          ? $_POST['saldos']          :   0,  
                        'arriendo_retro'    => (isset( $_POST['arriendo_retro']) )  ? $_POST['arriendo_retro']  :   0,
                        'entrega'           => (isset( $_POST['entrega']) )         ? $_POST['entrega']         :   0,  
                        'localidades'       => (isset( $_POST['localidades']) )     ? $_POST['localidades']     :   0, 
                        'perfiles'          => (isset( $_POST['perfiles']) )        ? $_POST['perfiles']        :   0, 
                        'brigadas'          => (isset( $_POST['brigadas']) )        ? $_POST['brigadas']        :   0,
                        'itos'              => (isset( $_POST['itos']) )            ? $_POST['itos']            :   0,  
                        'cargos'            => (isset( $_POST['cargos']) )          ? $_POST['cargos']          :   0, 
                        'proveedores'       => (isset( $_POST['proveedores']) )     ? $_POST['proveedores']     :   0, 
                        'gastos'            => (isset( $_POST['gastos']) )          ? $_POST['gastos']          :   0, 
                        'horas_extras'      => (isset( $_POST['horas_extras']) )    ? $_POST['horas_extras']    :   0, 
                        'inventario'        => (isset( $_POST['inventario']) )      ? $_POST['inventario']      :   0, 
                    );                    

switch ($p):
    case 'save':
        $datos['estado']    =   "ACTIVO";
        $clase->Create( $class, $datos );
        require_once $class.'View.php';
        break;

    case 'update':
        $clase->Update( $class, $datos, $id );
        require_once $class.'View.php';
        break;

    case 'SavePermission':
        $clase->Update( 'permisos', $datosPermisos, $id );
        require_once $class.'View.php';
        break;

    case 'permission':
        require_once $class.'Permisos.php';
        break;

    case 'edit':
        $usuarios   =   $model->ShowById( $class, $id );
        require_once $class.'Edit.php';
        break;

    case 'create':
        require_once $class.'Create.php';
        break;
    
    default:
        $mostrar 	=	$clase->ListarTodosLosUsuarios();
        require_once $class.'View.php';
        break;
    endswitch;
?>