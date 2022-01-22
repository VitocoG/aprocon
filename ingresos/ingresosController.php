<?php
$search         =   $_POST['buscar'] ?? NULL;

#   ENCABEZADO
$id_enc         =   $_POST['id_enc'] ?? NULL;
$fecha          =   $_POST['fecha'] ?? NULL;
$almacen        =   $_POST['almacen']   ??  $_SESSION['bodegaId']; #BODEGA POR DEFECTO
$proveedor      =   $_POST['proveedor'] ?? NULL;
$num_factura    =   $_POST['num_factura'] ?? NULL;
$total          =   $_POST['total'] ?? NULL;
$usuario        =   $_SESSION['id'];

#   DETALLE
$id_det         =   $_POST['id_det'] ?? NULL;
$material       =   $_POST['material'] ?? NULL;
$valor          =   $_POST['valor'] ?? NULL;
$cantidad       =   $_POST['cantidad'] ?? NULL;

$p              =   $_POST['p'] ?? NULL;

#   ARRAY DEL ENCABEZADO
$datos_enc      =   array(  
                            'fecha'                     =>  $fecha,
                            'almacen'                   =>  $almacen,
                            'proveedor'                 =>  $proveedor,
                            'num_factura'               =>  $num_factura,
                            'total'                     =>  $total,
                            'usuario'                   =>  $usuario
                        );

#   ARRAY DEL DETALLE                        
$datos_det      =   array(  
                            'material'                  =>  $material,
                            'valor'                     =>  $valor,
                            'cantidad'                  =>  $cantidad,
                            'ingresos_enc'              =>  $id_enc
                        );

#   ARRAY DE LA TABLA STOCK
$datos_stock    =   array(  'material'                  =>  $material,
                            'bodega'.$almacen           =>  $cantidad
                        );

switch ( $p ):

# crear ingreso
# 1.- llamar al formulario del encabezado
    case 'create_enc':
        require_once $class.'_encabezado_Create.php';
        break;

# 2.- guardo el encabezado
    case 'save_encabezado':
        # AGREGAMOS LA FECHA ACTUAL AL CAMPO FECHA DEL ARRAY DEL ENCABEZADO
        $datos_enc['fecha']     =  date( 'Y-m-d' );
        # AGREGAMOS EL ID DEL USUARIO QUE REALIZA EL INGRESO, EN EL ARRAY DEL ANCABEZADO
        $datos_enc['usuario']   =  $_SESSION['id'];
        # FUNCION PARA CREAR EL ENCABEZADO
        $model->Create( $class.'_enc', $datos_enc );
        $id_enc =   $clase->numeroEncabezado();
    # 3.- llamo al formulario del detalle
        require_once $class.'_detalle_Create.php';
        break;

    # 4.- busco el producto
    case 'search':
        require_once $class.'_detalle_Create.php';
        break;

    # 5.- verifico que el producto no este agregado. 
    case 'add':
        $verificar  =   $clase->verificarMaterial( $material, $id_enc);
        if( $verificar->num_rows > 0 ):
            # 5.1.- Si está, modifico la cantidad.
            $clase->modificarCantidad( $cantidad, $valor, $material, $id_enc );
        else: 
            # 5.2.- Si no está, lo creo
            $model->Create( $class.'_det', $datos_det );
        endif;  
    # 6.- verificar que el producto exista en la tabla stock, en el registro correspondiente a la bodega ingresado. 
        $verificar  =   $clase->verificarMaterialStock( $almacen, $material );
        if( $verificar->num_rows > 0 ):
            # 6.1.- obtenemos el id a modificar
            foreach( $verificar as $value ):
            endforeach;
            # 6.2.- si existe, se modifica el stock.
            $datos_stock['bodega'.$almacen] = ( $value['bodega'.$almacen] + $datos_stock['bodega'.$almacen] );
            $model->Update( 'stock', $datos_stock, $value['id'] );
        else:
            # 6.3.- sino existe, se crea.
            $model->Create( 'stock', $datos_stock );
        endif;
    # 7.- regreso al formulario del detalle
        require_once $class.'_detalle_Create.php';
        break;

    case 'close':
        $model->Update( $class.'_enc', $datos_enc=array('total'=>$total), $id_enc );
        header( 'Location:../'.$class );
        break;


    case 'delete_det':
        $clase->deleteStock( $_SESSION['idBodega'], $_POST['materiales'] );
        $model->Delete( $class.'_det', $id_det );
        require_once $class.'_detalle_Create.php';
        break;


    case 'details':
        require_once $class.'Details.php';
        break;


    




    case 'edit_enc':
        require_once $class.'_detalle_Create.php';
        break;


    
    # VISTA POR DEFECTO DE LOS INGRESOS
    default:
        # VISTA DE INGRESOS
        $clase->mostrarBodega( $_SESSION['id'] ); 
        $enc = $clase->numeroEncabezado();

        require_once $class.'View.php';
        break;
endswitch;




# editar un ingreso
    # 1.- llamo al formulario editar el encabezado.
    # 2.- actualizo los registros.
    # 3.- vuelvo  al punto 3 de la cracion del ingreso
    
# eliminar un ingreso
    # 1.- guardamos los materiales ingresados en el detalle del ingreso a eliminar.
    # 2.- puntos 4, 5 y 6 de creacion de ingresos.
    # 3.- eliminamos el detalle del ingreso.
    # 4.- elminiamos el encabezado
    # 5.- volvemos a la vista principal de ingresos
    ?>