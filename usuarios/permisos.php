<?php 
$id     =   $_REQUEST['id'];

require_once '../../layouts/blade/head.php';
require_once '../../layouts/blade/header.php';
require_once '../../layouts/blade/aside.php';
require_once '../../layouts/blade/body_up.php';


require_once '../../config/core.class.php';
$core               =   new core;

$permisos           =   $core->SelectByKey( 'permisos', 'persona', $id );

foreach( $permisos as $row)
{
    $persona        =   ( $row['persona'] == 1 ) ? "checked" : "";
    $depositos      =   ( $row['depositos'] == 1 ) ? "checked" : "";
	$localidades    =   ( $row['localidades'] == 1 ) ? "checked" : "";
	$perfiles       =   ( $row['perfiles'] == 1 ) ? "checked" : "";
	$usuarios       =   ( $row['usuarios'] == 1 ) ? "checked" : "";
	$saldos         =   ( $row['saldos'] == 1 ) ? "checked" : "";
	$trabajadores   =   ( $row['trabajadores'] == 1 ) ? "checked" : "";
	$brigadas       =   ( $row['brigadas'] == 1 ) ? "checked" : "";
	$itos           =   ( $row['itos'] == 1 ) ? "checked" : "";
	$cargos         =   ( $row['cargos'] == 1 ) ? "checked" : "";
	$contratos      =   ( $row['contratos'] == 1 ) ? "checked" : "";
	$ods            =   ( $row['ods'] == 1 ) ? "checked" : "";
	$lista_gastos   =   ( $row['gastos'] == 1 ) ? "checked" : "";
	$horas_extras   =   ( $row['horas_extras'] == 1 ) ? "checked" : "";
	$inventario     =   ( $row['inventario'] == 1 ) ? "checked" : "";
	$retro          =   ( $row['arriendo_retro'] == 1 ) ? "checked" : "";
}

$usuario            =   $core->ShowById('usuarios', $id);
foreach($usuario as $value):
    $nombre         =   $value['nombre'];
endforeach;

?>
<h2>Permisos del Usuario: <?php echo $nombre ?></h2><hl></hl>

<form action="permisos.class.php" method="post">
<div class='row'>    
    <div class="col-md-2">
        <label>
        <input type="checkbox" name="depositos" value="1" <?php echo $depositos ?>>
        Crear Dep&oacute;sitos</label>
    </div>
    <div class="col-md-2">
        <label>
        <input type="checkbox" name="localidades" value="1" <?php echo $localidades ?>>
        Crear Localidades</label>
    </div>
    <div class="col-md-2">
        <label>
        <input type="checkbox" name="perfiles" value="1" <?php echo $perfiles ?>>
        Crear Perfiles</label>
    </div>
    <div class="col-md-2">
        <label>
        <input type="checkbox" name="usuarios" value="1" <?php echo $usuarios ?>>
        Crear Usuarios</label>
    </div>
    <div class="col-md-2">
        <label>
        <input type="checkbox" name="saldos" value="1" <?php echo $saldos ?>>
        Revisar Saldos</label>
    </div>
    <div class="col-md-2">
        <label>
        <input type="checkbox" name="trabajadores" value="1" <?php echo $trabajadores ?>>
        Crear Trabajadores</label>
    </div>
</div>

<div class='row'>
    <div class="col-md-2">
        <label>
        <input type="checkbox" name="brigadas" value="1" <?php echo $brigadas ?>>
        Crear Brigadas</label>
    </div>
    <div class="col-md-2">
        <label>
        <input type="checkbox" name="itos" value="1" <?php echo $itos ?>>
        Crear Itos</label>
    </div>
    <div class="col-md-2">
        <label>
        <input type="checkbox" name="cargos" value="1" <?php echo $cargos ?>>
        Crear Cargos</label>
    </div>
    <div class="col-md-2">
        <label>
        <input type="checkbox" name="contratos" value="1" <?php echo $contratos ?>>
        Crear Contratos</label>
    </div>
    <div class="col-md-2">
        <label>
        <input type="checkbox" name="ods" value="1" <?php echo $ods ?>>
        Crear ODS</label>
    </div>
</div>


<div class='row'>
    <div class="col-md-3">
        <label>
        <input type="checkbox" name="lista_gastos" value="1"  <?php echo $lista_gastos ?>>
        Listar Gastos</label>
    </div>
    <div class="col-md-3">
        <label>
        <input type="checkbox" name="horas_extras" value="1" <?php echo $horas_extras ?>>
        Horas Extras</label>
    </div>
    <div class="col-md-3">
        <label>
        <input type="checkbox" name="inventario" value="1" <?php echo $inventario ?>>
        Ingresar Inventario</label>
    </div>
    <div class="col-md-3">
        <label>
        <input type="checkbox" name="retro" value="1" <?php echo $retro ?>>
        Ingresar Arriendo Retro</label>
    </div>
</div>
<div class='row col-md-6 form-group'>
    <button type="submit" class="btn btn-success" value="<?php echo $id ?>" name="id">Guardar</button>
</div>
</form>


<?php
require_once '../../layouts/blade/body_down.php';
require_once '../../layouts/blade/footer.php';
require_once '../../layouts/blade/jquery.php';
require_once '../../layouts/blade/fin.php';
?>