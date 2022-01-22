<?php 
require_once '../../layouts/blade/head.php';
require_once '../../layouts/blade/header.php';
require_once '../../layouts/blade/aside.php';
require_once '../../layouts/blade/body_up.php';

require_once '../../config/core.class.php';
$core = new core;
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
        <input type="text" name="nombre" class="form-control" autofocus  placeholder="Nombre">
      </div>
    </div>


    <div class="col-md-4">
      <div class="form-group"> 
      <label for="rut">Rut</label>
      <input type="text" name="rut" placeholder="12345678-9" class="form-control" >           
      </div>
    </div>

    <div class="col-md-4">
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email"  placeholder="algo@algo.cl"  class="form-control">
      </div>
    </div>
  </div>

  <div class="row">  
    <div class="col-md-4">
      <div class="form-group">
        <label for="banco">Banco</label>
        <select name="banco" class="form-control" >
          <option>Seleccione un Banco</option>

<?php 
$banco  =   $core->ShowAll( 'bancos' );
foreach ($banco as $ListaBancos)
  { ?>
          <option value="<?php echo $ListaBancos['id'] ?>"><?php echo $ListaBancos['nombre'] ?></option>
  <?php } ?>

        </select>
      </div>
    </div>
                          
      <div class="col-md-4">
        <div class="form-group">
        <label for="tipo_cuenta">Tipo de Cuenta</label>
        <input type="text" name="tipo_cuenta"  class="form-control">
        </div>
      </div>
                          
      <div class="col-md-4">
        <div class="form-group">
        <label for="num_cuenta">Numero de Cuenta</label>
        <input type="number" name="num_cuenta"  class="form-control">
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
$perfil  =   $core->ShowAll( 'perfiles' );
foreach ($perfil as $ListaPerfiles)
  { ?>
          <option value="<?php echo $ListaPerfiles['id'] ?>"><?php echo $ListaPerfiles['nombre'] ?></option>
  <?php } ?>

        </select>
        </div>
      </div>
  


  
    <div class="col-md-4">
      <div class="form-group">
        <label for="localidad">Localidad</label>
        <select name="localidad" class="form-control" >
          <option>Seleccione Localidad</option>

<?php 
$localidad  =   $core->ShowAll( 'localidades' );
foreach ($localidad as $ListaLocalidades)
  { ?>
          <option value="<?php echo $ListaLocalidades['id'] ?>"><?php echo $ListaLocalidades['nombre'] ?></option>
  <?php } ?>
  
        
        </select>
      </div>
    </div>
  </div>


  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <button type="submit" class="btn btn-primary" name="p" value="nuevo">Guardar</button>
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