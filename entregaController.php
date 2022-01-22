<?php

#	RUTA PARA LA VISTA PRINCIPAL DEL ADMINISTRADOR
$ruta	=	( $_SESSION['perfil'] == 1 ) ? 'AdminView.php' : 'View.php';

// DATOS DEL ARCHIVO A SUBIR
$carpeta 		= 	'./pdf/'.date('Y').'/'; # RUTA DE DESTINO DEL ARCHIVO SUBIDO
$mes 			= 	date('m').'/'; # CARPETA DEL MES
$nombre 		= 	date('YmdHis'); # NOMBRE DEL ARCHIVO SUBIDO
$origen 		= 	$_FILES['archivo']['tmp_name']; # RUTA Y NOMBRE TEMPORAL DEL ARCHIVO

$destino 		= 	$carpeta.$mes.$nombre.'.pdf'; # RUTA COMPLETA Y NOMBRE DEL ARCHIVO

// DATOS DEL ENCABEZADO
$idEnc			=	( isset( $_POST['idEnc'] ) ) 			? $_POST['idEnc'] 			: NULL;
$fecha			=	( isset( $_POST['fecha'] ) ) 			? $_POST['fecha'] 			: NULL;
$localidad		=	( isset( $_POST['localidad'] ) ) 		? $_POST['localidad'] 		: NULL;
$tipo			=	( isset( $_POST['tipo'] ) )				? $_POST['tipo']			: NULL;
$recibe			=	( isset( $_POST['recibe'] ) ) 			? $_POST['recibe'] 			: NULL;
$total			=	( isset( $_POST['total'] ) ) 			? $_POST['total'] 			: NULL;

// DATOS DEL DETALLE
$idDetalle		=	( isset( $_POST['idDetalle'] ) ) 		? $_POST['idDetalle'] 		: NULL;
$cantidad		=	( isset( $_POST['cantidad'] ) ) 		? $_POST['cantidad'] 		: NULL;
$concepto		=	( isset( $_POST['concepto'] ) ) 		? $_POST['concepto'] 		: NULL;
$precio			=	( isset( $_POST['precio'] ) ) 			? $_POST['precio'] 			: NULL;
$estado			=	( isset( $_POST['estado'] ) ) 			? $_POST['estado'] 			: NULL;
$observaciones	=	( isset( $_POST['observaciones'] ) ) 	? $_POST['observaciones'] 	: NULL;

# CASE DEL SWITCH
$p	        	= 	( isset( $_POST['p'] ) )				? $_POST['p']				: NULL;

// DATOS DEL ENCABEZADO
$datos		=	array(
					'fecha'			=> $fecha,
					'localidad'		=> $localidad,
					'concepto'		=> $concepto,
					'tipo'			=> $tipo,
					'recibe'		=> $recibe,
					'total'			=> $total,
					'observaciones'	=> $observaciones,
					'entrega'		=> NULL,
					'archivo'		=> NULL
					);	

// DATOS DEL DETALLE
$datosDetalle = array(
					'cantidad' 		=> $cantidad ,
					'concepto' 		=> $concepto ,
					'precio' 		=> $precio ,
					'estado' 		=> $estado ,
					'observaciones'	=> $observaciones ,
					'entrega_enc' 	=> $idEnc 
					);					


switch ( $p ):
	# FORMULARIO PARA ACTUALIZAR LA ENTREGA
	case 'edit':
		require_once './entregaCreateDetalle.php';
		break;

	# FORMULARIO PARA CREAR ENCABEZADO
	case 'create':
		require_once $class.'Create.php';
		break;

	# GUARDAR ENCABEZADO
	case 'encabezado':
			$datos['entrega'] = $_SESSION['id']; # ID DE QUIEN REALIZA LA ENTRAGA
			$datos['estado' ] = 0; # ESTADO 0 = "ABIERTO"
			# CREA EL ENCABEZADO
			$model->Create( $class.'_enc', $datos );
			#MUESTRA FORMULARIO PARA AGREGAR DETALLE
			require_once './entregaCreateDetalle.php';
		break;

	# AGREGA ELEMENTOS AL DETALLE
	case 'detalle':
		# AGREGA ELEMENTO AL DETALLE
		$model->Create( $class.'_det', $datosDetalle );
		# FUNCION  PARA LLAMAR LOS REGISTROS PERTENECIENTES AL ID DEL ENCABEZADO
		$totalDetalle	=	$model->SelectByKey( $class.'_det', $class.'_enc', $idEnc, '' );
		foreach( $totalDetalle as $row ):
			# SUMA EL VALOR TOTAL DE CADA ELEMENTO AGREGADO AL DETALLE
			$suma = $suma + ( $row['cantidad'] * $row['precio'] );
		endforeach;
		# ARRAY DONDE INDICAMOS EL TOTAL DE LOS DETALLES AGREGADOS
		$totalEntrega	=	array ( 'total' => $suma );
		# ACTUALIZA EL TOTAL DE LA BD
		$model->Update( $class.'_enc', $totalEntrega, $idEnc );
		# REGRASA A FORMULARIO PARA AGREGAR DETALLE
		require_once './entregaCreateDetalle.php';
		break;

	# ELIMINAR ELEMENTOS DEL DETALLE
	case 'delete_det':
		# ELIMINA EL ELEMENTO DEL DETALLE
		$model->Delete( $class.'_det', $idDetalle );
		# REGRESA AL FORMULARIO PARA AGREGAR DETALLE
		require_once './entregaCreateDetalle.php';
		break;

	# CIERRA LA ENTREGA
	case 'cerrar':
	    
	    /*==================================================
        =            SECCION PARA SUBIR ARCHIVO            =
		==================================================*/
		# SI SE ENVIÓ ARCHIVO POR POST Y ES DE TIPO PDF
		if ( ( isset( $_FILES['archivo'] ) ) && ( $_FILES['archivo']['type']=='application/pdf' ) ):
			# SI NO EXISTEN LAS CARPETAS "pdf/{{AÑO}}
			if (!file_exists($carpeta)):
				# CREA ESA RUTA
				mkdir($carpeta);
				# CREA CARPETA DEL MES EN CURSO
				mkdir($carpeta.$mes);
			# SI EXISTEN LAS CARPETAS
			else:
				# SI NO EXISTE LA CARPETA DEL MES EN CURSO
				if (!file_exists($mes)):
					#  LO CREA
					mkdir($carpeta.$mes);
				endif;
			endif;
			# MUEVE EL ARCHIVO PDF A SU CARPETA DE DESTINO
			move_uploaded_file($origen, $destino);	
			//=====  End of SECCION PARA SUBIR ARCHIVO  ======
		# ARRAY PARA CERRAR LA ENTREGA		
		$datosCerrar	=	array(
								'archivo'		=>	$destino,
								'observaciones'	=>	$observaciones,
								'estado'		=>	'1'
								);

		# ACTUALIZA RUTA DEL ARCHIVO SUBIDO, OBSERVACIONES Y ESTADO DE LA ENTREGA A CERRADO
		$model->Update( $class.'_enc', $datosCerrar, $idEnc );
			# REDIRECCIONA AL INDEX DEL MODELO
	        require_once './'.$class.$ruta;
		else:
			echo 'no se pudo';
		endif;
		break;

	# LLAMA LOS DATOS INGRESADOS DE LA ENTREGA QUE ESTA EN ESTADO ABIERTA, Y LOS MUESTRA EN PDF
	case 'pdf':
        $mostrarAbiertas    = $clase->ShowById( $class.'_enc', $idEnc );
		require_once './pdf.php';
		break;
		
		
	# PAGINA PRINCIPAL DE LAS ENTREGAS
	default:
	     $mostrarAbiertas    =	( $_SESSION['perfil'] > 1 ) ?
									$clase->SelectByKey( $class.'_enc', 'entrega', $_SESSION['id'], ' AND estado = "0"' ) :
									$clase->ShowAll( $class.'_enc', ' WHERE estado = 0'); 

		$mostrarEntregas    = 	( $_SESSION['perfil'] > 1 ) ?
									$clase->SelectByKey( $class.'_enc', 'entrega', $_SESSION['id'], '' ) :
									$clase->ShowAll( $class.'_enc', ' WHERE estado = 1'); 
	    
        //$mostrarAbiertas    = $clase->SelectByKey( $class.'_enc', 'entrega', $_SESSION['id'], ' AND estado = "0"' ); 
        //$mostrarEntregas    = $clase->SelectByKey( $class.'_enc', 'estado', 1, 'ORDER BY entrega' );
        
	        require_once './'.$class.$ruta;
	    break;
endswitch;
?>