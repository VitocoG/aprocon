<?php
/* VARIABLES RECIBIDAS */
$id     =   $_POST['id']    ??  NULL;
$p  =   $_POST['p'] ??  NULL;
/* ARRAYS DE LA CLASE */
/* METODOS DEL SWITCH CASE */
switch ($p):
    case 'pdf':
        # CLASE PARA GENERAR UN PDF
        require_once '../../public/dompdf_0-8-3/dompdf/autoload.inc.php';

        /* LISTA LOS DATOS DE LA OC SOLICITADA */
        $ordenCompra     =   $clase->ShowById( 'oc', $id );
        /* LISTA LOS DATOS DE QUIEN AUTORIZA LA OC */
        $autoriza   =   $clase->ShowById( 'usuarios', $ordenCompra['autoriza'] );
        /* LISTA LOS DATOS DE QUIEN SOLICITA LA COMPRA */
        $solicita   =   $clase->ShowById( 'usuarios', $ordenCompra['solicita'] );
        /* LISTA LOS DATOS DEL ENCABEZADO DE LA COMPRA SOLICITADA */
        $compra_enc =   $clase->ShowById( 'compras_enc', $ordenCompra['compra'] );  
        /* LISTA LOS DATOS DEL PROVEEDOR DE LA COMPRA */
        $proveedor  =   $clase->ShowById( 'proveedores', $compra_enc['proveedor'] );
        /*  */
        $compra_det =   $clase->SelectByKey( 'compras_det', 'idEnc', $ordenCompra['compra'], '' ); 
        
        # VISTA CON TODO LO NECESARIO PARA IMPRIMIR EL PDF
        require_once 'pdf.php';
        break;
    default:
        /* PARA MOSTRAR LAS ORDENES DE COMPRA */
        $mostrarOC  =   $clase->mostrarOC();


        require_once $class.'View.php';
        break;
endswitch;

?>