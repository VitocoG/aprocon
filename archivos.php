<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>ARCHIVOS</title>
</head>
<body>
	<form action="" method="post" enctype="multipart/form-data">
		<input type="file" name="archivo"><br><br>
		<button type="submit">Guardar</button>
		<?php 

if (isset($_FILES['archivo']))
{
	$nombre = $_FILES['archivo']['name'];
	$origen = $_FILES['archivo']['tmp_name'];
	move_uploaded_file($origen, $nombre);
	echo '<a href="'.$nombre.'">'.$nombre.'</a>';
}


?>
	</form>
</body>
</html>