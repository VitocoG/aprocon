<?php require_once '../../layouts/templateUp.php'; 

$permisos   =   $model->SelectByKey( 'permisos', 'persona', $id, '' );
foreach( $permisos as $row ):
    $idPermiso      =   ( $row['id'] );
    $depositos      =   ( $row['depositos']         == 1 )  ? "checked" : "";
    $usuarios       =   ( $row['usuarios']          == 1 )  ? "checked" : "";
    $trabajadores   =   ( $row['trabajadores']      == 1 )  ? "checked" : "";
    $saldos         =   ( $row['saldos']            == 1 )  ? "checked" : "";
    $arriendo_retro =   ( $row['arriendo_retro']    == 1 )  ? "checked" : "";
    $entrega        =   ( $row['entrega']           == 1 )  ? "checked" : "";
    $localidades    =   ( $row['localidades']       == 1 )  ? "checked" : "";
    $perfiles       =   ( $row['perfiles']          == 1 )  ? "checked" : "";
    $brigadas       =   ( $row['brigadas']          == 1 )  ? "checked" : "";
    $itos           =   ( $row['itos']              == 1 )  ? "checked" : "";
    $cargos         =   ( $row['cargos']            == 1 )  ? "checked" : "";
    $proveedores    =   ( $row['proveedores']       == 1 )  ? "checked" : "";
    $gastos         =   ( $row['gastos']            == 1 )  ? "checked" : "";
    $horas_extras   =   ( $row['horas_extras']      == 1 )  ? "checked" : "";
    $inventario     =   ( $row['inventario']        == 1 )  ? "checked" : "";
endforeach;

$usuario            =   $model->ShowById('usuarios', $id);
foreach($usuario as $value):
    $nombre         =   $value['nombre'];
endforeach;
?>

<h2>Permisos del Usuario: <?php echo $usuario['nombre'] ?></h2><hl></hl>

<form action="" method="post">
<div class='row'>    
    <div class="col-md-2">
        <div class="form-group">
            <label>
                <input type="checkbox" name="depositos" value="1" <?php echo $depositos ?> > Dep&oacute;sitos
            </label>
        </div>
    </div>    
    <div class="col-md-2">
        <div class="form-group">
            <label>
                <input type="checkbox" name="usuarios" value="1" <?php echo $usuarios ?>> Usuarios
            </label>
        </div>
    </div>    
    <div class="col-md-2">
        <div class="form-group">
            <label>
                <input type="checkbox" name="trabajadores" value="1" <?php echo $trabajadores ?> > Trabajadores
            </label>
        </div>
    </div>    
    <div class="col-md-2">
        <div class="form-group">
            <label>
                <input type="checkbox" name="saldos" value="1" <?php echo $saldos ?> > Saldos
            </label>
        </div>
    </div>    
    <div class="col-md-2">
        <div class="form-group">
            <label>
                <input type="checkbox" name="arriendo_retro" value="1" <?php echo $arriendo_retro ?> > Arriendo Retro
            </label>
        </div>
    </div>    
    <div class="col-md-2">
        <div class="form-group">
            <label>
                <input type="checkbox" name="entrega" value="1" <?php echo $entrega ?> > Nota de Entrega
            </label>
        </div>
    </div>    
    <div class="col-md-2">
        <div class="form-group">
            <label>
                <input type="checkbox" name="localidades" value="1" <?php echo $localidades ?> > Localidades
            </label>
        </div>
    </div>    
    <div class="col-md-2">
        <div class="form-group">
            <label>
                <input type="checkbox" name="perfiles" value="1" <?php echo $perfiles ?> > Perfiles
            </label>
        </div>
    </div>    
    <div class="col-md-2">
        <div class="form-group">
            <label>
                <input type="checkbox" name="brigadas" value="1" <?php echo $brigadas ?> > Brigadas
            </label>
        </div>
    </div>    
    <div class="col-md-2">
        <div class="form-group">
            <label>
                <input type="checkbox" name="itos" value="1" <?php echo $itos ?> > Itos
            </label>
        </div>
    </div>    
    <div class="col-md-2">
        <div class="form-group">
            <label>
                <input type="checkbox" name="cargos" value="1" <?php echo $cargos ?> > Cargos
            </label>
        </div>
    </div>    
    <div class="col-md-2">
        <div class="form-group">
            <label>
                <input type="checkbox" name="proveedores" value="1" <?php echo $proveedores ?> > Proveedores
        </div>
    </div>    
    <div class="col-md-2">
        <div class="form-group">
            <label>
                <input type="checkbox" name="gastos" value="1" <?php echo $gastos ?> > Gastos
            </label>
        </div>
    </div>    
    <div class="col-md-2">
        <div class="form-group">
            <label>
                <input type="checkbox" name="horas_extras" value="1" <?php echo $horas_extras ?> > Horas Extras
            </label>
        </div>
    </div>    
    <div class="col-md-2">
        <div class="form-group">
            <label>
                <input type="checkbox" name="inventario" value="1" <?php echo $inventario ?> > Inventario
            </label>
        </div>
    </div>
</div>
<div class='row col-md-6 form-group'>
    <button type="submit" class="btn btn-success" value="SavePermission" name="p">Guardar</button>
    <input type="hidden" name="id" value="<?php echo $idPermiso ?>">
</div>
</form>


<?php require_once '../../layouts/templateDown.php'; ?>