<?php 

require_once '../../public/dompdf/autoload.inc.php';
use Dompdf\Dompdf;
//require_once '../../public/dompdf/dompdf_config.inc.php';

/*require_once('./entregaModel.php');
$clase		=	new entrega;*/

    if( $mostrarAbiertas['tipo'] == 'u' ):
        $clases =   'usuarios';
        $recibe =   $clases.'.nombre';
    else:
        $clases =   'trabajadores';
        $recibe =   "CONCAT(".$clases.".apellido, ' ', ".$clases.".nombre ) "; 
    endif;	

	$Listar =   $clase->ListarAbiertas( $recibe, $clases, $mostrarAbiertas['id'] );
	foreach ($Listar as $value ):
		$localidad	=	$value['localidad'];
		$fecha  	=   date( 'd-m-Y H:i', strtotime( $value['fecha'] ) );
		$concepto	=	$value['concepto'];
	endforeach;

    $entrega = $clase->ShowById( 'usuarios', $mostrarAbiertas['entrega'] );
    $quienEntrega = $entrega['nombre'];


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
		  	<td align="center" valign="bottom"><strong>NOTA DE ENTREGA</strong></td>
			<td width="20%" align="right" valign="bottom">N&deg; '.$idEnc.'</td>
		</tr>
 </table><br>
	 
<table width="90%" border="1" align="center" cellpadding="5" cellspacing="0" class="tabla">
	 	<tr>
		 	<td>'.$localidad.', '.$fecha.'</td>
			<td>'.$concepto.'</td>
	   </tr>
	 	<tr>
		 	<td colspan="2">'.$value['recibe'].'</td>
	    </tr>
	 </table><br><br>
	 
<table width="90%" border="1" align="center" cellpadding="5" cellspacing="0" id="entrega">
	 	<tr>
		 	<th width="8%">CANTIDAD</th>
		 	<th width="37%">CONCEPTO</th>
		 	<th width="8%">PRECIO</th>
		 	<th width="17%">ESTADO</th>
		 	<th width="30%">OBSERVACIONES</th>
	   </tr>';

$detalle	=	$model->SelectByKey( $class.'_det', $class.'_enc', $idEnc, '' );
foreach( $detalle as $row ):
$codigoHTML.= '
	 	<tr>
		 	<td>'.$row['cantidad'].'</td>
		 	<td>'.$row['concepto'].'</td>
		 	<td>'.$row['precio'].'</td>
		 	<td>'.$row['estado'].'</td>
		 	<td>'.$row['observaciones'].'</td>
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
	
	  <p><hr width="50%" >Entrega: '.$quienEntrega.'</p>
	</div>
	
</body>
</html>

';


$codigoHTML=utf8_decode($codigoHTML);
$dompdf=new DOMPDF();
$dompdf->setPaper("LETTER", "portrait");
$dompdf->loadHtml($codigoHTML);
ini_set("memory_limit","128M");
$dompdf->render();
$dompdf->stream("Nota de Entrega ".$idEnc.".pdf");

 ?>