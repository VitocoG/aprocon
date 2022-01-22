<?php

/* VARIABLES DEL MODELO MATERIAES */
$idMaterial =   isset( $_POST['idMaterial'] )   ? $_POST['idMaterial']      :   NULL;
$nombre     =   isset( $_POST['nombre'] )       ? $_POST['nombre']          :   NULL;
$categoria  =   isset( $_POST['categoria'] )    ? $_POST['categoria']       :   NULL;


/* VARIALBLES DEL MODELO MAT_PROV */
$id         =   isset( $_POST['id'] )           ?   $_POST['id']            :   NULL;
$valor      =   isset( $_POST['valor'] )        ?   $_POST['valor']         :   NULL;
$proveedor  =   isset( $_REQUEST['proveedor'] ) ?   $_REQUEST['proveedor']  :   NULL;

/* VARIABLE DE SWITCH */
$p          =   isset( $_REQUEST['p'] )         ?   $_REQUEST['p']          :   NULL;

$CrearExito = " ";

/* ARRAY DE MODELO MATERIALES */
$datosMaterial  =   array(
                        'nombre'    =>  $nombre,
                        'categoria' =>  $categoria 
                    );

/* ARRAY DEL MODELO MAT_PROV */
$datosMatProv   =   array(
                        'material'  =>  $idMaterial,
                        'proveedor' =>  $proveedor,
                        'valor'     =>  $valor 
                    );


#   SWITCH CASE
switch ($p):
/*********** ACCIONES DEL MODELO MAT_PROV ***************/
    /* FORMULARIO PARA EDITAR MATERIALES DEL PROVEEDOR */
    case 'EditMatProv':
        $ShowById   =   $clase->ShowById( 'proveedores', $proveedor );
        $ShowAll    =   $clase->ShowAll( 'materiales_proveedores', '' );
        $ShowProv   =   $clase->ShowAll( 'proveedores', '' );
        $listaMat   =   $clase->ShowById( 'mat_prov', $id );
        require_once $class.$p.'.php';
        break;

    /* ACTUALIZA LOS REGISTROS DEL MATERIAL DEL PROVEEDOR */
    case 'UpdateMatProv':
        if( $clase->VerificarMatProv( $idMaterial, $proveedor ) == 1 ):
            $clase->Update( 'mat_prov', $datosMatProv, $id );
            $CrearExito = '<div class="bg-success"><h4><br><p class="text-center"><strong>Producto Actualizado</strong></p><br></h4></div>';
        else:
            $CrearExito = '<div  class="bg-danger"><h4><br><p class="text-center"><strong>No se pudo Editar el Material</strong></p><br></h4></div>';
        endif;
        $ShowById   =   $clase->ShowById( 'proveedores', $proveedor );
        $ListarMatProv = $clase->ListarMatProv( $proveedor );
        require_once $class.'Mat_prov.php';
        break;

    /* FORMULARIO PARA AGREGAR MATERIALES AL PROVEEDOR */
    case 'CreateMatProv':
        $ShowById   =   $clase->ShowById( 'proveedores', $proveedor );
        $ShowAll    =   $clase->ShowAll( 'materiales_proveedores', '' );
        require_once $class.$p.'.php';
        break;

        
    /* GUARDA LOS REGISTROS DEL MATERIAL DEL PROVEEDOR */
    case 'SaveMatProv':
        if( $clase->VerificarMatProv( $idMaterial, $proveedor ) == 0 ):
            $clase->Create( 'mat_prov', $datosMatProv );
            $CrearExito = '<div class="bg-success"><h4><br><p class="text-center"><strong>Producto Registrado</strong></p><br></h4></div>';
        else:
            $CrearExito = '<div  class="bg-danger"><h4><br><p class="text-center"><strong>Ya existe este Art&iacute;culo para este Proveedor</strong></p><br></h4></div>';
        endif;
        $ShowById   =   $clase->ShowById( 'proveedores', $proveedor );
        $ListarMatProv = $clase->ListarMatProv( $proveedor );
        require_once $class.'Mat_prov.php';
        break;

    /* LISTA LOS MATERIALES DE UN PROVEEDOR ESPECIFICO */
    case 'Mat_prov':
        $ShowById   =   $clase->ShowById( 'proveedores', $proveedor );
        $ListarMatProv = $clase->ListarMatProv( $proveedor );
        require_once $class.$p.'.php';
        break;


/*********** ACCIONES DEL MODELO MATERIALES ***************/
    /* ACTUALIZA LOS REGISTROS DEL MATERIAL EDITADO */
    case 'Update':
        $CrearExito = ( $clase->Update( $class, $datosMaterial, $idMaterial ) ) ? 
            '<div class="bg-success"><h4><br><p class="text-center"><strong>Registro Actualizado con &Eacute;xito</strong></p><br></h4></div>' :
            '<div  class="bg-danger"><h4><br><p class="text-center"><strong> No se pudo Actualizar</strong></p><br></h4></div>';
            
            $ShowAll    =   $clase->ListarInicio();
            require_once $class.'ListaTotal.php'; 
        break;

    /* FORMULARIO PARA EDITAR UN MATERIAL */
    case 'Edit':
        $ShowById   =   $clase->ShowById( $class, $idMaterial );
        $ShowAll    =   $clase->ShowAll( 'categoria_materiales', '' );
        require_once $class.$p.'.php';
        break;

    /* FORMULARIO PARA CREAR UN MATERIAL */
    case 'Create':
        $ShowAll    =   $clase->ShowAll( 'categoria_materiales', '' );
        require_once $class.$p.'.php';
        break;

    /* GUARDA LOS REGISTROS EN LA BD */
    case 'Save':
         $CrearExito = ( $clase->Create( $class, $datosMaterial ) ) ? 
            '<div class="bg-success"><h4><br><p class="text-center"><strong>Registro Creado con &Eacute;xito</strong></p><br></h4></div>' :
            '<div  class="bg-danger"><h4><br><p class="text-center"><strong> No se pudo Crear</strong></p><br></h4></div>';
            
            $ShowAll    =   $clase->ListarInicio();
            require_once $class.'ListaTotal.php'; 
        break;
    
    default:
        $ShowAll    =   $clase->ListarInicio();
        require_once $class.'ListaTotal.php';
        break;
endswitch;