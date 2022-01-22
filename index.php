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
    if(($_SESSION['perfil']==1) || ($_SESSION['perfil']==2) || ($_SESSION['perfil']==6))
    {

    require_once '../../layouts/blade/head.php';
    require_once '../../layouts/blade/header.php'; 
    require_once '../../layouts/blade/aside.php';
    require_once '../../layouts/blade/body_up.php';
    
    $BuscarGastosUsuario    =   $_POST['usuarios']; 
    $mes                    =   ( isset( $_POST['mes'] ) ) ? $_POST['mes'] : date( 'm' );
    $anio                   =   ( isset( $_POST['anio'] ) ) ? $_POST['anio'] : date( 'Y' );
    
    require_once 'gastos.class.php'; 
    $gastos 		=	new gastos;

    require_once '../../admin/depositos/depositos.class.php';
    $deposito   = new depositos;
    
    if(isset( $BuscarGastosUsuario ))
        {
            $mostrar     =  $gastos->ListarGastosUsuario( $BuscarGastosUsuario, $mes, $anio );
        }
        else
        {
            $mostrar 	=	$gastos->ListarGastosUsuario( $BuscarGastosUsuario, date('m'), date('Y') );
        }
  ?>  
    
<div class="row">
  <div class="col-lg-8">

<?php 
if( $_SESSION['perfil']!=1 )
{
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
}

$usuario    =   $core->SelectByKey( 'usuarios','estado', '"ACTIVO"', '' );

    echo '
    <form action="" method="post">
    <div class="col-md-4">
        <select name="usuarios" class="form-control" required>
            <option value="">Seleccione un Jefe de Terreno</option>
    ';
    foreach( $usuario as $listado )
    {
        $value  = ($listado['id']==$BuscarGastosUsuario)?"selected":"";
    echo '
            <option value="'.$listado['id'].'" '.$value.'>'.$listado['nombre'].'</option>
    ';
    }
    echo '
            </select>
    </div>
    <div class="col-md-4">
        <select name="mes" class="form-control">
            <option value="">Seleccione Mes</option>';
$meses  =   $core->ShowAll('meses');
foreach($meses as $row)
{
    $selected   =   ( $row['id'] == $mes ) ?   'selected' : '';
    echo '
            <option value="'.$row['id'].'" '.$selected.'>'.$row['nombre'].'</option>';
}
    echo '
        </select>
    </div>
        <div class="col-md-4 input-group">
        <select name="anio" class="form-control">
            <option value="">Seleccione a&ntilde;o</option>';
for ($i=date('Y'); $i >= 2018 ; $i--)
    { 
        $selected   =   ( $i == $anio) ? 'selected' : '';
            echo'
            <option value="'.$i.'" '.$selected.'>'.$i.'</option>
            ';
    }
echo '  </select>
        <span class="input-group-btn">
            <button class="btn btn-warning" type="submit">Buscar</button>
        </span>
    </div>
      </form>'; ?>
      
       <h3>Listado de Gastos <a href="create.php" ><button class="btn btn-success">Nuevo</button></a></h3>
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
            <th>Fecha</th>
            <th>Responsable</th>
            <?php //echo $encabezado; ?>
            <th>Fecha del Documento</th>
            <th>Numero Factura</th>
            <th>Detalle</th>
            <th>Total</th>
            <th>Opciones</th>
          </tr>
        </thead>
        <tbody>

<?php 


foreach ( $mostrar as $row )
	{ 
	    
	        $datos =   "<td>".$row['usuario']."</td>";
        ?>

          <tr>
            <td><?php echo $row['id'] ?></td>
            <td><?php echo $row['fecha'] ?></td>
            <?php echo $datos; ?>
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
	} 
	echo '
        </tbody>
      </table>
    </div><!-- /.table-responsive -->
  </div><!-- /.col -->
</div><!-- /.row -->
';
    
    
    require_once'../../layouts/blade/body_down.php';
    require_once'../../layouts/blade/footer.php';
    require_once'../../layouts/blade/jquery.php';  
    require_once '../../layouts/blade/fin.php';
    }
    else
    {
        header('Location:index_usuario.php');
    }
}
else
{
    header('Location:../../');
}
?>