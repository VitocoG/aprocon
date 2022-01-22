<?php 

require_once '../../layouts/blade/head.php';
require_once '../../layouts/blade/header.php';
require_once '../../layouts/blade/aside.php';
require_once '../../layouts/blade/body_up.php';
?>


<!--Contenido-->  
<div class="row">
  <div class="col-lg-8">
    <h3>Listado Gastos y Dep&oacute;sitos por Persona </h3>
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
            <th></th>
          </tr>
        </thead>
        <tbody>
<?php 
require_once 'saldos.class.php';
$saldos 	= 	new saldos;
$dep 	= $saldos->DepositoPersonasResumen();
foreach( $dep as $row )
{  ?>

            <tr>
				<td><?php echo $row['nombre'] ?></td>
				<td><?php echo '$ '.number_format($row['deposito'], '0', ',', '.') ?></td>
<?php
$id     = $row['id'];
$gas    = $saldos->GastoPersonasResumen( $id );				
	foreach( $gas as $fila )
	{ 
	    $gasto +=    $fila['gasto'] ?>
				
				
				
<?php } ?>
                <td><?php echo '$ '.number_format($gasto, '0', ',', '.'); 
                $total = ($row['deposito'] - $gasto); ?></td>
				<th><?php echo '$ '.number_format($total, '0', ',', '.') ?></th>
				<th><a href="detalles.php?id=<?php echo $id ?>" class="btn btn-danger">Detalles</a></th>
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