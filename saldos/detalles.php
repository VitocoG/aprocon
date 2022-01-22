<?php 

$id   =   $_REQUEST['id'];

require_once '../../layouts/blade/head.php';
require_once '../../layouts/blade/header.php';
require_once '../../layouts/blade/aside.php';
require_once '../../layouts/blade/body_up.php';

require_once 'saldos.class.php';
require_once '../../config/core.class.php';
$saldos   =   new saldos;
$core     =   new core;

$usuario  = $core->ShowById( 'usuarios', $id );
foreach ($usuario as $value) 
{
  $nombre   =   $value['nombre'];
}
?>


<!--Contenido-->  
<div class="row">
  <div class="col-lg-8">
    <h4>Detalle de Gastos y Dep&oacute;sitos <strong><?php echo $nombre ?></strong> </h4>
  </div>
</div>

<?php 
for ($i=date('Y'); $i>2017 ; $i--) 
{
?>
<!-- @include('compras.proveedores.search') -->
<br><h3><?php echo $i ?></h3>
<div class="row">
  <div class="col-xs-12">
    <div class="table-responsive">
      <table class="table table-striped table-bordered table-condensed table-hover">
        <thead>
          <tr class="bg-danger">
            <th></th>
            <th>Enero</th>
            <th>Febrero</th>
            <th>Marzo</th>
            <th>Abril</th>
            <th>Mayo</th>
            <th>Junio</th>
            <th>Julio</th>
            <th>Agosto</th>
            <th>Septiembre</th>
            <th>Octubre</th>
            <th>Noviembre</th>
            <th>Diciembre</th>
          </tr>
        </thead>
        <tbody>
          <tr class="bg-danger">
            <th>Dep&oacute;sitos</th>

<?php  
  $depositos  = $saldos->DepositoPersonasDetalle( $id, $i );

foreach ($depositos as $value)
{
echo "
            <td>$ ".number_format($value['Enero'], '0', ',', '.')."</td>
            <td>$ ".number_format($value['Febrero'], '0', ',', '.')."</td>
            <td>$ ".number_format($value['Marzo'], '0', ',', '.')."</td>
            <td>$ ".number_format($value['Abril'], '0', ',', '.')."</td>
            <td>$ ".number_format($value['Mayo'], '0', ',', '.')."</td>
            <td>$ ".number_format($value['Junio'], '0', ',', '.')."</td>
            <td>$ ".number_format($value['Julio'], '0', ',', '.')."</td>
            <td>$ ".number_format($value['Agosto'], '0', ',', '.')."</td>
            <td>$ ".number_format($value['Septiembre'], '0', ',', '.')."</td>
            <td>$ ".number_format($value['Octubre'], '0', ',', '.')."</td>
            <td>$ ".number_format($value['Noviembre'], '0', ',', '.')."</td>
            <td>$ ".number_format($value['Diciembre'], '0', ',', '.')."</td>";
}?>
          </tr>
          <tr>
            <th>Gastos</th>
<?php 
$gastos   =   $saldos->GastoPersonasDetalle( $id, $i );
foreach ($gastos as $row) 
{
echo "
            <td>$ ".number_format($row['Enero'], '0', ',', '.')."</td>
            <td>$ ".number_format($row['Febrero'], '0', ',', '.')."</td>
            <td>$ ".number_format($row['Marzo'], '0', ',', '.')."</td>
            <td>$ ".number_format($row['Abril'], '0', ',', '.')."</td>
            <td>$ ".number_format($row['Mayo'], '0', ',', '.')."</td>
            <td>$ ".number_format($row['Junio'], '0', ',', '.')."</td>
            <td>$ ".number_format($row['Julio'], '0', ',', '.')."</td>
            <td>$ ".number_format($row['Agosto'], '0', ',', '.')."</td>
            <td>$ ".number_format($row['Septiembre'], '0', ',', '.')."</td>
            <td>$ ".number_format($row['Octubre'], '0', ',', '.')."</td>
            <td>$ ".number_format($row['Noviembre'], '0', ',', '.')."</td>
            <td>$ ".number_format($row['Diciembre'], '0', ',', '.')."</td>";
} ?>
          </tr>
          <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
          </tr>
          <tr>
            <th>Saldos</th>
<?php
foreach ($gastos as $row) 
{
echo "
            <th>$ ".number_format( $enero        = $value['Enero']-$row['Enero'], '0', ',', '.')."</th>
            <th>$ ".number_format( $febrero      = $value['Febrero']-$row['Febrero'], '0', ',', '.')."</th>
            <th>$ ".number_format( $marzo        = $value['Marzo']-$row['Marzo'], '0', ',', '.')."</th>
            <th>$ ".number_format( $abril        = $value['Abril']-$row['Abril'], '0', ',', '.')."</th>
            <th>$ ".number_format( $mayo         = $value['Mayo']-$row['Mayo'], '0', ',', '.')."</th>
            <th>$ ".number_format( $junio        = $value['Junio']-$row['Junio'], '0', ',', '.')."</th>
            <th>$ ".number_format( $julio        = $value['Julio']-$row['Julio'], '0', ',', '.')."</th>
            <th>$ ".number_format( $agosto       = $value['Agosto']-$row['Agosto'], '0', ',', '.')."</th>
            <th>$ ".number_format( $septiembre   = $value['Septiembre']-$row['Septiembre'], '0', ',', '.')."</th>
            <th>$ ".number_format( $octubre      = $value['Octubre']-$row['Octubre'], '0', ',', '.')."</th>
            <th>$ ".number_format( $noviembre    = $value['Noviembre']-$row['Noviembre'], '0', ',', '.')."</th>
            <th>$ ".number_format( $diciembre    = $value['Diciembre']-$row['Diciembre'], '0', ',', '.')."</th>";
} 
$saldoanio  =   ( $enero + $febrero + $marzo + $abril + $mayo + $junio + $julio + $agosto + $septiembre + $octubre + $noviembre + $diciembre );?>
          </tr>
        </tbody>
      </table><h4>Saldo <?php echo $i ?>: $ <?php echo number_format( $saldoanio, '0', ',', '.' ) ?> </h4>
      <br><br>
    </div>
  </div>
</div>
<h2></h2>
<?php
$diferencia   =   $diferencia + $saldoanio;
}
echo '<h2> Diferencia: $'.number_format($diferencia,'0',',','.').'</h2>';
require_once '../../layouts/blade/body_down.php';
require_once '../../layouts/blade/footer.php';
require_once '../../layouts/blade/jquery.php';
require_once '../../layouts/blade/fin.php';
?>