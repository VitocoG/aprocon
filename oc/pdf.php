<?php

use Dompdf\Dompdf;

$codigoHTML = '
<!DOCTYPE html>
 <html>
 <head>
 	<title>InnoControl | www.innobit.cl</title>
 	<style>
 	@page { margin: 0px; } 
 	</style>
 </head>
 <body>

 	

 		<table width="90%" align="center" border="0" cellspadding="20">
 			<tr>
 				<th width="25%"><img src="../../public/img/aprocon.jpg" height="120px" align="left"></th>
 				<th align="center" valign="bottom" width="50%">ORDEN DE COMPRA</th>
                <th width="25%"></th>
 			</tr>
 		</table>
 		<br><br><br><br><br><br><br>

		 	

 		 	

 		
 		<table width="90%" border="0" align="center" cellspacing="0" cellpadding="5">
            <tr style="font-size: 12px">
                <th  align="left">N&deg; OC</th>
                <th  align="left">: '.$ordenCompra['id'].'</th>
                <th  align="left"></th>
                <th  align="left">N&deg; COTIZACION</th>
                <th  align="left">: </th>
            </tr>
            <tr style="font-size: 12px">
                <th  align="left">FECHA</th>
                <th  align="left">: '.date( 'd-m-Y', strtotime( $ordenCompra['fecha'] ) ).'</th>
                <th  align="left"></th>
                <th  align="left">SOLICITUD N&deg;</th>
                <th  align="left">: '.$ordenCompra['compra'].'</th>
            </tr>
            <tr>
                <th colspan="5"></th>
            </tr>
            <tr style="font-size: 16px">
                <th colspan="2"  align="left">DATOS COMPRADOR</th>
                <th  align="left"></th>
                <th colspan="2"  align="left">PROVEEDOR</th>
            </tr>
            <tr>
                <th colspan="5"></th>
            </tr>
            <tr style="font-size: 12px">
                <th  align="left">Nombre</th>
                <th  align="left">: Constructora Rodrigo Mora EIRL</th>
                <th  align="left"></th>
                <th  align="left">Nombre</th>
                <th  align="left">: '.$proveedor['nombre'].'</th>
            </tr>
            <tr style="font-size: 12px">
                <th  align="left">Direcci&oacute;n</th>
                <th  align="left">: Villota 60</th>
                <th  align="left"></th>
                <th  align="left">Direcci&oacute;n</th>
                <th  align="left">: '.$proveedor['direccion'].'</th>
            </tr>
            <tr style="font-size: 12px">
                <th  align="left">Rut</th>
                <th  align="left">: 76.055.173-2</th>
                <th  align="left"></th>
                <th  align="left">Rut</th>
                <th  align="left">: '.$proveedor['rut'].'</th>
            </tr>
            <tr style="font-size: 12px">
                <th  align="left">Giro</th>
                <th  align="left">: Construcci&oacute;n en Obras Menores</th>
                <th  align="left"></th>
                <th  align="left">Giro</th>
                <th  align="left">: '.$proveedor['giro'].'</th>
            </tr>
            <tr style="font-size: 12px">
                <th  align="left">Ciudad</th>
                <th  align="left">: Curic&oacute;</th>
                <th  align="left"></th>
                <th  align="left">Ciudad</th>
                <th  align="left">: '.$proveedor['ciudad'].'</th>
            </tr>
            <tr style="font-size: 12px">
                <th  align="left">Fono/Fax</th>
                <th  align="left">: +56 9 8188 1135</th>
                <th  align="left"></th>
                <th  align="left">Fono/Fax</th>
                <th  align="left">: '.$proveedor['telefono'].'</th>
            </tr>
            <tr style="font-size: 12px">
                <th  align="left">Emal</th>
                <th  align="left">: '.$solicita['email'].'</th>
                <th  align="left"></th>
                <th  align="left">Email</th>
                <th  align="left">: '.$proveedor['email'].'</th>
            </tr>
 		</table>
 	<br>
 		<table width="90%" border="1" align="center" cellspacing="0" cellpadding="5">
            <thead style="background-color: dodgerblue; color: white; font-family: Verdana, Geneva, Tahoma, sans-serif; text-align: center;">
                <tr>
                    <td>MEDIDA</td>
                    <td>DESCRIPCION</td>
                    <td>CANTIDAD</td>
                    <td>P.U.</td>
                    <td>TOTAL</td>
                </tr>
            </thead>
            <tbody>';
foreach( $compra_det as $value ):
$codigoHTML.= ' <tr>
                    <td>'.$value['medida'].'</td>';
    $materiales =   $clase->ShowById( 'materiales', $value['descripcion'] );
$codigoHTML.= '     <td>'.$materiales['nombre'].'</td>
                    <td>'.$value['cantidad'].'</td>
                    <td>$ '.number_format( $value['valor'], 0, ',', '.' ).'</td>
                    <td>$ '.number_format( $value['total'], 0, ',', '.' ).'</td>
                </tr>';
endforeach;
$codigoHTML.= ' </tbody>
            <tfoot>
                <tr>
                    <th colspan="4" align="right">Sub-Total</th>
                    <td align="right">$ '.number_format( $compra_enc['total'], 0, ',', '.' ).'</td>
                </tr>
                <tr>
                    <th colspan="4" align="right">IVA</th>
                    <td align="right">$ '.number_format( ( $compra_enc['total'] * 0.19 ), 0, ',', '.' ).'</td>
                </tr>
                <tr>
                    <th colspan="4" align="right">TOTAL</th>
                    <th align="right">$ '.number_format( ( $compra_enc['total'] * 1.19 ), 0, ',', '.' ).'</th>
                </tr>
            </tfoot>
 		</table><br>

         <table border="0" cellspacing="0" width="90%" align="center">
 		    <tr style="font-size: 12px">
 		        <td ><strong>FORMA DE PAGO : </strong>'.$compra_enc['formaPago'].'</td>
 		        
 		    </tr>
 		</table> 
 	<p></p>  
 		<br><br><br>
 		
 		<table border="0" cellspacing="0" width="90%" align="center">
 		    <tr style="font-size: 12px">
 		        <td width="33%" align="center" ><hr>
                    SOLICITA<br>'.$solicita['nombre'].'</td>
 		        <td width="33%"></td>
 		        <td width="33%" align="center" ><hr>
                    AUTORIZA<br>'.$autoriza['nombre'].'</td>
 		    </tr>
 		</table>  

 </body>
 </html>';

$codigoHTML=utf8_decode($codigoHTML);
$dompdf = new Dompdf();
$dompdf->setPaper("letter", "portrait");
$dompdf->loadHtml($codigoHTML);
ini_set("memory_limit","128M");
$dompdf->render();
$dompdf->stream("HoraExtra-".$id.".pdf");

 ?>