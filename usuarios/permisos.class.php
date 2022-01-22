<?php
require_once '../../config/core.class.php';
$core   =   new core;

$persona        =   "'".$_REQUEST['id']."'";
$depositos      =   "'".$_REQUEST['depositos']."'";
$localidades    =   "'".$_REQUEST['localidades']."'";
$perfiles       =   "'".$_REQUEST['perfiles']."'";
$usuarios       =   "'".$_REQUEST['usuarios']."'";
$saldos         =   "'".$_REQUEST['saldos']."'";
$trabajadores   =   "'".$_REQUEST['trabajadores']."'";
$brigadas       =   "'".$_REQUEST['brigadas']."'";
$itos           =   "'".$_REQUEST['itos']."'";
$cargos         =   "'".$_REQUEST['cargos']."'";
$contratos      =   "'".$_REQUEST['contratos']."'";
$ods            =   "'".$_REQUEST['ods']."'";
$lista_gastos   =   "'".$_REQUEST['lista_gastos']."'";
$horas_extras   =   "'".$_REQUEST['horas_extras']."'";
$inventario     =   "'".$_REQUEST['inventario']."'";
$retro          =   "'".$_REQUEST['retro']."'";


$datos 		= 	array( 
					'persona'		=>  $persona,
					'depositos'		=>	$depositos,
					'localidades'	=>	$localidades,
					'perfiles'  	=>	$perfiles,
					'usuarios'  	=>	$usuarios,
					'saldos'    	=>	$saldos,
					'trabajadores'	=>	$trabajadores,
					'brigadas'  	=>	$brigadas,
					'itos'      	=>	$itos,
					'cargos'    	=>	$cargos,
					'contratos' 	=>	$contratos,
					'ods'       	=>	$ods,
					'gastos'	    =>	$lista_gastos,
					'horas_extras'	=>	$horas_extras,
					'inventario'	=>	$inventario,
					'arriendo_retro'=>  $retro
					);
					
$num_rows   =   $core->SelectByKey( 'permisos', 'persona', $persona );
foreach( $num_rows as $row)
{
    $id = $row['id'];
}
if( $id > 0 )
{
    if( $core->Update( 'permisos', $datos, $id ) )
    {
        header( 'Location:index.php' );
    }
}
else
{
    if( $core->Create( 'permisos', $datos ) )
		{
			header( 'Location:index.php' );
		}
}
				
?>