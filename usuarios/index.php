<?php 
require_once '../../config/core.class.php';
$core   =   new core;
session_start();
$usuarios  = $core->Permisos( 'usuarios', 'permisos', $_SESSION['id'] );
foreach($usuarios as $row)
{
    $dep = $row['usuarios'];
}

if( $dep == 1 )
{
    require_once '../../layouts/blade/head.php';
    require_once '../../layouts/blade/header.php'; 
    require_once '../../layouts/blade/aside.php';
    require_once '../../layouts/blade/body_up.php';
?>

<div class="row">
  <div class="col-lg-8">
    <h3>Listado de Usuarios <a href="create.php" ><button class="btn btn-success">Nuevo</button></a></h3>
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
            <th>Nombre</th>
            <th>Banco</th>
            <th>Tipo de Cuenta</th>
            <th>Num. Cuenta</th>
            <th>Email</th>
            <th>Localidad</th>
            <th>Estado</th>
            <th>Opciones</th>
          </tr>
        </thead>
        <tbody>

<?php 
require_once 'usuarios.class.php'; 
$usuarios 		=	new usuarios;
$mostrar 	=	$usuarios->ListarTodosLosUsuarios();
foreach ( $mostrar as $row )
	{ 
	
	$class = ( $row['estado'] == 'INACTIVO' ) ? 'class="bg-danger"' : ''; ?>

          <tr>
            <td <?php echo ' '.$class ?>><?php echo $row['id'] ?></td>
            <td <?php echo ' '.$class ?>><?php echo $row['nombre'] ?></td>
            <td <?php echo ' '.$class ?>><?php echo $row['banco'] ?></td>
            <td <?php echo ' '.$class ?>><?php echo $row['tipo_cuenta'] ?></td>
            <td <?php echo ' '.$class ?>><?php echo $row['num_cuenta'] ?></td>
            <td <?php echo ' '.$class ?>><?php echo $row['email'] ?></td>
            <td <?php echo ' '.$class ?>><?php echo $row['localidad'] ?></td>
            <td <?php echo ' '.$class ?>><?php echo $row['estado'] ?></td>
            <td>
              <a href="update.php?id=<?php echo $row['id'] ?>"><button class="btn btn-info">Editar</button></a>
              <a href="permisos.php?id=<?php echo $row['id'] ?>"><button type="submit" class="btn btn-danger">Permisos</button></a>
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
    header( 'Location:../../' );
}
?>