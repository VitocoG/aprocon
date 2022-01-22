<?php 

require_once '../../config/core.class.php';
$core   =   new core;
session_start();
$usuarios  = $core->Permisos( 'gastos', 'permisos', $_SESSION['id'] );
foreach( $usuarios as $row )
{
    $dep = $row['gastos'];
}

if( $dep == 1 )
{
    require_once '../../layouts/blade/head.php';
    require_once '../../layouts/blade/header.php'; 
    require_once '../../layouts/blade/aside.php';
    require_once '../../layouts/blade/body_up.php'; 
    $mes                    =   $_POST['mes'];
    $anio                   =   $_POST['anio'];
    
    require_once 'gastos.class.php'; 
    $gastos 		=	new gastos;

    require_once '../../admin/depositos/depositos.class.php';
    $deposito   = new depositos; 
    
    $mostrar 	=	$gastos->ListarGastosUsuario( $_SESSION['id'], $mes, $anio );
?>

<div class="row">
    <div class="col-lg-8">
<?php
$ListarDepositosFecha = $deposito->ListarDepositosFecha();
foreach( $ListarDepositosFecha as $row )
{
    echo "<h4>&Uacute;ltimo Dep&oacute;sito: ".$row['fechas']." por $ ".number_format( $row['monto'], '0', ',', '.' )."</h4>";
}

$ListarDepositoTotal = $deposito->ListarDepositoTotal();
foreach( $ListarDepositoTotal as $row )
{
    $dep = $row['monto'];
}

$ListarGastoTotal = $gastos->ListarGastoTotal();
foreach( $ListarGastoTotal as $row )
{
    $gas = $row['gasto'];
}
    
echo '
<table class="table table-condensed">
    <tr>
        <th>TOTAL DEP&Oacute;SITOS</th>
        <th>TOTAL GASTOS</th>
        <th>SALDO</th>
    </tr>
    <tr>
        <td>$ '.number_format( $dep, '0', ',', '.' ).'</td>
        <td>$ '.number_format( $gas, '0', ',', '.' ).'</td>
        <td>$ '.number_format( ( $dep - $gas ), '0', ',', '.' ).'</td>
    </tr>
</table>
';
?>
    </div>
</div>
<h3>Listado de Gastos <a href="create.php" ><button class="btn btn-success">Nuevo</button></a></h3>
<div class="row">
    <form method="post" action="">
        <div class="col-md-6 form-group">
            <select name="mes" class="form-control" required>
                <option value="">Seleccione Mes</option>
<?php
$meses  =   $core->ShowAll('meses');
foreach( $meses as $row )
{
    $selected = ($mes==$row['id']) ? 'selected' : '';
    echo'       <option value="'.$row['id'].'" '.$selected.'>'.$row['nombre'].'</option>';
}
?>
            </select>
        </div>
        <div class="col-md-5">
            <div class="input-group">
                <select name="anio" class="form-control" required>
                    <option value="">Selecciones A&ntilde;o</option>
<?php
for($i=date('Y'); $i>=2018;$i--)
{
     $selected = ($anio==$i) ? 'selected' : '';
    echo'           <option value="'.$i.'" '.$selected.'>'.$i.'</option>';
}
?>
                </select>
                <span class="input-group-btn">
                    <button class=" btn btn-warning" type="submit">Buscar</button>
                </span>
            </div>
        </div>
    </form>
</div>

<div class="row">
  <div class="col-xs-12">
    <div class="table-responsive">
      <table class="table table-striped table-bordered table-condensed table-hover">
        <thead>
          <tr>
            <th>#</th>
            <th>Fecha</th>
            <th>Fecha del Documento</th>
            <th>Numero Factura</th>
            <th>Detalle</th>
            <th>Total</th>
            <th>Opciones</th>
          </tr>
        </thead><tbody>

<?php 


foreach ( $mostrar as $row )
	{ ?>

          <tr>
            <td><?php echo $row['id'] ?></td>
            <td><?php echo $row['fecha'] ?></td>
            <td><?php echo $row['fecha_documento'] ?></td>
            <td><?php echo $row['documento'] ?></td>
            <td><?php echo $row['detalle'] ?></td>
            <td><?php echo '$ '.number_format($row['total'], '0',',','.') ?></td>
            <td><?php if($_SESSION['perfil']==1) { ?>
              <a href="update.php?id=<?php echo $row['id'] ?>"><button class="btn btn-info">Editar</button></a> <?php } ?>
              <?php echo ' 
              <a href="'.$row['archivo'].'" target="_blank"><button class="btn btn-danger">PDF</button></a>';?>
            </td> 
          </tr>

<?php 
	} ?>
        </tbody>
      </table>
    </div><!-- /.table-responsive -->
  </div><!-- /.col -->
</div><!-- /.row -->


    
    
<?php  
require_once'../../layouts/blade/body_down.php';
require_once'../../layouts/blade/footer.php';
require_once'../../layouts/blade/jquery.php';  
require_once '../../layouts/blade/fin.php';
}
else
{
    header('Location:../../');
}

?>