<?php 
session_start();
require_once '../../config/core.class.php';
$core 	= 	new core;

        $carpeta = 'pdf/'.date('Y').'/';
		$mes 	= 	date('m').'/';
        $nombre = date('dmYHis').$_FILES['archivo']['name'];
        $origen = $_FILES['archivo']['tmp_name'];


$usuario 	= 	$_SESSION['id'];
$id         =   $_REQUEST['id'];
$fecha 		= 	"'".date('Y-m-d')."'";
$documento	=	"'".$_REQUEST['documento']."'";
$fecha_documento  	=	"'".$_REQUEST['fecha']."'";
$detalle 	=	"'".$_REQUEST['detalle']."'";
$total 		= 	"'".$_REQUEST['total']."'";
$factura 	= 	$carpeta.$mes.$nombre;
$ruta 		= 	"'".$factura."'";
$peticion	= 	$_REQUEST['p'];


switch ( $peticion )
{
	case 'nuevo':
	    
	    /*==================================================
        =            SECCION PARA SUBIR ARCHIVO            =
        ==================================================*/

       


        if ( ( isset( $_FILES['archivo'] ) ) && ( $_FILES['archivo']['type']=='application/pdf' ) )
        {
	        if (!file_exists($carpeta))
	        {
				mkdir($carpeta);
				mkdir($carpeta.$mes);
			}
			else 
			{
				if (!file_exists($mes))
				{
					mkdir($carpeta.$mes);
				}
			}
	        move_uploaded_file($origen, $carpeta.$mes.$nombre);
	
	        //=====  End of SECCION PARA SUBIR ARCHIVO  ======*/
		
				$datos 		= 	array( 
					'usuario'	        => 	$usuario,
					'fecha'		        => 	$fecha,
					'fecha_documento'   =>  $fecha_documento,
					'num_documento'	    =>	$documento,
					'detalle'	        =>	$detalle,
					'total'		        =>	$total,
					'archivo'	        =>	$ruta,
					);
				if( $core->Create( 'gastos', $datos ) )
					{
						header( 'Location:index.php' );
					}
			
		break;
        }
        else
        {
            echo 'El archivo debe ser PDF <a href="index.php">Volver</a>';
        }

	case 'actualizar':
		$datos 			= 	array( 
					'num_documento'	    =>	    $documento,
					'fecha_documento'   =>      $fecha_documento,
					'detalle'	        =>	    $detalle,
					'total'		        =>	    $total,
					 );
		if ( $update	=	$core->Update( 'gastos', $datos, $id ) )
			{
				header( 'Location:index.php' );
			}
			break;
			
			

	case 'eliminar':
		if( $query = $core->Delete( 'gastos', $id ) )
			{
				header( 'Location:index.php' );
			}
			break;
		}
		?>