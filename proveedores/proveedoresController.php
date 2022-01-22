<?php   
#   SI USUARIO HA INICIADO SESION, PUEDE ACCEDER A LA INFO
if( $_SESSION ):

#   VARIABLES QUE CONTIENEN LOS DATOS ENVIADOS DESDE LOS DIFERENTES FORMULARIOS DEL MODELO
    # ID DEL PROVEEDOR
    $id             =   isset( $_POST['id'] )           ? $_POST['id']          : NULL;

    # DATOS DE LA EMPRESA
    $nombre         =   isset( $_POST['nombre'] )       ? strtoupper( $_POST['nombre'] )        : NULL;
    $rut            =   isset( $_POST['rut'] )          ? $_POST['rut']                         : NULL;
    $giro           =   isset( $_POST['giro'] )         ? strtoupper( $_POST['giro'] )          : NULL;
    $direccion      =   isset( $_POST['direccion'] )    ? strtoupper( $_POST['direccion'] )     : NULL;
    $ciudad         =   isset( $_POST['ciudad'] )       ? strtoupper( $_POST['ciudad'] )        : NULL;
    # TRANSFORMA LOS REGISTROS DEL ARRAY DEL FORMULARIO EN UN TEXT CON TODOS LOS REGISTROS( IMPLODE )
    $localidad      =   isset( $_POST['localidad'] )    ? implode(" ", $_POST['localidad'] )    : NULL;

    # DATOS DEL CONTACTO DE LA EMPRESA
    $contacto       =   isset( $_POST['contacto'] )     ? strtoupper( $_POST['contacto'] )      : NULL;
    $rutContacto    =   isset( $_POST['rutContacto'] )  ? $_POST['rutContacto']                 : NULL;
    $telefono       =   isset( $_POST['telefono'] )     ? $_POST['telefono']                    : NULL;
    $email          =   isset( $_POST['email'] )        ? strtolower( $_POST['email'] )         : NULL;


    # DATOS BANCARIOS DE LA EMPRESA
    $banco          =   isset( $_POST['banco'] )        ? $_POST['banco']                       : NULL;
    $cuenta         =   isset( $_POST['cuenta'] )       ? strtoupper( $_POST['cuenta'] )        : NULL;
    $numeroCuenta   =   isset( $_POST['numeroCuenta'] ) ? $_POST['numeroCuenta']                : NULL;

    # INDICA SI TIENE ORDEN DE COMPRA ( 0 = NO - 1 = SI )
    $oc             =   isset( $_POST['oc'] )           ? $_POST['oc']                          : NULL;


    $peticion       =   isset( $_POST['p'] )            ? $_POST['p']                           : NULL;

    $datosEmpresa   = array(
                            'nombre'        =>  $nombre ,
                            'rut'           =>  $rut ,
                            'giro'          =>  $giro ,
                            'direccion'     =>  $direccion ,
                            'ciudad'        =>  $ciudad ,
                            'localidad'     =>  $localidad     
                        );

    $datosContacto  = array(
                            'contacto'      =>  $contacto ,
                            'rutContacto'   =>  $rutContacto ,
                            'telefono'      =>  $telefono ,
                            'email'         =>  $email          
                        );

    $datosBancarios = array(
                            'banco'         =>  $banco  ,
                            'cuenta'        =>  $cuenta ,
                            'numeroCuenta'  =>  $numeroCuenta,
                            'oc'            =>  $oc
    );

    switch ($peticion):

        case 'delete':
            $model->Delete( $class, $id );
            require_once ( 'indexView.php' );
            break;

        case 'create':
            require_once 'createProveedor.php';
            break;

        case 'contacto':
                if ( $model->Create( $class, $datosEmpresa ) ):
                    $createProveedor = $model->ShowAll( $class, ' ORDER BY id DESC LIMIT 1' );
                    foreach ($createProveedor as $value):
                        $value['id'];
                    endforeach;
                    require_once 'createContacto.php';
                else:
                    echo 'no se pudo crear el Proveedor';
                endif;
            break;

        case 'bancario':
            if ( $model->Update( $class, $datosContacto, $id ) ):
                require_once 'createBancario.php';
            else:
                'no se pudo agregar datos de contacto del Proveedor';
            endif;
            break;

        case 'guardar':
            if ( $model->Update( $class, $datosBancarios, $id ) ):
                require_once 'indexView.php';
            else:
                echo 'no se pudo agregar datos Bancarios del Proveedor';
            endif;
            break;

        case 'edit':
            if( $proveedor = $model->ShowById( $class, $id )):
                foreach ( $proveedor as $valor ):
                endforeach;
                require_once ( 'updateProveedor.php' );
            endif;
            break;

        case 'editContacto':
            if ( $model->Update( $class, $datosEmpresa, $id ) ):
                if( $proveedor = $model->ShowById( $class, $id )):
                    foreach ( $proveedor as $valor ):
                    endforeach;
                    require_once 'updateContacto.php';
                endif;
            endif;
            break;

        case 'editarBancario':
            
            if ( $model->Update( $class, $datosContacto, $id ) ):
                if( $proveedor = $model->ShowById( $class, $id )):
                    foreach ( $proveedor as $valor ):
                    endforeach;
                    require_once 'updateBancario.php';
                endif;
            endif;
            break;
        
        default:
            require_once ( 'indexView.php' );
            break;
    endswitch;

else:
    header('Location:../login/');
endif;
?>