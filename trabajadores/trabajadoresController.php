<?php
$id                 =   $_POST['id']                    ??  NULL;
$nombre             =   isset( $_POST['nombre'] )       ?   strtoupper( $_POST['nombre'] ) :   NULL;
$apellido           =   isset( $_POST['apellido'] )     ?   strtoupper( $_POST['apellido'] ):   NULL;
$rut                =   $_POST['rut']                   ??  NULL;
$fecha              =   $_POST['fecha']                 ??  NULL;
$domicilio          =   isset( $_POST['domicilio'] )    ?   strtoupper( $_POST['domicilio'] ) :   NULL;
$localidad          =   $_POST['localidad']             ??  NULL;
$ecivil             =   $_POST['ecivil']                ??  NULL;
$telefono           =   $_POST['telefono']              ??  NULL;
$estudios           =   $_POST['estudios']              ??  NULL;
$titulo             =   $_POST['titulo']                ??  NULL;
$licencia           =   $_POST['licencia']              ??  NULL;
$talla              =   $_POST['talla']                 ??  NULL;
$calzado            =   $_POST['calzado']               ??  NULL;
$alergia            =   $_POST['alergia']               ??  NULL;
$observaciones      =   isset( $_POST['observaciones'] )?   strtoupper( $_POST['observaciones']) :   NULL;
$cargo              =   $_POST['cargo']                 ??  NULL;
$ingreso            =   $_POST['ingreso']               ??  NULL;
$retiro             =   $_POST['retiro']                ??  NULL;
$supervisor         =   $_POST['supervisor']            ??  NULL;
$brigada            =   $_POST['brigada']               ??  NULL;
$afp                =   $_POST['afp']                   ??  NULL;
$salud              =   $_POST['salud']                 ??  NULL;
$cargas             =   $_POST['cargas']                ??  NULL;
$accidenteNombre    =   isset( $_POST['accidenteNombre'] )?   strtoupper( $_POST['accidenteNombre'] ) :   NULL;
$accidenteNumero    =   $_POST['accidenteNumero']       ??  NULL;
$estado             =   $_POST['estado']                ??  NULL;
$activo             =   $_POST['activo']                ??  NULL;

$p                  =   $_POST['p']                     ??    NULL;

$datos 			= 	array( 
    'nombre'		    =>  $nombre,
    'apellido '			=>	$apellido ,
    'rut'	            =>	$rut,
    'fecha'             =>  $fecha,
    'domicilio'         =>  $domicilio,
    'localidad'         =>  $localidad,
    'ecivil'            =>  $ecivil,
    'telefono'          =>  $telefono,
    'estudios'          =>  $estudios,
    'titulo'            =>  $titulo,
    'licencia'          =>  $licencia,
    'talla'             =>  $talla,
    'calzado'           =>  $calzado,
    'alergia'           =>  $alergia,
    'observaciones'     =>  $observaciones,
    'cargo'             =>  $cargo,
    'ingreso'           =>  $ingreso,
    'retiro'            =>  $retiro,
    'supervisor'        =>  $supervisor,
    'brigada'           =>  $brigada,
    'afp'               =>  $afp,
    'salud'             =>  $salud,
    'cargas'            =>  $cargas,
    'accidenteNombre'   =>  $accidenteNombre,
    'accidenteNumero'   =>  $accidenteNumero,
    'estado'            =>  $estado,
    'activo'            =>  $activo
     );

switch ($p):
    case 'update':
        $clase->Update( $class, $datos, $id );
        require_once $class.'View.php';
        break;

    case 'save':
        $datos['estado']    =   0;
        $datos['activo']    =   0;
        $clase->Create( $class, $datos );
        require_once $class.'View.php';
        break;

    case 'edit':
        $trabajador =   $clase->ShowById( 'trabajadores', $id );
        $localidad  =   $clase->ShowAll( 'localidades', 'ORDER BY nombre' );
        $ecivil2    =   $clase->ShowAll( 'ecivil', '' );
        $estudios2  =   $clase->ShowAll( 'estudios', '' );
        $talla2     =   $clase->ShowAll( 'talla', '' );
        $calzado2   =   $clase->ShowAll( 'calzado' );
        $cargos     =   $clase->ShowAll( 'cargos', 'ORDER BY nombre' );
        $supervisor2=   $clase->ShowAll( 'usuarios', 'ORDER BY localidad, nombre' );
        $brigada2   =   $clase->ShowAll( 'brigadas', '' );
        $afp2       =   $clase->ShowAll( 'afp', 'ORDER BY nombre' );
        $salud2     =   $clase->ShowAll( 'salud', '' );
        require_once $class.'Edit.php';
        break;

    case 'create':
        $localidades =   $clase->ShowAll( 'localidades', '' );
        $ecivil    =   $clase->ShowAll( 'ecivil', '' );
        $estudios  =   $clase->ShowAll( 'estudios', '' );
        $talla     =   $clase->ShowAll( 'talla', '' );
        $calzado   =   $clase->ShowAll( 'calzado' );
        $cargos     =   $clase->ShowAll( 'cargos', 'ORDER BY nombre' );
        $supervisor=   $clase->ShowAll( 'usuarios', 'ORDER BY localidad, nombre' );
        $brigada   =   $clase->ShowAll( 'brigadas', '' );
        $afp       =   $clase->ShowAll( 'afp', 'ORDER BY nombre' );
        $salud     =   $clase->ShowAll( 'salud', '' );
        require_once $class.'Create.php';
        break;

    case 'pdf':
        require_once 'pdf.php';
        break;
    
        default:
        require_once $class.'View.php';
        break;
endswitch;

?>