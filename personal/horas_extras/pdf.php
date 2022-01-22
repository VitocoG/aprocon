<?php 
require_once '../../public/dompdf/dompdf_config.inc.php';

$informe    =   $clase->pdf( $id );

foreach( $informe as $row ):
    $fecha  	=   strtotime( $row['fecha_inicio'] );
    $fecha_i    =   date( 'd-m-Y', $fecha );
	$hora_i     =   date( 'H:i:s', $fecha );
	
	$termino    =   strtotime( $row['fecha_termino']);
    $hora_t     =   date( 'H:i:s', $termino);
    
    $total  =   $row['total_horas'];
    $motivo =   $row['motivo'];
    
    $trabajador =   $row['nombre']." ".$row['apellido'];
    $cargo   =   $row['cargo'];
    
    $jefe_terreno   =   $row['jefe_terreno'];
    $ods        =   $row['ods'];
endforeach;

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
 				<th align="left" valign="bottom">AUTORIZACION PARA REALIZAR HORAS EXTRAS</th>
 			</tr>
 		</table>
 		<br>

		 	

 		 	

 		
 		<table width="90%" border="1" align="center" cellspacing="0" cellpadding="5">
 		    <tr style="font-size: 12px">
 		        <th align="left" width="25%">NOMBRE DEL TRABAJADOR</th>
 		        <td>'.$trabajador.'</td>
 		    </tr>
 		    <tr style="font-size: 12px">
 		        <th align="left" width="25%">FECHA</th>
 		        <td>'.$fecha_i.'</td>
 		    </tr>
 		    <tr style="font-size: 12px">
 		        <th align="left" width="25%">CARGO</th>
 		        <td>'.$cargo.'</td>
 		    </tr>
 		    <tr style="font-size: 12px">
 		        <th align="left" width="25%">PERSONA QUE AUTORIZA</th>
 		        <td>'.$jefe_terreno.'</td>
 		    </tr>
 		    <tr style="font-size: 12px">
 		        <th align="left" width="25%">ODS</th>
 		        <td>'.$ods.'</td>
 		    </tr>
 		</table>
 	<br>
 		<table width="90%" border="1" align="center" cellspacing="0" cellpadding="5">
 		    <tr style="font-size: 12px">
 		        <th align="left" width="16.6%">HORA INICIO</th>
 		        <td width="16.6%" align="center">'.$hora_i.'</td>
 		        <th align="left" width="16.6%">HORA TERMINO</th>
 		        <td width="16.6%" align="center">'.$hora_t.'</td>
 		        <th align="left" width="16.6%">TOTAL HORAS EXTRAS</th>
 		        <td width="16.6%" align="center">'.$total.'</td>
 		    </tr>
 		</table>
 		<br>
 		<table width="90%" border="1" align="center" cellspacing="0" cellpadding="5">
 		    <tr style="font-size: 12px">
 		        <th>DETALLE DEL TRABAJO A REALIZAR</th>
 		    </tr>
 		    <tr style="font-size: 12px">
 		        <td  height="10" valign="top">'.$motivo.'</td>
 		    </tr>
 		</table>
 		<br><br><br>
 		
 		<table border="0" cellspacing="0" width="90%" align="center">
 		    <tr style="font-size: 12px">
 		        <td width="33%" align="center" ><hr>'.$trabajador.'</td>
 		        <td width="33%"></td>
 		        <td width="33%" align="center" ><hr>'.$jefe_terreno.'</td>
 		    </tr>
 		</table>
 		
 		<br><hr>
 		
 		<table width="90%" align="center" border="0" cellspadding="20">
 			<tr>
 				<th width="25%"><img src="../../public/img/aprocon.jpg" height="120px" align="left"></th>
 				<th align="left" valign="bottom">AUTORIZACION PARA REALIZAR HORAS EXTRAS</th>
 			</tr>
 		</table>
 		<br>

		 	

 		 	

 		
 		<table width="90%" border="1" align="center" cellspacing="0" cellpadding="5">
 		    <tr style="font-size: 12px">
 		        <th align="left" width="25%">NOMBRE DEL TRABAJADOR</th>
 		        <td>'.$trabajador.'</td>
 		    </tr>
 		    <tr style="font-size: 12px">
 		        <th align="left" width="25%">FECHA</th>
 		        <td>'.$fecha_i.'</td>
 		    </tr>
 		    <tr style="font-size: 12px">
 		        <th align="left" width="25%">CARGO</th>
 		        <td>'.$cargo.'</td>
 		    </tr>
 		    <tr style="font-size: 12px">
 		        <th align="left" width="25%">PERSONA QUE AUTORIZA</th>
 		        <td>'.$jefe_terreno.'</td>
 		    </tr>
 		    <tr style="font-size: 12px">
 		        <th align="left" width="25%">ODS</th>
 		        <td>'.$ods.'</td>
 		    </tr>
 		</table>
 	<br>
 		<table width="90%" border="1" align="center" cellspacing="0" cellpadding="5">
 		    <tr style="font-size: 12px">
 		        <th align="left" width="16.6%">HORA INICIO</th>
 		        <td width="16.6%" align="center">'.$hora_i.'</td>
 		        <th align="left" width="16.6%">HORA TERMINO</th>
 		        <td width="16.6%" align="center">'.$hora_t.'</td>
 		        <th align="left" width="16.6%">TOTAL HORAS EXTRAS</th>
 		        <td width="16.6%" align="center">'.$total.'</td>
 		    </tr>
 		</table>
 		<br>
 		<table width="90%" border="1" align="center" cellspacing="0" cellpadding="5">
 		    <tr style="font-size: 12px">
 		        <th>DETALLE DEL TRABAJO A REALIZAR</th>
 		    </tr>
 		    <tr style="font-size: 12px">
 		        <td  height="10" valign="top">'.$motivo.'</td>
 		    </tr>
 		</table>
 		<br><br><br>
 		
 		<table border="0" cellspacing="0" width="90%" align="center">
 		    <tr style="font-size: 12px">
 		        <td width="33%" align="center" ><hr>'.$trabajador.'</td>
 		        <td width="33%"></td>
 		        <td width="33%" align="center" ><hr>'.$jefe_terreno.'</td>
 		    </tr>
 		</table>
 	    

 </body>
 </html>';

/*use DOMPDF\Dompdf;*/
$codigoHTML=utf8_decode($codigoHTML);
$dompdf=new DOMPDF();
$dompdf->set_paper("LEGAL", "portrait");
$dompdf->load_html($codigoHTML);
ini_set("memory_limit","128M");
$dompdf->render();
$dompdf->stream("HoraExtra-".$id.".pdf");

 ?>