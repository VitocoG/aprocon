<?php
require_once '../../layouts/templateUp.php';
?>

<div class="row">
    <div class="col-md-6">
        <h3>Nueva Entrega</h3>
    </div>
    <div class="col-md-6"></div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-warning">
            <div class="panel-heading"><h4>Datos de la Entrega</h4>
            
            </div>
            <div class="panel-body">
            <form action="" method="post">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="datetime-local" class="form-control" name="fecha" id="fecha" value="<?php echo date('Y-m-d').'T'.date('H:i') ?>" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                           <select name="localidad" id="localidad" class="form-control" required>
                               <option value="">Localidad</option>
<?php
$ListaLocalidades    =   $model->ShowAll('localidades', ' ORDER BY nombre');
foreach( $ListaLocalidades as $row ):
    echo '                      <option value="'.$row['id'].'">'.$row['nombre'].'</option>';
endforeach;
?>        
                           </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" name="concepto" placeholder="concepto general"class="form-control" >
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <input type="radio" name="tipo" checked value="t" onclick="Trabajador()">
                            </span>
                            <select name="recibe" id="trabajador" class="form-control " data-show-subtext="true" data-live-search="true" required>
                                <option value="">Seleccione Trabajador</option>
<?php
$ListaTrabajadores  =   $model->ShowAll('trabajadores', ' WHERE activo = 0 ORDER BY apellido, nombre');
foreach( $ListaTrabajadores as $row ):
    echo '                      <option value="'.$row['id'].'">'.$row['apellido'].' '.$row['nombre'].'</option>';
endforeach;   
?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <input type="radio" name="tipo"  value="u" onclick="Usuario()">
                            </span>
                            <select name="recibe" id="usuario" class="form-control " disabled data-show-subtext="true" data-live-search="true" required>
                                <option value="">Seleccione Jefatura</option>
<?php
$listaJefaturas     =   $model->ShowAll('usuarios', ' WHERE estado = "ACTIVO" ORDER BY nombre');
foreach($listaJefaturas as $row):
    echo '                      <option value="'.$row['id'].'">'.$row['nombre'].'</option>';
endforeach;
?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <button type="submit" name="p" value="encabezado" class="btn btn-twitter">Guardar</button>
                        </div>
                    </div>
                </div>
                </form>
                
            </div>
        </div>
    </div>
</div>
<script>

function Usuario()
{
    $("#trabajador").prop("disabled", true);
    $("#usuario").prop("disabled", false);
}

function Trabajador()
{
    $("#usuario").prop("disabled", true);
    $("#trabajador").prop("disabled", false);
}


</script>

<?php
require_once '../../layouts/templateDown.php';
?>