<?php 
require_once '../../config/core.class.php';
$core   =   new core;
session_start();
$usuarios  = $core->Permisos( 'saldos', 'permisos', $_SESSION['id'] );
foreach($usuarios as $row)
{
    $dep = $row['saldos'];
}

if( $dep == 1 )
{

    require_once '../../layouts/blade/head.php';
    require_once '../../layouts/blade/header.php';
    require_once '../../layouts/blade/aside.php';
    require_once '../../layouts/blade/body_up.php';

    require_once'saldos.class.php';
    $saldos 		= 	new saldos;
    
    $GastoDia	= $saldos->GastoDia();
    
    foreach ($GastoDia as $total)
    {
    	$totalDia = $total['total'];
    }
?>

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Gastos
        <small>Aprocon</small>
      </h1>
    </section><br>

      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua">1 <small>día</small></span>

            <div class="info-box-content">
              <span class="info-box-text">Último día</span>
              <span class="info-box-number"><?php echo '$ '.number_format($totalDia, '0',',','.') ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

<?php
$GastoSemana 		= $saldos->GastoSemana(  );
foreach ($GastoSemana as $total)
{
	$total7Dias = $total['total'];
}
?>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red">7 <small>días</small></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Última Semana</span>
              <span class="info-box-number"><?php echo '$ '.number_format($total7Dias, '0',',','.') ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

<?php
$GastoMes 		= $saldos->GastoMes(  );
foreach ($GastoMes as $total)
{
	$total30Dias = $total['total'];
}
?>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green">30 <small>días</small></span>

            <div class="info-box-content">
              <span class="info-box-text">Último Mes</span>
              <span class="info-box-number"><?php echo '$ '.number_format($total30Dias, '0',',','.') ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow">1 <small>año</small></i></span>


<?php
$GastoAnio 		= $saldos->GastoAnio(  );
foreach ($GastoAnio as $total)
{
	$total365Dias = $total['total'];
}
?>
            <div class="info-box-content">
              <span class="info-box-text">Último Año</span>
              <span class="info-box-number"><?php echo '$ '.number_format($total365Dias, '0',',','.') ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->



<?php
$DepositoDia 		= $saldos->DepositoDia(  );
foreach ($DepositoDia as $total)
{
	$total1Dia = $total['total'];
}
?>

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Depósitos
        <small>Aprocon</small>
      </h1>
    </section><br>

      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua">1 <small>día</small></span>

            <div class="info-box-content">
              <span class="info-box-text">Último día</span>
              <span class="info-box-number"><?php echo '$ '.number_format($total1Dia, '0',',','.') ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

<?php
$fecha7 		= 	$saldos->Dia(7);
foreach ($fecha7 as $row)
{
	$date 	= 	"'".$row['fecha']."'";
}
$DepositoSemana		= $saldos->DepositoSemana(  );
foreach ($DepositoSemana as $total)
{
	$total7Dias = $total['total'];
}
?>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red">7 <small>días</small></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Última Semana</span>
              <span class="info-box-number"><?php echo '$ '.number_format($total7Dias, '0',',','.') ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

<?php
$DepositoMes		= $saldos->DepositoMes(  );
foreach ($DepositoMes as $total)
{
	$total30Dias = $total['total'];
}
?>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green">30 <small>días</small></span>

            <div class="info-box-content">
              <span class="info-box-text">Último Mes</span>
              <span class="info-box-number"><?php echo '$ '.number_format($total30Dias, '0',',','.') ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow">1 <small>año</small></i></span>


<?php
$DepositoAnio 		= $saldos->DepositoAnio(  );
foreach ($DepositoAnio as $total)
{
	$total365Dias = $total['total'];
}
?>
            <div class="info-box-content">
              <span class="info-box-text">Último Año</span>
              <span class="info-box-number"><?php echo '$ '.number_format($total365Dias, '0',',','.') ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

<div class="row">
  <div class="col-xs-6 col-md-4">
    <a class="btn btn-warning btn-lg" href="localidades.php"><strong>Localidades</strong></a>
  </div>

  <div class="col-xs-6 col-md-4">
    <a href="personas.php" class="btn btn-warning btn-lg"><strong>Personas</strong></a>
  </div>
</div>


<?php
    require_once '../../layouts/blade/body_down.php';
    require_once '../../layouts/blade/footer.php';
    require_once '../../layouts/blade/jquery.php';
    require_once '../../layouts/blade/fin.php';
}
else
{
    header('Location:../../');
}
?>
?>