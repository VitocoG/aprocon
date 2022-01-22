<?php 
$fecha1 	= 	$_POST['fechaUno'];
$fecha2 	= 	$_POST['fechaDos'];

require_once '../../layouts/blade/head.php';
require_once '../../layouts/blade/header.php';
require_once '../../layouts/blade/aside.php';
require_once '../../layouts/blade/body_up.php';
?>


<!--Contenido-->  
<div class="row">
  <div class="col-lg-8">
    <h3>Listado Gastos y Dep&oacute;sitos por Persona
    <a href="resumen.php" class="btn btn-warning">Ver Resumen</a> </h3>
  </div>
</div>

<div class="row">
	<div class="col-md-8">
		<form action="" class="form" method="post">
			<div class="col-md-5">
				<div class="form-group">
					<label for="fechaUno">Fecha Inicio</label>
					<input type="date" name="fechaUno" class="form-control" required value="<?php echo $fecha1 ?>">
				</div>
			</div>
			<div class="col-md-5">
				<div class="form-group">
					<label for="fecha>Dos">Fecha de T&eacute;rmino</label>
					<input type="date" name="fechaDos" class="form-control" required value="<?php echo $fecha2 ?>">
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
				<label for="btnBuscar">   </label>
					<button type="submit" class="btn btn-success form-control" name="btnBuscar">Buscar</button>
				</div>
				
			</div>
		</form>
	</div>
</div>

<!-- @include('compras.proveedores.search') -->
<div class="row">
  <div class="col-xs-12">
    <div class="table-responsive">
      <table class="table table-striped table-bordered table-condensed table-hover">
        <thead>
          <tr class="bg-danger">
            <th>Nombre</th>
            <th>Depósitos</th>
            <th>Gastos</th>
            <th>Saldo</th>
          </tr>
        </thead>
        <tbody>
<?php 
require_once 'saldos.class.php';
$saldos 	= 	new saldos;
$dep 	= $saldos->DepositoPersonas( $fecha1, $fecha2 );
foreach( $dep as $row )
{ ?>
    
            <tr>
				<td><?php echo $row['nombre'] ?></td>
				<td><?php echo '$ '.number_format($row['deposito'], '0', ',', '.') ?></td>
<?php
$id     = $row['id'];
$gas    = $saldos ->GastoPersonas($fecha1, $fecha2, $id);				
	foreach( $gas as $fila )
	{ 
	    $gasto +=    $fila['gasto'] ?>
				
				
				
<?php } ?>
                <td><?php echo '$ '.number_format($gasto, '0', ',', '.'); 
                $total = ($row['deposito'] - $gasto); ?></td>
				<th><?php echo '$ '.number_format($total, '0', ',', '.') ?></th>
			</tr>
    
    <?php
$gasto = 0; 
    }

  ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php
require_once '../../layouts/blade/body_down.php';
require_once '../../layouts/blade/footer.php';
require_once '../../layouts/blade/jquery.php';
require_once '../../layouts/blade/fin.php';
?>