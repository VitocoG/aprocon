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
        
        require_once '../../config/core.class.php';
        $core   =   new core;
?>





<!--Contenido-->
<form action="trabajadores.php" method="post">
<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">DATOS PERSONALES</h3>
  </div>
  <div class="panel-body">
    <div class="row">
        <div class="col-md-3 form-group">
            <label for="nombre">Nombres</label>
            <input type="text" name="nombre" class="form-control" required autofocus>
        </div>
        <div class="col-md-3 form-group">
            <label for="apellido">Apellidos</label>
            <input type="text" name="apellido" class="form-control" required>
        </div>
        <div class="col-md-2 form-group">
            <label for="rut">Rut</label>
            <input type="text" name="rut" id="rut" class="form-control" required>
        </div>
        <div class="col-md-2 form-group">
            <label for="fecha">F. Nacimiento</label>
            <input type="date" name="fecha" class="form-control" required>
        </div>
        <div class="col-md-2 form-group">
            <label for="ecivil">Estado Civil</label>
            <select name="ecivil" class="form-control">
                <option value="">SELECCIONE ESTADO CIVIL</option>
<?php
$ecivil  =   $core->ShowAll( 'ecivil' );
foreach( $ecivil as $row )
{
    echo '
                <option value="'.$row['id'].'">'.$row['nombre'].'</option>
    ';
}
?>
            </select>
        </div>
    </div>
    
    
    <div class="row">
        <div class="col-md-4 form-group">
            <label for="domicilio">Domicilio</label>
            <input type="text" name="domicilio" class="form-control" required>
        </div>
        <div class="col-md-2 form-group">
            <label for="localidad">Localidad</label>
            <select name="localidad" class="form-control" required>
                <option value="">Seleccione Localidad</option>
<?php
$localidad  =   $core->ShowAll( 'localidades' );
foreach( $localidad as $row )
{
    echo '
                <option value="'.$row['id'].'">'.$row['nombre'].'</option>
    ';
}
?>
            </select>
        </div>
        <div class="col-md-2 form-group">
            <label for="telefono">Telefono</label>
            <input type="number" name="telefono" class="form-control" required>
        </div>
        <div class="col-md-2 form-group">
            <label for="estudios">Estudios</label>
            <select name="estudios" class="form-control">
                <option value="">Seleccione Nivel de Estudios</option>

<?php
$estudios  =   $core->ShowAll( 'estudios' );
foreach( $estudios as $fila )
{
    echo '
                <option value="'.$fila['id'].'">'.$fila['nombre'].'</option>
    ';
}
?>
            </select>
        </div>
        <div class="col-md-2 form-group">
            <label for="titulo">T&iacute;tulo Profesional</label>
            <input type="text" name="titulo" class="form-control" required>
        </div>
    </div>
    
    
    <div class="row">
        <div class="col-md-2 form-group">
            <label for="talla">Talla Vestuario</label>
            <select name="talla" class="form-control">
                <option value="">SELECCIONE TALLA</option>
<?php
$talla  =   $core->ShowAll( 'talla' );
foreach( $talla as $row )
{
    echo '
                <option value="'.$row['id'].'">'.$row['nombre'].'</option>
    ';
}
?>
            </select>
        </div>
        <div class="col-md-2 form-group">
            <label for="calzado">Calzado</label>
            <select name="calzado" class="form-control">
                <option value="">SELECCIONE CALZADO</option>
<?php
$calzado  =   $core->ShowAll( 'calzado' );
foreach( $calzado as $row )
{
    echo '
                <option value="'.$row['id'].'">'.$row['nombre'].'</option>
    ';
}
?>
            </select>
        </div>
        <div class="col-md-2 form-group">
            <label for="alergia">Alergias</label>
            <select name="alergia" class="form-control">
                <option value="SI">SI</option>
                <option value="NO">NO</option>
            </select>
        </div>
        <div class="col-md-2 form-group">
            <label for="licencia">Licencia Conducir</label>
            <input type="text" name="licencia" class="form-control" required>
        </div>
        <div class="col-md-4 form-group">
            <label for="observaciones" rows="10">Observaciones</label>
            <textarea class="form-control" name="observaciones"></textarea>
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
$cargo  =   $core->ShowAll( 'cargos' );
foreach( $cargo as $fila )
{
    echo '
                <option value="'.$fila['id'].'">'.$fila['nombre'].'</option>
    ';
}
?>
            </select>
        </div>
        <div class="col-md-2 form-group">
            <label for="ingreso">Fecha de Ingreso</label>
            <input type="date" name="ingreso" class="form-control">
        </div>
        <div class="col-md-2 form-group">
            <label for="retiro">Fecha de Retiro</label>
            <input type="date" name="retiro" class="form-control">
        </div>
        <div class="col-md-3 form-group">
            <label for="supervisor">Supervisor</label>
            <select name="supervisor" class="form-control">
                <option value="">Seleccione Supervisor</option>
                
<?php
$supervisor     =   $core->ShowAll( 'usuarios' );
foreach( $supervisor as $fila )
{
    echo '
                <option value="'.$fila['id'].'">'.$fila['nombre'].'</option>
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
$brigada     =   $core->ShowAll( 'brigadas' );
foreach( $brigada as $fila )
{
    echo '
                <option value="'.$fila['id'].'">'.$fila['nombre'].'</option>
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
                <option value="">SELECCIONE AFP</option>
<?php
$afp  =   $core->ShowAll( 'afp' );
foreach( $afp as $row )
{
    echo '
                <option value="'.$row['id'].'">'.$row['nombre'].'</option>
    ';
}
?>
            </select>
        </div>
        <div class="col-md-4 form-group">
            <label for="salud">Sistema de Salud</label>
            <select name="salud" class="form-control">
                <option value="">SELECCIONE SISTEMA DE SALUD</option>
<?php
$salud  =   $core->ShowAll( 'salud' );
foreach( $salud as $row )
{
    echo '
                <option value="'.$row['id'].'">'.$row['nombre'].'</option>
    ';
}
?>
            </select>
        </div>
        <div class="col-md-4 form-group">
            <label for="cargas">N&uacute;mero de Cargas</label>
            <input type="number" name="cargas" class="form-control" min="0" max="7">
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label for="accidenteNombre">En caso de Accidente avisar a</label>
            <input type="text" name="accidenteNombre" class="form-control">
        </div>
        <div class="col-md-6 form-group">
            <label for="accidenteNumero">Tel&eacute;fono</label>
            <input type="number" name="accidenteNumero" class="form-control">
            <input type="hidden" value="0" name="estado">
        </div>
    </div>
  </div>
</div>

    <div class="row col-md-6 form-group">
        <button type="submit" class="btn btn-primary" name="p" value="nuevo">Guardar</button>
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
<?php  
}
else
{
    header( 'Location:../../' );
}
?>