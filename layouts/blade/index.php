
<?php 
require_once '../../config/core.class.php';

require_once 'head.php';
require_once 'header.php'; 
require_once 'aside.php';
require_once 'body_up.php';
?>

<div class="row">
	<table class="table">
		<tr>
			<th>#</th>
			<th>Rut</th>
			<th>Nombre</th>
			<th>E-mail</th>
		</tr>
		<?php 
		$core = new core;
		$lista = $core->ShowAll( 'usuarios' );
		foreach ($fila as $lista) {
			echo"
		<tr>
			<th>'.$fila['id'].'</th>
			<th>'.$fila['rut'].'</th>
			<th>'.$fila['nombre'].'</th>
			<th>E-'.$fila['email'].'</th>
		</tr>";
		}
		 ?>
	</table>
</div>

<?php
require_once 'body_down.php';                
require_once 'footer.php'; 
require_once 'jquery.php';
?>