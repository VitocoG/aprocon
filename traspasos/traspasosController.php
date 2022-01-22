<?php
if($_SESSION):

#   se obtiene el ultimo encabezado guardado
$ultimo =   $clase->ultimoEnc();

#   VARIABLES DEL ENCABEZADO
$id_enc     =   $_POST['id_enc']    ??  $ultimo;                #   id del traspaso
$fecha      =   $_POST['fecha']     ??  date( 'Y-m-d' );        #   fecha del traspaso
$origen     =   $_POST['origen']    ??  $_SESSION['bodegaId'];  #   bodega de origen
$destino    =   $_POST['destino']   ??  NULL;                   #   bodega de destino
$total      =   $_POST['total']     ??  0;                      #   total valorizado del traspaso
$entrega    =   $_POST['entrega']   ??  $_SESSION['id'];        #   persona que realiza el traspaso de materiales

#   VARIABLES DEL DETALLE
$id_det     =   $_POST['id_det']    ??  NULL;
$material   =   $_POST['material']  ??  0;
$cantidad   =   $_POST['cantidad']  ??  NULL;
$valor      =   $_POST['valor']     ??  NULL;



#   VARIABLE PARA REALIZAR EL SWITCH
$p          =  $_POST['p']          ??  NULL ;

#   ARRAY CON LOS DATOS DEL ENCABEZADO
$datos_enc =    array(
                    'fecha'     =>  $fecha,
                    'origen'    =>  $origen,
                    'destino'   =>  $destino,
                    'total'     =>  $total,
                    'destino'   =>  $destino,
                    'usuario'   =>  $entrega
                    );

#   ARRAY CON LOS DATOS DEL DETALLE
$datos_det  =   array(
                     'material' =>  $material,
                     'cantidad' =>  $cantidad,
                     'valor'    =>  $valor,
                     'id_enc'   =>  $id_enc
                    ); 
                    
#   ARRAY CON LOS DATOS DE LA TABLA STOCK
$datos_stock =  array(
                    'material'          =>  $material,
                    'bodega'.$origen    => $cantidad );                    

switch ($p):
    #   formulario para crear el encabezado
    case 'create_enc':
        #   se obtienen todas las Bodegas en un array
        $bodegas    =   $clase->mostrarBodegas();
        #   se llama al formulario
        require_once $class.'Create_enc.php';
        break;

    #   se guardan los datos del formulario
    case 'save_enc':
        $model->Create( $class.'_enc', $datos_enc ) ;
        #   se obtiene el ultimo encabezado guardado
        $id_enc   =   $clase->ultimoEnc() ;
        #   se llama al formulario del detalle
        require_once $class.'Create_det.php';
        break;


    #   buscar material para agregarlo al detalle
    case 'search':
        #   se llama al formulario del detalle
        require_once $class.'Create_det.php';
        break;

    #   agregar material al detalle
    case 'add':
        #   verifico que el material no este agregado
       $verificar  =  $clase->verificarDetalle( $material, $id_enc );
        #   si esta agregado, modifico la cantidad
        if( $verificar->num_rows > 0 ):
            $clase->modificarCantidad( $cantidad, $material, $id_enc );
        #   si no esta agregado, lo creo
        else:
            $model->Create( $class.'_det', $datos_det );
        endif;

        #   verificar que el producto exista en la tabla stock, en el registro correspondiente a la bodega ingresado. 
        $verificar  =   $clase->verificarMaterialStock( $origen, $material );
        if( $verificar->num_rows > 0 ):
            #   obtenemos el id a modificar
            foreach( $verificar as $value ):
            endforeach;
            #   si existe, se modifica el stock.
            $clase->modificaStock( $_SESSION['bodegaId'], '-'.$cantidad, $material );
            $clase->modificaStock( $destino, $cantidad, $material );
        else:
            #   sino existe, se crea.
            $model->Create( 'stock', $datos_stock );
        endif;
        #   volvemos al formulario para seguir ingresando materiales al detalle
        require_once $class.'Create_det.php';
        break;


    case 'details':
        require_once $class.'DetailsView.php';
        break;


    case 'edit':
        require_once 'traspasosCreate_det.php';
        break;


    case 'close':
        $datos_enc =    array( 'total'  =>  $total );
        $model->Update( $class.'_enc', $datos_enc, $id_enc );
        header( 'Location:../'.$class );
        break;


    case 'delete_det':
        $model->Delete( $class.'_det', $id_det );
        $clase->modificaStock( $_SESSION['bodegaId'], $cantidad, $material );
        $clase->modificaStock( $destino, '-'.$cantidad, $material );
        require_once 'traspasosCreate_det.php';
        break;

    case 'pdf':
        require_once $class.'_pdf.php';
        break;
    
    default:
        if( $_SESSION['perfil'] > 1 ):
            #   metodo para crear variables de sesion de la bodega del usuario
            $clase->bodegaSesion( $_SESSION['id'] );
            $listar =   $clase->listarEncabezadosUsuario();
        endif;
        require_once $class.'View.php';
        break;

    
endswitch;


else:
    header('Location:../login/');
endif;

?>