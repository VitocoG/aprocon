<?php
require_once '../layouts/blade/head.php';
require_once '../layouts/blade/header.php'; 
require_once '../layouts/blade/aside.php';
require_once '../layouts/blade/body_up.php';

require_once 'Classes/PHPExcel/IOFactory.php'; //Agregamos la librería
require_once '../config/core.class.php';
$core   = new core;


//string de conexion a la base de datos
$con =  mysqli_connect("localhost", "aproconc_root", "magodeoz1249", "aproconc_depositos");

echo ($con) ? '' : 'Conexion Fallida';

//verificamos que el formulario envie los datos

    $nombreArchivo     =   $_FILES['archivo']['name'];
    $tipoArchivo     =   $_FILES['archivo']['type'];
    $origenArchivo     =   $_FILES['archivo']['tmp_name'];
    
    //se mueve el archivo a la ruta especificada
	move_uploaded_file($origenArchivo, $nombreArchivo);

//cargamos el archivo para leerlo
$objPHPExcel = PHPEXCEL_IOFactory::load($nombreArchivo);
//seleccionamos la hoja 1 del libro de excel
$objPHPExcel->setActiveSheetIndex(0);
//obtenemos el numero de filas de la hoja
$numRows = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();


echo '
<table class="table table-bordered table-hover">
    <tr>
        <th>Contrato</th>
        <th>Ciudad</th>
        <th>Adm. de Contrato</th>
        <th>Enc. Bodega</th>
        <th>Fecha</th>
    </tr>';
    
//guardamos los datos de excel en las variables		
$contrato   = $objPHPExcel->getActiveSheet()->getCell('B8')->getCalculatedValue();
$ciudad     = $objPHPExcel->getActiveSheet()->getCell('B9')->getCalculatedValue();
$admin      = $objPHPExcel->getActiveSheet()->getCell('B10')->getCalculatedValue();
$bodega     = $objPHPExcel->getActiveSheet()->getCell('B11')->getCalculatedValue();
$fecha      = $objPHPExcel->getActiveSheet()->getCell('B12')->getCalculatedValue();

//insertamos los datos
$sql = "INSERT INTO inventario (contrato, admministrador, encargado, fecha, ciudad) VALUES ('$contrato', '$admin', '$bodega', '$fecha', '$ciudad')";
$result = $con->query($sql);

//guardamos el ultimo id ingresado en la variable inventario
$inventario     =   mysqli_insert_id($con);

//funcion para rescatar datos guardados del encabezado. La funcion esta en /config/core.class.php
$encabezado     =   $core->ShowById( 'inventario', $inventario );

//bucle para mostrar los datos en pantalla
foreach( $encabezado as $fila)
{
    echo '
    <tr>
        <td>'.$contrato.'</td>
        <td>'.$ciudad.'</td>
        <td>'.$admin.'</td>
        <td>'.$bodega.'</td>
        <td>'.$fecha.'</td>
    </tr>
    ';
}



echo '
<table class="table table-bordered table-hover">
    <tr>
        <th>Codigo</th>
        <th>Categoria</th>
        <th>Nombre</th>
        <th>Marca</th>
        <th>Modelo</th>
        <th>Serie</th>
        <th>Ubicacion</th>
        <th>Cantidad</th>
    </tr>';

for($i = 15; $i <= $numRows; $i++){
		
		$codigo = $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue();
		$categoria = $objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue();
		$nombre = $objPHPExcel->getActiveSheet()->getCell('C'.$i)->getCalculatedValue();
		$marca = $objPHPExcel->getActiveSheet()->getCell('D'.$i)->getCalculatedValue();
		$modelo = $objPHPExcel->getActiveSheet()->getCell('E'.$i)->getCalculatedValue();
		$serie = $objPHPExcel->getActiveSheet()->getCell('F'.$i)->getCalculatedValue();
		$ubicacion = $objPHPExcel->getActiveSheet()->getCell('G'.$i)->getCalculatedValue();
		$cantidad = $objPHPExcel->getActiveSheet()->getCell('H'.$i)->getCalculatedValue();
		
		$sql = "INSERT INTO detalle_inventario (codigo, categoria, nombre, marca, modelo, serie, ubicacion, cantidad, inventario) VALUES ('$codigo', '$categoria', '$nombre', '$marca', '$modelo', '$serie', '$ubicacion', '$cantidad', '$inventario' )";
		$result = $con->query($sql);
		
	}
$detalle = $core->SelectByKey( 'detalle_inventario', 'inventario', $inventario );	
foreach( $detalle as $row )
{
    echo '
    <tr>
        <td>'.$row['codigo'].'</td>
        <td>'.$row['categoria'].'</td>
        <td>'.$row['nombre'].'</td>
        <td>'.$row['marca'].'</td>
        <td>'.$row['modelo'].'</td>
        <td>'.$row['serie'].'</td>
        <td>'.$row['ubicacion'].'</td>
        <td>'.$row['cantidad'].'</td>
    </tr>
    ';
}
	
echo '
</table>';

unlink($nombreArchivo);

require_once'../layouts/blade/body_down.php';
require_once'../layouts/blade/footer.php';
require_once'../layouts/blade/jquery.php';  
require_once'../layouts/blade/fin.php';  



?>