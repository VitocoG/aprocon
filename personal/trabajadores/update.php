<?php 
session_start();

require_once '../../layouts/blade/head.php';
require_once '../../layouts/blade/header.php';
require_once '../../layouts/blade/aside.php';
require_once '../../layouts/blade/body_up.php';
        
        require_once '../../config/core.class.php';
        $core   =   new core;

$id     =   $_REQUEST['id'];

$trabajador =   $core->ShowById( 'trabajadores', $id );
foreach( $trabajador as $row )
{
    $nombre             =   $row['nombre'];
	$apellido           =   $row['apellido'];
	$rut                =   $row['rut'];
	$fecha              =   $row['fecha'];
	$domicilio          =   $row['domicilio'];
	$localidades        =   $row['localidad'];
	$ecivil             =   $row['ecivil'];
	$telefono           =   $row['telefono'];
	$estudios           =   $row['estudios'];
	$licencia           =   $row['licencia'];
	$talla              =   $row['talla'];
	$calzado            =   $row['calzado'];
	$alergia            =   $row['alergia'];
	$observaciones      =   $row['observaciones'];
	$cargo              =   $row['cargo'];
	$ingreso            =   $row['ingreso'];
	$retiro             =   $row['retiro'];
	$supervisor         =   $row['supervisor'];
	$brigada            =   $row['brigada'];
	$afp                =   $row['afp'];
	$salud              =   $row['salud'];
	$cargas             =   $row['cargas'];
	$accidenteNombre    =   $row['accidenteNombre'];
	$accidenteNumero    =   $row['accidenteNumero'];
	$estado             =   $row['activo'];
}
?>


<!--Contenido-->
<form action="trabajadores.php" method="post">
<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">DATOS PERSONALES</h3>
  </div>
  <div class="panel-body">
    <div class="row">
        <div class="col-md-4 form-group">
            <label for="nombre">Nombres</label>
            <input type="text" name="nombre" class="form-control"  value="<?php echo $nombre ?>">
            <input type="hidden" name="id" value="<?php echo $id ?>">
        </div>
        <div class="col-md-4 form-group">
            <label for="apellido">Apellidos</label>
            <input type="text" name="apellido" class="form-control"  value="<?php echo $apellido ?>">
        </div>
        <div class="col-md-2 form-group">
            <label for="rut">Rut</label>
            <input type="text" name="rut" id="rut" class="form-control"  value="<?php echo $rut ?>">
        </div>
        <div class="col-md-2 form-group">
            <label for="fecha">F. Nacimiento</label>
            <input type="date" name="fecha" class="form-control"  value="<?php echo $fecha ?>">
        </div>
    </div>
    
    
    <div class="row">
        <div class="col-md-4 form-group">
            <label for="domicilio">Domicilio</label>
            <input type="text" name="domicilio" class="form-control"  value="<?php echo $domicilio ?>">
        </div>
        <div class="col-md-2 form-group">
            <label for="localidad">Localidad</label>
            <select name="localidad" class="form-control" >
                <option value="">Seleccione Localidad</option>
<?php
$localidad  =   $core->ShowAll( 'localidades' );
foreach( $localidad as $row )
{
    $selected   = ( $localidades == $row['id'] ) ? 'selected':'';
    echo '
                <option value="'.$row['id'].'" '.$selected.'>'.$row['nombre'].'</option>
    ';
}
?>
            </select>
        </div>
        <div class="col-md-2 form-group">
            <label for="ecivil">Estado Civil</label>
            <select name="ecivil" class="form-control">
<?php
$ecivil2  =   $core->ShowAll( 'ecivil' );
foreach( $ecivil2 as $row )
{
    $selected   = ( $ecivil == $row['id'] ) ? 'selected':'';
    echo '
                <option value="'.$row['id'].'" '.$selected.'>'.$row['nombre'].'</option>
    ';
}
?>
            </select>
        </div>
        <div class="col-md-2 form-group">
            <label for="telefono">Telefono</label>
            <input type="number" name="telefono" class="form-control"  value="<?php echo $telefono ?>">
        </div>
        <div class="col-md-2 form-group">
            <label for="estudios">Estudios</label>
            <select name="estudios" class="form-control">
                <option value="">Seleccione Nivel de Estudios</option>

<?php
$estudios2  =   $core->ShowAll( 'estudios' );
foreach( $estudios2 as $fila )
{
    $selected   = ( $estudios == $fila['id'] ) ? 'selected':'';
    echo '
                <option value="'.$fila['id'].'" '.$selected.'>'.$fila['nombre'].'</option>
    ';
}
?>
            </select>
        </div>
    </div>
    
    
    <div class="row">
        <div class="col-md-2 form-group">
            <label for="talla">Talla Vestuario</label>
            <select name="talla" class="form-control">
<?php
$talla2  =   $core->ShowAll( 'talla' );
foreach( $talla2 as $row )
{
    $selected   = ( $talla == $row['id'] ) ? 'selected':'';
    echo '
                <option value="'.$row['id'].'" '.$selected.'>'.$row['nombre'].'</option>
    ';
}
?>
            </select>
        </div>
        <div class="col-md-2 form-group">
            <label for="calzado">Calzado</label>
            <select name="calzado" class="form-control">
<?php
$calzado2  =   $core->ShowAll( 'calzado' );
foreach( $calzado2 as $row )
{
    $selected   = ( $calzado == $row['id'] ) ? 'selected':'';
    echo '
                <option value="'.$row['id'].'" '.$selected.'>'.$row['nombre'].'</option>
    ';
}
?>
            </select>
        </div>
        <div class="col-md-2 form-group">
            <label for="alergia">Alergias</label>
            <select name="alergia" class="form-control">
<?php
echo            '<option value="'.$alergia.'" selected>'.$alergia.'</option>';
?>
                <option value="SI">SI</option>
                <option value="NO">NO</option>
            </select>
        </div>
        <div class="col-md-2 form-group">
            <label for="licencia">Licencia Conducir</label>
            <input type="text" name="licencia" class="form-control"  value="<?php echo $licencia ?>">
        </div>
        <div class="col-md-4 form-group">
            <label for="observaciones" rows="10">Observaciones</label>
<?php
echo '<textarea class="form-control">'.$observaciones.'</textarea>';
?>
        </div>
    </div>
    
  </div>
</div>


<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">DATOS LABORALES</h3>
  </div>
  <div class="panel-body">
    <div class="row">
        <div class="col-md-2 form-group">
            <label for="cargo">Cargo</label>
            <select name="cargo" class="form-control">
                <option value="">Seleccione Cargo</option>

<?php
$cargos  =   $core->ShowAll( 'cargos' );
foreach( $cargos as $row )
{
    $selected   = ( $cargo == $row['id'] ) ? 'selected':'';
    echo '
                <option value="'.$row['id'].'" '.$selected.'>'.$row['nombre'].'</option>
    ';
}
?>
            </select>
        </div>
        <div class="col-md-2 form-group">
            <label for="ingreso">Fecha de Ingreso</label>
            <input type="date" name="ingreso" class="form-control" value="<?php echo $ingreso ?>">
        </div>
        <div class="col-md-2 form-group">
            <label for="retiro">Fecha de Retiro</label>
            <input type="date" name="retiro" class="form-control" value="<?php echo $retiro ?>">
        </div>
        <div class="col-md-3 form-group">
            <label for="supervisor">Supervisor</label>
            <select name="supervisor" class="form-control">
                <option value="">Seleccione Supervisor</option>
                
<?php
$supervisor2     =   $core->ShowAll( 'usuarios' );
foreach( $supervisor2 as $row )
{
    $selected   = ( $supervisor == $row['id'] ) ? 'selected':'';
    echo '
                <option value="'.$row['id'].'" '.$selected.'>'.$row['nombre'].'</option>
    ';
}
?>

            </select>
        </div>
        <div class="col-md-3 form-group">
            <label for="brigada">Brigada</label>
            <select name="brigada" class="form-control">
                <option value="">Seleccione Brigada</option>
                
<?php
$brigada2     =   $core->ShowAll( 'brigadas' );
foreach( $brigada2 as $row )
{
    $selected   = ( $brigada == $row['id'] ) ? 'selected':'';
    echo '
                <option value="'.$row['id'].'" '.$selected.'>'.$row['nombre'].'</option>
    ';
}
?>

            </select>
        </div>
    </div>
  </div>
</div>

<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">DATOS PREVISIONALES</h3>
  </div>
  <div class="panel-body">
    <div class="row">
        <div class="col-md-4 form-group">
            <label for="afp">AFP</label>
            <select name="afp" class="form-control">
<?php
$afp2     =   $core->ShowAll( 'afp' );
foreach( $afp2 as $row )
{
    $selected   = ( $afp == $row['id'] ) ? 'selected':'';
    echo '
                <option value="'.$row['id'].'" '.$selected.'>'.$row['nombre'].'</option>
    ';
}
?>
            </select>
        </div>
        <div class="col-md-4 form-group">
            <label for="salud">Sistema de Salud</label>
            <select name="salud" class="form-control">
<?php
$salud2     =   $core->ShowAll( 'salud' );
foreach( $salud2 as $row )
{
    $selected   = ( $salud == $row['id'] ) ? 'selected':'';
    echo '
                <option value="'.$row['id'].'" '.$selected.'>'.$row['nombre'].'</option>
    ';
}
?>
            </select>
        </div>
        <div class="col-md-4 form-group">
            <label for="cargas">N&uacute;mero de Cargas</label>
            <input type="number" name="cargas" class="form-control" min="0" max="7" value="<?php echo $cargas ?>">
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <label for="accidenteNombre">En caso de Accidente avisar a</label>
            <input type="text" name="accidenteNombre" class="form-control" value="<?php echo $accidenteNombre ?>">
        </div>
        <div class="col-md-4 form-group">
            <label for="accidenteNumero">Tel&eacute;fono</label>
            <input type="number" name="accidenteNumero" class="form-control" value="<?php echo $accidenteNumero ?>">
        </div>
        <div class="col-md-4 form-group">
            <label for="estado">Estado</label>
            <select name="estado" class="form-control">
<?php
for( $i=0; $i<2; $i++ )
{
    $selected   =   ( $estado == $i )? ' selected' : '';
    $valor      =   ( $i == 0 )?'ACTIVO':'INACTIVO';
    echo '
                <option value="'.$i.'" '.$selected.'>'.$valor.'</option>
    ';
}
?>
            </select>
        </div>
    </div>
  </div>
</div>

    <div class="row col-md-6 form-group">
        <button type="submit" class="btn btn-primary" name="p" value="actualizar">Guardar</button>
    </div>
</form>

<!--Fin Contenido-->  

<?php 
require_once '../../layouts/blade/body_down.php'; 
require_once '../../layouts/blade/footer.php';
require_once '../../layouts/blade/fin.php';
?>
<script src="../../public/js/jQuery-2.1.4.min.js"></script>
<!-- Bootstrap 3.3.5 -->
<script src="../../public/js/bootstrap.min.js"></script> -->
<script src="../../public/js/bootstrap-select.min.js"></script>
<!-- AdminLTE App -->
<script src="../../public/js/app.min.js"></script> 
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/inputmask/inputmask.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.js"></script>

<script>
  $("#rut").inputmask({
	mask: "9[9.999.999]-[9|K|k]",
});
</script>
<!--Fin Contenido-->  

<?php 
    require_once '../../layouts/blade/body_down.php'; 
    require_once '../../layouts/blade/footer.php';
    require_once '../../layouts/blade/jquery.php';
    require_once '../../layouts/blade/fin.php';
?>