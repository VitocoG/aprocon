<?php 
require_once '../../config/core.class.php';
$core   =   new core;
session_start();
$usuarios  = $core->Permisos( 'trabajadores', 'permisos', $_SESSION['id'] );
foreach($usuarios as $row)
{
    $dep = $row['trabajadores'];
}

if( $dep == 1 )
{
    require_once '../../layouts/blade/head.php';
    require_once '../../layouts/blade/header.php';
    require_once '../../layouts/blade/aside.php';
    require_once '../../layouts/blade/body_up.php';
    
    require_once 'trabajadores.class.php';
    $trabajadores   =   new trabajadores;
    
    $localidades  =   $_REQUEST['localidad'];
?>



<!--Contenido-->  
<div class="row">
  <div class="col-lg-8">
    <h3>Listado de Trabajadores <a href="create.php" ><button class="btn btn-success">Nuevo</button></a></h3>
  </div>
</div>



<?php
if ($_SESSION['perfil']==1)
{ ?>
<div class="row">
    <div class="col-md-6">
        <form method="post" action="">
        <div class="input-group">
            <select name="localidad" class="form-control">
                <option value="0">Seleccione Localidad</option>

                 
<?php
  $localidad   =   $core->ShowAll( 'localidades' );
  foreach ( $localidad as $row )
  { ?>
                <option value="<?php echo $row['id'] ?>"><?php echo $row['nombre'] ?></option>
<?php 
  }?>
            </select>
            <span class="input-group-btn">
                <button class="btn btn-warning" type="submit">Buscar</button>
            </span>
        </div>
        </form>
    </div>
</div><br>
<?php 
}
else
{
  $localidades  =   $_SESSION['localidad'];
}  ?>

<div class="row">
  <div class="col-xs-12">
    <div class="table-responsive">
      <table class="table table-striped table-bordered table-condensed table-hover">
        <thead>
          <tr>
            <th>Localidad</th>
            <th>Nombre</th>
            <th>Estado</th>
            <th>Opciones</th>
          </tr>
        </thead>
        <tbody>
    <?php
    $trabajador =   $trabajadores->ListarIndex( $localidades );
    
    
    foreach( $trabajador as $row )
    { 
        $opciones   = ( $row['activo']=='0' ) ? "ACTIVO" : "INACTIVO"; 
        $estado     = ( $row['activo']=='0' ) ? " " : "class='bg-danger'"; ?>
        
        <tr>
            <td <?php echo $estado ?>><?php echo $row['localidad'] ?></td>
            <td <?php echo $estado ?>><?php echo $row['apellido'].' '.$row['nombre'] ?></td>
            <td <?php echo $estado ?>><?php echo $opciones ?></td>
            <td <?php echo $estado ?>>
                <a href="update.php?id=<?php echo $row['id'] ?>"><button class="btn btn-info">Editar</button></a>
                <?php $domicilio = (empty($row['domicilio'])) ? '' : '<a href="pdf.php?id='.$row['id'].'"><button class="btn btn-danger">FICHA</button></a>'; 
		echo $domicilio;
?>
            </td>
        </tr>
    <?php
    }  ?>      
 
 
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