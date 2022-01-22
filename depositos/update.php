<?php 
$id   =   $_REQUEST['id']; 

require_once '../../config/core.class.php'; 

$core = new core; 
$deposito  =   $core->ShowById( 'depositos', $id );
foreach ($deposito as $row)
{
  $usuario  =   $row['usuario'];
  $monto    =   $row['monto'];
  $detalle  =   $row['detalle'];
}

require_once'../../layouts/blade/head.php'; 
require_once'../../layouts/blade/header.php';
require_once'../../layouts/blade/aside.php'; 
require_once '../../layouts/blade/body_up.php';
?>


<!--Contenido-->
                      <div class="row">
                        <div class="col-md-6">
                          <h3>Nuevo Dep&oacute;sito</h3>
                        </div>
                      </div>

                      <form action="create.class.php" method="post" accept-charset="utf-8">
                      
                        <div class="row">
                          <div class="col-md-4">
                            <div class="form-group">
                            <input type="hidden" name="id" value="">
                              <label for="usuario">Nombre</label>
                              <select name="usuario" id="usuario"  class="form-control selectpicker" required  data-show-subtext="true" data-live-search="true">
                                <option value="">Seleccione Usuario</option>
                                <?php 
                                  $usuarios   =   $core->ShowAll( 'usuarios' );
                                  foreach ( $usuarios as $row )
                                  {
                                    $selected   =   ( $usuario == $row['id'] )?'selected':'';
                                    echo '<option value="'.$row['id'].'" '.$selected.'>'.$row['nombre'].'</option>';
                                  }
                                ?>
                              </select>
                            </div>
                          </div>

                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="monto">Monto</label>
                              <input type="number" name="monto" placeholder="monto..." class="form-control" value="<?php echo $monto ?>">
                            </div>
                          </div>

                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="detalle">Detalle</label>
                              <input type="text" name="detalle" placeholder="detalle..." class="form-control" value="<?php echo $detalle ?>">
                              <input type="hidden" name="id" value="<?php echo $id; ?>">
                            </div>
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

                    
<?php 
require_once'../../layouts/blade/body_down.php';
require_once'../../layouts/blade/footer.php'; 
require_once'../../layouts/blade/jquery.php';
require_once'../../layouts/blade/fin.php';  
?>
