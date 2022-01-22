<?php 
$id   =   $_REQUEST['id'];

require_once '../../layouts/blade/head.php';
require_once '../../layouts/blade/header.php';
require_once '../../layouts/blade/aside.php';
require_once '../../layouts/blade/body_up.php';

require_once '../../config/core.class.php';
$core       =   new core;
$usuarios   =   $core->ShowById( 'usuarios', $id );
foreach ( $usuarios as $row )
{
  $nombre       =   $row['nombre'];
  $rut          =   $row['rut'];
  $email        =   $row['email'];
  $banco        =   $row['banco'];
  $tipo_cuenta  =   $row['tipo_cuenta'];
  $num_cuenta   =   $row['num_cuenta'];
  $perfil       =   $row['perfil'];
  $localidad    =   $row['localidad'];
  $estado       =   $row['estado'];
}
?>


<!--Contenido-->
<div class="row">
  <div class="col-md-6">
    <h3>Nuevo Usuario</h3>
    <br>
  </div>
</div>

<form action="usuarios.php" method="post" accept-charset="utf-8" autocomplete="none">
  <div class="row">
    <div class="col-md-4">
      <div class="form-group">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre" class="form-control"  value="<?php echo $nombre ?>">
      </div>
    </div>


    <div class="col-md-4">
      <div class="form-group"> 
      <label for="rut">Rut</label>
      <input type="text" name="rut" id="rut" class="form-control"  value="<?php echo $rut ?>">           
      </div>
    </div>

    <div class="col-md-4">
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email"  class="form-control" value="<?php echo $email ?>">
      </div>
    </div>
  </div>

  <div class="row">  
    <div class="col-md-4">
      <div class="form-group">
        <label for="banco">Banco</label>
        <select name="banco" id="banco" class="form-control" >
          <option>Seleccione un Banco</option>
<?php 
$bancos = $core->ShowAll( 'bancos' );
foreach ($bancos as $row)
{
  $selected   = ( $banco == $row['id'] ) ? 'selected':'';
  echo '<option value="'.$row['id'].'" '.$selected.'>'.$row['nombre'].'</option>
  option';
}
?>
        </select>
      </div>
    </div>
                          
      <div class="col-md-4">
        <div class="form-group">
        <label for="tipo_cuenta">Tipo de Cuenta</label>
        <input type="text" name="tipo_cuenta"  class="form-control" value="<?php echo $tipo_cuenta ?>">
        </div>
      </div>
                          
      <div class="col-md-4">
        <div class="form-group">
        <label for="num_cuenta">Numero de Cuenta</label>
        <input type="number" name="num_cuenta"  class="form-control" value="<?php echo $num_cuenta ?>">
        <input type="hidden" name="id" value="<?php echo $id ?>">
        </div>
      </div>
    </div>
                          
    <div class="row">
      <div class="col-md-4">
        <div class="form-group">
        <label for="perfil">Perfil</label>
        <select name="perfil" class="form-control" >
          <option>Seleccione Perfil</option>
<?php 
$perfiles = $core->ShowAll( 'perfiles' );
foreach ($perfiles as $row)
{
  $selected   = ( $perfil == $row['id'] ) ? 'selected':'';
  echo '<option value="'.$row['id'].'" '.$selected.'>'.$row['nombre'].'</option>
  option';
}
?>
        </select>
        </div>
      </div>
  


  
    <div class="col-md-4">
      <div class="form-group">
        <label for="localidad">Localidad</label>
        <select name="localidad" class="form-control" >
          <option>Seleccione Localidad</option>
<?php 
$localidades = $core->ShowAll( 'localidades' );
foreach ($localidades as $row)
{
  $selected   = ( $localidad == $row['id'] ) ? 'selected':'';

  echo '<option value="'.$row['id'].'" '.$selected.'>'.$row['nombre'].'</option>
  option';
}
?>
        </select>
      </div>
    </div>

    <div class="col-md-4 form-group">
      <label for="estado">Estado</label>
      <select name="estado" class="form-control" >
        <option value="ACTIVO">ACTIVO</option>
        <option value="INACTIVO">INACTIVO</option>
      </select>
    </div>
  </div>


  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <button type="submit" class="btn btn-primary" name="p" value="actualizar">Guardar</button>
        <button type="reset" class="btn btn-danger">Cancelar</button>
      </div>
    </div>
  </div>
  
</form>
<!--Fin Contenido-->  
<?php 
require_once '../../layouts/blade/body_down.php'; 
require_once '../../layouts/blade/footer.php';
require_once '../../layouts/blade/jquery.php';
require_once '../../layouts/blade/fin.php';
?>