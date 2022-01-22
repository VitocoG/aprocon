<?php 
require_once '../../config/core.class.php';
require_once'ods.class.php';
$core   =   new core;
$ods    =   new ods;


//  #####   VERIFICAR SI USUARIO TIENE PERMISO PARA INGRESAR A ESTA PAGINA  //
$usuarios  = $core->Permisos( 'saldos', 'permisos', $_SESSION['id'] );
foreach($usuarios as $row)
{
    $permiso = $row['saldos'];
}

if( $permiso == 1 )
{
    require_once '../../layouts/blade/head.php';
    require_once '../../layouts/blade/header.php';
    require_once '../../layouts/blade/aside.php';
    require_once '../../layouts/blade/body_up.php'; 
  ?>  


<!--    ########################################    CONTENIDO PRINCIPAL #############################   -->
<!-- Content Header (Page header) -->
  <div class="row ">
<?php require_once 'graficoOds.php' ?>
  </div><br><br>


    <section class="content-header">
      <h1>INS Aprocon</h1>
    </section><br>

      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><?php echo $totalCumplen ?></span>

            <div class="info-box-content">
              <span class="info-box-text">San Fernando</span>
                <span class="info-box-text"><br></span>
                <span class="info-box-text"><br></span>
                <span class="info-box-text"><?php echo $totalOrdenes ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->


        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
          <a href="redes.php?inicio=<?php echo $fecha1 ?>&termino=<?php echo $fecha2 ?>" >
            <span class="info-box-icon bg-red"><?php echo $hidraulicas_cumplen ?></span>
          </a>
            <div class="info-box-content">
              <span class="info-box-text">Mantenimiento</span>
              <span class="info-box-text">de Redes</span>
                <span class="info-box-text"><br></span>
                <span class="info-box-text"><?php echo $hidraulicas ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>


        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
              <a href="complementarias.php?inicio=<?php echo $fecha1 ?>&termino=<?php echo $fecha2 ?>" >
            <span class="info-box-icon bg-green"><?php echo $civiles_cumplen ?></span>
            </a>
            <div class="info-box-content">
              <span class="info-box-text">Obras</span>
              <span class="info-box-text">Complementarias</span>
                <span class="info-box-text"><br></span>
                <span class="info-box-text"><?php echo $civiles  ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div><br> 
      <!-- /.row -->





    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>INS Essbio</h1>
    </section><br> 

<!-- Info boxes -->
<div class="row">
  <div class="col-md-4 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-aqua"><?php echo $totalCumplenIto ?></span>

      <div class="info-box-content">
        <span class="info-box-text">San Fernando</span>
          <span class="info-box-text"><br></span>
          <span class="info-box-text"><br></span>
          <span class="info-box-text"><?php echo $totalOrdenes ?></span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->


  <div class="col-md-4 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-red"><?php echo $hidraulicas_cumplen_ito ?></span>

      <div class="info-box-content">
        <span class="info-box-text">Mantenimiento</span>
        <span class="info-box-text">de Redes</span>
          <span class="info-box-text"><br></span>
          <span class="info-box-text"><?php echo $hidraulicas  ?></span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->

  <!-- fix for small devices only -->
  <div class="clearfix visible-sm-block"></div>


  <div class="col-md-4 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-green"><?php echo $civiles_cumplen_ito  ?></span>
      <div class="info-box-content">
        <span class="info-box-text">Obras</span>
        <span class="info-box-text">Complementarias</span>
          <span class="info-box-text"><br></span>
          <span class="info-box-text"><?php echo $civiles ?></span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
</div>
<!-- /.row -->






<?php
    require_once '../../layouts/blade/body_down.php';
    require_once '../../layouts/blade/footer.php';
    require_once '../../layouts/blade/jquery.php';
    require_once '../../layouts/blade/fin.php';
}
else
{
    header( 'Location:../../' );
}
?>