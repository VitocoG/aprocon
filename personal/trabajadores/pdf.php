<?php

require_once '../../config/core.class.php';
$core   =   new core;
session_start();
$usuarios  = $core->Permisos( 'trabajadores', 'permisos', $_SESSION['id'] );
foreach($usuarios as $row)
{
    $dep = $row['trabajadores'];
}

if( $dep == 1 )
{
 

require_once '../../public/dompdf/dompdf_config.inc.php';

$id =   $_REQUEST['id'];

$conexion       =   mysqli_connect( 'localhost','aproconc_root','Y8i4[P0p{xpn','aproconc_depositos');
$sql            =   "SELECT 
	                        tra.id id,
                            tra.nombre nombre,
                            tra.apellido apellido,
                            tra.rut rut,
                            tra.fecha fecha,
                            tra.domicilio domicilio,
                            lo.nombre localidad,
                            ec.nombre ecivil,
                            tra.telefono telefono,
                            es.nombre estudios,
                            tra.titulo titulo,
                            tra.licencia licencia,
                            ta.nombre talla,
                            cal.nombre calzado,
                            tra.alergia alergia,
                            tra.observaciones observaciones,
                            car.nombre cargo,
                            tra.ingreso ingreso,
                            tra.retiro retiro, 
                            usu.nombre supervisor,
                            bri.nombre brigada,
                            afp.nombre afp,
                            salud.nombre salud,
                            tra.cargas cargas,
                            tra.accidenteNombre accidenteNombre,
                            tra.accidenteNumero accidenteNumero,
                            tra.estado estado
    
                    FROM trabajadores tra

                    INNER JOIN localidades lo ON lo.id=tra.localidad
                    INNER JOIN ecivil ec ON ec.id=tra.ecivil
                    INNER JOIN estudios es ON es.id=tra.estudios
                    INNER JOIN talla ta ON ta.id=tra.talla
                    INNER JOIN calzado cal ON cal.id=tra.calzado
                    INNER JOIN cargos car ON car.id=tra.cargo
                    INNER JOIN usuarios usu ON usu.id=tra.supervisor
                    INNER JOIN brigadas bri ON bri.id=tra.brigada
                    INNER JOIN afp ON afp.id=tra.afp
                    INNER JOIN salud ON salud.id=tra.salud

                    WHERE tra.id=$id";
$informe    =   $conexion->query( $sql );

foreach( $informe as $row )
{
    $nombres        =   $row['nombre'];
    $apellidos      =   $row['apellido'];
    $domicilio      =   $row['domicilio'];
    $localidad      =   $row['localidad'];
    $rut            =   $row['rut'];
    $fecha          =   $row['fecha'];
    $ecivil         =   $row['ecivil'];
    $telefono       =   $row['telefono'];
    $cargas         =   $row['cargas'];
    $estudios       =   $row['estudios'];
    $titulo         =   $row['titulo'];
    $supervisor     =   $row['supervisor'];
    $ingreso        =   $row['ingreso'];
    $retiro         =   $row['retiro'];
    $cargo          =   $row['cargo'];
    $brigada        =   $row['brigada'];
    $afp            =   $row['afp'];
    $salud          =   $row['salud'];
    $talla          =   $row['talla'];
    $calzado        =   $row['calzado'];
    $licencia       =   $row['licencia'];
    $alergia        =   $row['alergia'];
    $observaciones  =   $row['observaciones'];
    $accidenteNombre=   $row['accidenteNombre'];
    $accidenteNumero=   $row['accidenteNumero'];
    
    $jefe_contrato  =   ( $localidad=="SAN FERNANDO" || $localidad=="RENGO" || $localidad=="SANTA CRUZ"  )?"REN&Eacute; ANTONIO PUJADO GALARCE":(($localidad=="PARRAL" || $localidad=="LINARES" || $localidad=="CAUQUENES" )?"CRISTIAN FERNANDEZ MU&Ntilde;OZ":"MARTA ALMONACID LLANCAMIL");
}

$codigoHTML =   '

 <!DOCTYPE html>
 <html>
 <head>
	 <title>InnoControl | www.innobit.cl</title>
 	<style>	@page { margin: 0px; } </style>
 </head>
 <body>

 	
	<table width="90%" align="center" border="0" cellspadding="20">
 			<tr>
 				<th width="25%"><img src="../../public/img/aprocon.jpg" height="120px" align="left"></th>
 				<th align="left" valign="bottom" style=" font-size: 20px">FICHA DE INGRESO DE PERSONAL</th>
 			</tr>
 		</table>
 		<br>

 		<table width="90%" border="1" align="center" cellspacing="0" cellpadding="5">
 		    <tr style="font-size: 12px; background-color: CORNFLOWERBLUE;">
 		        <th align="left" width="50%">APELLIDOS</th>
 		        <th align="left" width="50%">NOMBRES</th>
 		    </tr>
 		    <tr style="font-size: 12px">
 		        <td>'.$apellidos.'</td>
 		        <td>'.$nombres.'</td>
 		    </tr>
 		</table>
 	<br>
 	
 	<table width="90%" border="1" align="center" cellspacing="0" cellpadding="5">
 		    <tr style=" font-size: 12px; background-color: CORNFLOWERBLUE;">
 		        <th align="left" width="75%">DOMICILIO</th>
 		        <th align="left" width="25%">LOCALIDAD</th>
 		    </tr>
 		    <tr style="font-size: 12px">
 		        <td>'.$domicilio.'</td>
 		        <td>'.$localidad.'</td>
 		    </tr>
 		</table>
 		<br>
 		
 	<table width="90%" border="1" align="center" cellspacing="0" cellpadding="5">
 		    <tr style=" font-size: 12px; background-color: CORNFLOWERBLUE;">
 		        <th align="left" width="20%">RUT</th>
 		        <th align="left" width="20%">F. NACIMIENTO</th>
 		        <th align="left" width="20%">E. CIVIL</th>
 		        <th align="left" width="20%">CARGAS</th>
 		        <th align="left" width="20%">TELEFONO</th>
 		    </tr>
 		    <tr style="font-size: 12px">
 		        <td>'.$rut.'</td>
 		        <td>'.$fecha.'</td>
 		        <td>'.$ecivil.'</td>
 		        <td>'.$cargas.'</td>
 		        <td>'.$telefono.'</td>
 		    </tr>
 		</table>
 		<br>
 	
 	<table width="90%" border="1" align="center" cellspacing="0" cellpadding="5">
 		    <tr style=" font-size: 12px; background-color: CORNFLOWERBLUE;">
 		        <th align="left" width="50%">ESTUDIOS CURSADOS</th>
 		        <th align="left" width="50%">PROFESION</th>
 		    </tr>
 		    <tr style="font-size: 12px">
 		        <td>'.$estudios.'</td>
 		        <td>'.$titulo.'</td>
 		    </tr>
 		</table>
 		<br>
 		
 	<table width="90%" border="1" align="center" cellspacing="0" cellpadding="5">
 		    <tr style=" font-size: 12px; background-color: CORNFLOWERBLUE;">
 		        <th align="left" width="30%">SUPERVISOR</th>
 		        <th align="left" width="20%">INGRESO</th>
 		        <th align="left" width="20%">RETIRO</th>
 		        <th align="left" width="30%">FUNCION A REALIZAR</th>
 		    </tr>
 		    <tr style="font-size: 12px">
 		        <td>'.$supervisor.'</td>
 		        <td>'.$ingreso.'</td>
 		        <td>'.$retiro.'</td>
 		        <td>'.$cargo.'</td>
 		    </tr>
 		</table>
 		<br>
 		
 	<table width="90%" border="1" align="center" cellspacing="0" cellpadding="5">
 		    <tr style=" font-size: 12px; background-color: CORNFLOWERBLUE;">
 		        <th align="left" width="20%">AFP</th>
 		        <th align="left" width="20%">SISTEMA DE SALUD</th>
 		        <th align="left" width="20%">TALLA VESTUARIO</th>
 		        <th align="left" width="20%">CALZADO</th>
 		        <th align="left" width="20%">LICENCIA DE CONDUCIR</th>
 		    </tr>
 		    <tr style="font-size: 12px">
 		        <td>'.$afp.'</td>
 		        <td>'.$salud.'</td>
 		        <td>'.$talla.'</td>
 		        <td>'.$calzado.'</td>
 		        <td>'.$licencia.'</td>
 		    </tr>
 		</table>
 		<br>
 		
 		<table width="90%" border="1" align="center" cellspacing="0" cellpadding="5">
 		    <tr style=" font-size: 12px; background-color: CORNFLOWERBLUE;">
 		        <th align="left" width="20%">ALERGIAS</th>
 		        <th align="left" width="80%">OBSERVACIONES</th>
 		    </tr>
 		    <tr style="font-size: 12px">
 		        <td>'.$alergia.'</td>
 		        <td>'.$observaciones.'</td>
 		    </tr>
 		</table>
 		<br>
 		
 		<table width="90%" border="1" align="center" cellspacing="0" cellpadding="5">
 		    <tr style=" font-size: 12px; background-color: CORNFLOWERBLUE;">
 		        <th align="left" width="80%">EN CASO DE ACCIDENTE AVISAR A:</th>
 		        <th align="left" width="20%">TELEFONO</th>
 		    </tr>
 		    <tr style="font-size: 12px">
 		        <td>'.$accidenteNombre.'</td>
 		        <td>'.$accidenteNumero.'</td>
 		    </tr>
 		</table>
 		
 		<br><br><br><br><br><br>
 		<table width="90%" border="0" align="center" cellspacing="0" cellpadding="0">
 		    <tr style="font-size: 12px">
 		        <th align="center" width="2%"></th>
 		        <th align="center" width="30%">COORDINADOR DE CONTRATO</th>
 		        <th align="center" width="2%">  </th>
 		        <th align="center" width="30%">SUPERVISOR</th>
 		        <th align="center" width="2%">  </th>
 		        <th align="center" width="32%">TRABAJADOR</th>
 		        <th align="center" width="2%">  </th>
 		    </tr>
 		    <tr style="font-size: 12px">
 		        <td align="center"></td>
 		        <td align="center"><hr/>'.$jefe_contrato.'</td>
 		        <td align="center"></td>
 		        <td align="center"><hr/>'.$supervisor.'</td>
 		        <td align="center"></td>
 		        <td align="center"><hr/>'.$nombres.' '.$apellidos.'</td>
 		        <td align="center"></td>
 		    </tr>
 		</table>
 		<br>
 	    
 </body>
 </html>';


$codigoHTML=utf8_decode( $codigoHTML );
$dompdf=new DOMPDF( );
$dompdf->set_paper("LETTER", "portrait");
$dompdf->load_html( $codigoHTML );
ini_set("memory_limit","128M");
$dompdf->render( );
$dompdf->stream( $nombres." ".$apellidos.".pdf" );

    
}
else
{
    header( 'Location:../../' );
}

//995499660
//nestor briones
?>