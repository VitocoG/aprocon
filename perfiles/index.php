<?php 
require_once '../../config/core.class.php';
$core   =   new core;
session_start();
$usuarios  = $core->Permisos( 'perfiles', 'permisos', $_SESSION['id'] );
foreach($usuarios as $row)
{
    $dep = $row['perfiles'];
}

if( $dep == 1 )
{   require_once '../../layouts/blade/head.php';
    require_once '../../layouts/blade/header.php';
    require_once '../../layouts/blade/aside.php';
    require_once '../../layouts/blade/body_up.php';
?>

<!--Contenido-->  
<div class="row">
  <div class="col-lg-8">
    <h3>Listado de Perfiles <a href="create.php" ><button class="btn btn-success">Nuevo</button></a></h3>
  </div>
</div>

<div class="row">
  <div class="col-xs-12">
    <div class="table-responsive">
      <table class="table table-striped table-bordered table-condensed table-hover">
        <thead>
          <tr>
            <th>#</th>
            <th>Nombre</th>
            <th>Opciones</th>
          </tr>
        </thead>
        <tbody>

 <?php require_once( '../../config/core.class.php' );
$core = new core;
$query=$core->ShowAll( 'perfiles' );
                                        
while($fila=$query->fetch_assoc()) { ?>
          <tr>
            <td><?php echo $fila['id'] ?> </td>
            <td><?php echo $fila['nombre'] ?> </td>
            <td>
              <a href="update.php?id=<?php echo $fila['id'] ?>"><button class="btn btn-info">Editar</button></a>
              <a href="perfiles.php?p=eliminar&id=<?php echo $fila['id'] ?>"><button class="btn btn-danger">Eliminar</button></a>
            </td> 
          </tr>
<?php } ?>
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
}
else
{
    header( 'Location:../../' );
}
?>