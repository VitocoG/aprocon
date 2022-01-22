<?php
require_once '../../layouts/blade/head.php';
require_once '../../layouts/blade/header.php'; 
require_once '../../layouts/blade/aside.php';
require_once '../../layouts/blade/body_up.php';

$id 		= 	$_REQUEST['id'];
require_once 'gastos.class.php';
$gastos 		= 	new gastos;

$todo 	=	$gastos->ListarDetalle( $id );
?>

<div class="row">
  <div class="col-lg-8">
    <h3>Detalle del Gasto N°<?php echo $id ?> </h3>
  </div><!-- /.col -->
</div><!-- /.row -->

<!-- @include('compras.proveedores.search') -->
<div class="row">
  <div class="col-xs-12">
    <div class="table-responsive">
      <table class="table table-striped table-bordered table-condensed table-hover">
        <thead>
          <tr>
            <th>#</th>
            <th>Cantidad</th>
            <th>Detalle</th>
            <th>Monto</th>
            <th>Total</th>
          </tr>
        </thead>
        <tbody>

<?php 
foreach ( $todo as $row )
{
	$idDetalle 	= 	$row['id'];
	$cantidad 	= 	$row['cantidad'];
	$detalle 	= 	$row['detalle'];
	$monto 		= 	$row['monto'];
	$total 		= 	$cantidad * $monto;
	$sum		= 	$sum + $total;
?>

          <tr>
            <td><?php echo $idDetalle ?></td>
            <td><?php echo $cantidad ?></td>
            <td><?php echo $detalle ?></td>
            <td><?php echo '$ '.number_format($monto, '0',',','.') ?></td>
            <td><?php echo '$ '.number_format($total, '0',',','.') ?></td>
          </tr>
<?php } ?>

        </tbody>
        <tfoot>
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td><h3><strong>TOTAL</strong></h3></td>
				<td><h3><strong><?php echo '$ '.number_format($sum, '0', ',', '.'); ?></strong></h3></td>
			</tr>
        </tfoot>
      </table>
    </div><!-- /.table-responsive -->
  </div><!-- /.col -->
</div><!-- /.row -->
	
<?php 
require_once'../../layouts/blade/body_down.php';
require_once'../../layouts/blade/footer.php';
require_once'../../layouts/blade/jquery.php';  
require_once '../../layouts/blade/fin.php';
?>