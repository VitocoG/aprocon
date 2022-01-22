<?php 

require_once '../../public/dompdf/dompdf_config.inc.php';

$bodegaDestino  =   $model->ShowById( 'bodegas', $destino );
foreach ( $bodegaDestino as $key ):
    $bodegaDestino = $key['nombre'];
endforeach;

$localidadDestino = $model->ShowById( 'localidades', $key['localidad'] );
foreach ( $localidadDestino as $key ):
    $localidadDestino = $key['nombre'];
endforeach;





$codigoHTML = '

 <!DOCTYPE html>
<html>
<head>
 	<title>InnoControl | www.innobit.cl</title>

<style type="text/css">
 #entrega {
	 font-size: 12px;
}
 #pie {
	 font-size: 8px;
}
</style>
</head>
<body>

 	<table width="90%" align="center">
	 	<tr>
			<td width="20%" align="left"><img src="../../public/img/aprocon.jpg" height="120"></td>
		  	<td align="center" valign="bottom"><strong>TRASPASO DE MATERIALES</strong></td>
			<td width="20%" align="right" valign="bottom">N&deg; '.$id_enc.'</td>
		</tr>
 </table><br>
	 
<table width="90%" border="1" align="center" cellpadding="5" cellspacing="0" class="tabla">
	 	<tr>
		 	<td>DESDE '.$_SESSION['bodegaNombre'].'</td>
			<td align="center">'.date('d-m-Y', strtotime( $fecha ) ).'</td>
	   </tr>
	 	<tr>
		 	<td colspan="2">HASTA '.$bodegaDestino.' '.$localidadDestino.'</td>
	    </tr>
	 </table><br><br>
	 
<table width="90%" border="1" align="center" cellpadding="5" cellspacing="0" id="entrega">
	 	<tr>
		 	<th width="8%">CANTIDAD</th>
		 	<th width="67%">CONCEPTO</th>
		 	<th width="8%">PRECIO</th>
		 	<th width="17%">SUBTOTAL</th>
	   </tr>';


$detalles   =   $clase->mostrarMaterial( $id_enc );
foreach( $detalles as $row ):
$codigoHTML.= '
	 	<tr>
		 	<td>'.$row['cantidad'].'</td>
		 	<td>'.$row['material'].'</td>
		 	<td>$ '.number_format( $row['valor'], 0,  ',', '.' ).'</td>
		 	<td>$ '.number_format( ( $row['cantidad'] * $row['valor'] ), 0,  ',', '.' ).'</td>
		</tr>';
endforeach;
		
$codigoHTML.= '
	 </table><br>
	 
	<div style="width:100%; text-align:center;" >
		
	 <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" id="pie">
	 	<tr>
		 	<td width="37%">
				<table width="100%" border="1" cellpadding="5" cellspacing="0">
					<tr align="center" valign="top">
						<td width="70%" height="70">RECIBO CONFORME</td>
						<td width="30%" height="70">Huella</td>
				  </tr>
			  </table>
		  </td>
		 	<td></td>
		 	<td width="50%">
				<table width="100%" border="1" align="center" cellpadding="5" cellspacing="0">
					<tr>
						<td height="70" align="left" valign="top">OBSERVACIONES: <hr><br><hr><br><hr><br><hr><br><hr></td>
					</tr>
				</table>
		  </td>
		 	<td></td>
		 	<td width="8%">
				<table width="100%" border="1" cellpadding="5" cellspacing="0">
					<tr>
						<td height="70" align="center" valign="top">FOTO</td>
				  </tr>
				</table>
		  </td>
	   </tr>
	 </table><br><br><br><br>
	
	  <p><hr width="50%" >Entrega: '.$_SESSION['nombre'].'</p>
	</div>
	
</body>
</html>';

#echo $codigoHTML;
/*use DOMPDF\Dompdf;*/
$codigoHTML=utf8_decode($codigoHTML);
$dompdf=new DOMPDF();
$dompdf->set_paper("LETTER", "portrait");
$dompdf->load_html($codigoHTML);
ini_set("memory_limit","128M");
$dompdf->render();
$dompdf->stream("Traspaso ".$id_enc.".pdf");

 ?>