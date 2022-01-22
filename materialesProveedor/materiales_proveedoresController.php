<?php

# VARIABLES
$proveedor  =   isset( $_REQUEST['proveedor'] ) ?   $_REQUEST['proveedor']          :   NULL;
$nombre     =   isset( $_POST['nombre'] )       ?   strtoupper( $_POST['nombre'] )  :   NULL;    ;
$categoria  =   isset( $_POST['categoria'] )    ?   $_POST['categoria']             :   NULL;
$p  =   isset( $_REQUEST['p'] ) ? $_REQUEST['p'] : NULL;

# ARREGLOS
$datosMaterial = array('nombre' => $nombre, 'categoria' => $categoria );

# SWITCH
switch ($p):
    case 'CreateMaterialProveedor':
        $SelectByKey = $clase->SelectByKey( 'materiales_proveedores', 'proveedor', $proveedor, '' );
        $ShowAll    =   $clase->ShowAll( 'categoria_materiales', '' );
        require_once $p.'.php';
        break;

    case 'Mat_prov':
        $listaProveedor =   $clase->ShowById( 'proveedores', $proveedor );
        $listarMaterialesProveedor = $clase->listarMaterialesProveedor( $proveedor );
        require_once $class.'ListaView.php';
        break;

    case 'Save':
        if ( $clase->Create( $class, $datosMaterial ) ):
            require_once $class.'View.php';
        endif;
        break;

    case 'Create':
        $ShowById   =   $clase->ShowById( 'proveedores', $proveedor );   
        $ShowAll    =   $clase->ShowAll( 'materiales_proveedores', ' ORDER BY nombre');
        $SelectByKey=   $clase->SelectByKey( 'mat_prov', 'proveedor', $proveedor, '' );
        require_once $class.$p.'.php';
        break;
    
    default:
        require_once $class.'View.php';
        break;
endswitch;

?>