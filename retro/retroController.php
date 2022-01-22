<?php
session_start();
if ($_SESSION['id']):

    date_default_timezone_set('America/Santiago');
    require_once('../../config/model.class.php');
    $model              =   new model;
    $carpeta            = date('Y').'/';
    $mes 	            = date('m').'/';
    $reports            = 'reports/';
    $facturas           = 'facturas/';
    $comprobantes       = 'comprobantes/';
    $nombreReport       = date('dmYHis').$_FILES['report']['name'];
    $nombreFactura      = date('dmYHis').$_FILES['factura']['name'];
    $nombreComprobante  = date('dmYHis').$_FILES['comprobante']['name'];
    $origenReport       = $_FILES['report']['tmp_name'];
    $origenFactura      = $_FILES['factura']['tmp_name'];
    $origenComprobante  = $_FILES['comprobante_pago']['tmp_name'];


    $id                 =   $_REQUEST['id'];
    $fecha              =   date('Y-m-d');
    $ods                =   $_REQUEST['ods'];
    $report             =   $reports.$carpeta.$mes.$nombreReport;
    $localidad          =   strtoupper( $_REQUEST['localidad'] );
    $total_horas        =   $_REQUEST['total_horas'];
    $reembolso          =   ( $total_horas * 20000 );
    $monto_pagado_ods   =   $_REQUEST['monto_pagado_ods'];
    $proveedor          =   strtoupper( $_REQUEST['proveedor'] );
    $pago_ods           =   $_REQUEST['pago_ods'];
    $diferencia         =   ( $reembolso - $monto_pagado_ods );
    $factura            =   ($_FILES['factura']['name']=='') ? NULL : $facturas.$carpeta.$mes.$nombreFactura;
    $numero_factura     =   $_REQUEST['numero_factura'];
    $estado_factura     =   $_REQUEST['estado_pago'];
    $comprobante_pago   =   ($_FILES['comprobante_pago']['name']=='') ? NULL : $comprobantes.$carpeta.$mes.$nombreComprobante;
    $usuario            =   $_SESSION['id'];
    $p                  =   $_REQUEST['p'];


    
        /*==================================================
        =            SECCION PARA SUBIR ARCHIVO            =
        ==================================================*/    
        if( ( isset( $_FILES['report'] ) ) && ( $_FILES['report']['type']=='application/pdf' ) ):
            if(!file_exists($reports)):
                mkdir($reports);
				mkdir($reports.$carpeta);
				mkdir($reports.$carpeta.$mes);
            endif;
            move_uploaded_file($origenReport, $reports.$carpeta.$mes.$nombreReport);
        endif;
        
        if ( ( isset( $_FILES['factura'] ) ) && ( $_FILES['factura']['type']=='application/pdf' ) ):          
            if(!file_exists($facturas)):
                mkdir($facturas);
				mkdir($facturas.$carpeta);
				mkdir($facturas.$carpeta.$mes);
            endif;
            move_uploaded_file($origenFactura, $facturas.$carpeta.$mes.$nombreFactura);
        endif;
         
        if( ( isset( $_FILES['comprobante_pago'] ) ) && ( $_FILES['comprobante_pago']['type']=='application/pdf' ) ):
            if(!file_exists($comprobantes)):
                mkdir($comprobantes);
				mkdir($comprobantes.$carpeta);
                mkdir($comprobantes.$carpeta.$mes);
            endif;
            move_uploaded_file($origenComprobante, $comprobantes.$carpeta.$mes.$nombreComprobante);
        endif;
        //=====  End of SECCION PARA SUBIR ARCHIVO  ======/*

    

    switch ($p):
        case 'create':
        require_once('createView.php');
            break;

        case 'save':
        
        $datos      =   array(
                                'fecha'                 =>      $fecha,
                                'ods'                   =>      $ods,
                                'report'                =>      $report,
                                'localidad'             =>      $localidad,
                                'total_horas'           =>      $total_horas,
                                'reembolso'             =>      $reembolso,
                                'monto_pagado_ods'      =>      $monto_pagado_ods,
                                'proveedor'             =>      $proveedor,
                                'pago_ods'              =>      $pago_ods,
                                'diferencia'            =>      $diferencia,
                                'usuario'               =>      $usuario
                            );
        if ($model->Create('arriendo_retro', $datos)):
            header('Location:../retro');
        else:
            echo 'no guardado';
        endif;
            break;

        case 'edit':
            if($_SESSION['perfil']==1):
                require_once('updateView.php');
            else:
                header('Location:../retro');
            endif;
            break;

        case 'update':
       
        $datos      =   array(
                                'ods'                   =>      $ods,
                                'localidad'             =>      $localidad,
                                'total_horas'           =>      $total_horas,
                                'reembolso'             =>      $reembolso,
                                'monto_pagado_ods'      =>      $monto_pagado_ods,
                                'proveedor'             =>      $proveedor,
                                'pago_ods'              =>      $pago_ods,
                                'diferencia'            =>      $diferencia, 
                                'factura'               =>      $factura,
                                'numero_factura'        =>      $numero_factura,
                                'estado_factura'        =>      $estado_factura,
                                'comprobante_pago'      =>      $comprobante_pago
                            );
        if ($model->Update('arriendo_retro', $datos, $id)):
            header('Location:../retro');
        else:
            echo 'no Editado';
        endif;
            break;

        case 'delete':
            if($_SESSION['perfil']==1):
                if($model->Delete('arriendo_retro', $id)):
                    header('Location:../retro');
                endif;
            else:
                header('Location:../retro');
            endif;
            break;
        
        default:
            if($_SESSION['perfil']==1):
                require_once('showAllView.php');
            else:
                require_once('showView.php');
            endif;
            break;
    endswitch;
    
else:
    header('Location:../../');
endif;
?>