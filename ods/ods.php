<?php
session_start();

require_once '../../config/core.class.php';
require_once 'ods.class.php';
$core   = new core;
$ods    = new ods;

// 	#####	VARIABLES RECIBIDAS DESDE LAS VISTAS 	#####
$id                         =   $_REQUEST['id'];
$codigo                     =   "'".$_REQUEST['codigo']."'";

// #####    SE TRANSFORMAN LAS HORAS EN ARRAY (QUITANDOLES LA LETRA T QUE ENVIA EL DATETIME)
$horaInicio                 =   explode( "T", $_REQUEST['inicio']);
$horaTermino                =   explode( "T", $_REQUEST['termino'] );
$cierre                     =   explode( "T", $_REQUEST['cierre'] );
// #####    SE TRANSFORMAN EN STRING LOS ARRAY DE TIEMPO PARA QUE SEAN ALMACENADOS
$inicio                     =   "'".$horaInicio[0]." ".$horaInicio[1]."'";
$termino                    =   ( empty( $_REQUEST['termino'] ) ) ? "'1111-11-11 00:00'" : ( "'".$horaTermino[0]." ".$horaTermino[1]."'" );
$cierreIto                  =   ( empty( $_REQUEST['cierre'] ) ) ? "'1111-11-11 00:00'" : ( "'".$cierre[0]." ".$cierre[1]."'" );

$descripcion                =   "'".$_REQUEST['descripcion']."'";
$ito                        =   "'".$_REQUEST['ito']."'";
$actividad                  =   "'".$_REQUEST['actividad']."'";
$brigada                    =   "'".$_REQUEST['brigada']."'";
$direccion                  =   "'".$_REQUEST['direccion']."'";
$localidad                  =   "'".$_REQUEST['localidad']."'";
$tipo_orden                 =   "'".$_REQUEST['tipo_orden']."'";
$prioridadOrden             =   ( $_REQUEST['tipo_orden'] == 1 ) ? ( "'".$_REQUEST['prioridad_orden']."'" ) : ( "'5'" ) ;
$jefeTerreno                =   "'".$_SESSION['id']."'";
$peticion                   =   $_REQUEST['p'];


//  #################################################    CALCULOS DE TIEMPOS DE EJECUCION DE LAS OBRAS     #############################################
//  #####   SE TRANSFORMAN LOS STRINGS DE TIEMPO EN ARRAYS DE TIEMPO PARA REALIZAR EL CALCULO   #####
$index                          =   implode( " ", $horaInicio );
$end                            =   implode( " ", $horaTermino );
$endIto                         =   ( empty( $_REQUEST['cierre'] ) ) ? "'1111-11-11 00:00'" : implode( " ", $cierre );
//$cierreContratista              =   ( $termino == "'1111-11-11 00:00:00'" ) ? $horaTermino : implode( " ", $termino );
//  #####   TIEMPOS QUE DEMORÓ EL CONTRATISTA   #####
$minutosContratista             =   strtotime( $end ) - strtotime( $index ) ;
$finContratista                 =   intval( $minutosContratista / 60 );
//  #####   TEMPOS QUE DEMORO EL ITO    #####
$minutosIto                     =   strtotime( $endIto ) - strtotime( $index );
$finIto                         =   intval( $minutosIto / 60 );
//  #####   COMPARACION DE TIEMPOS MINUTOS PARA VER SI SE CUMPLEN LOS TIEMPOS DE EJECUCION O NO    
if( $_REQUEST['tipo_orden'] == 2 )
{
    $minutos_ods    =   15840;
}
else
{
    $prioridad  =   $core->ShowById( 'prioridad_orden', $_REQUEST['prioridad_orden'] );
    foreach( $prioridad as $row)
    {
       $minutos_ods =   $row['minutos'];
    }
}

$cumplimientoContratista        =   ( ( ( $finContratista < $minutos_ods ) && ( $finContratista < 0 ) ) || ( $finContratista > $minutos_ods) ) ? "'0'" : "'1'";

$cumplimientoIto                =   ( ( ( $finIto < $minutos_ods ) && ( $finIto < 0 ) ) || ( $finIto > $minutos_ods) ) ? "'0'" : "'1'";


$header                     =   header( 'Location:index.php' );

switch ( $peticion )
{
    case 'nuevo':
        $datos              =   array(
'codigo'                    =>  $codigo, 
'horaInicio'                =>  $inicio,
'horaTermino'               =>  $termino,
'cierre'                    =>  $cierreIto,
'descripcion'               =>  $descripcion,
'ito'                       =>  $ito,
'actividad'                 =>  $actividad,
'brigada'                   =>  $brigada,
'direccion'                 =>  $direccion,
'localidad'                 =>  $localidad,
'tipo_orden'                =>  $tipo_orden,
'prioridad_orden'           =>  $prioridadOrden,
'jefeTerreno'               =>  $jefeTerreno,
'cumplimiento_contratista'  =>  $cumplimientoContratista,
'cumplimiento_ito'          =>  $cumplimientoIto
                    );
                echo ( $core->Create( 'ODS', $datos ) ) ? $header : 'NO SE PUDO CREAR LA ODS';
        break;
    
    case 'actualizar':
    $datos              =   array(
'codigo'                    =>  $codigo, 
'horaInicio'                =>  $inicio,
'horaTermino'               =>  $termino,
'cierre'                    =>  $cierreIto,
'descripcion'               =>  $descripcion,
'ito'                       =>  $ito,
'actividad'                 =>  $actividad,
'brigada'                   =>  $brigada,
'direccion'                 =>  $direccion,
'localidad'                 =>  $localidad,
'tipo_orden'                =>  $tipo_orden,
'prioridad_orden'           =>  $prioridadOrden,
'jefeTerreno'               =>  $jefeTerreno,
'cumplimiento_contratista'  =>  $cumplimientoContratista,
'cumplimiento_ito'          =>  $cumplimientoIto
                );
                echo ( $core->Update( 'ODS', $datos, $id ) ) ? $header : 'NO SE PUDO ACTUALIZAR LA ODS';
                break;

    case 'eliminar':
        echo ( $core->Delete( 'ODS', $id ) ) ? $header : 'NO SE PUDO ELIMINAR LA ODS';
        break;
}

?>