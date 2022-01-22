<?php require_once '../../layouts/templateUp.php'; ?>

<div class="row">
    <div class="col-md-6">
        <h3>Nueva de Bodega</h3>
    </div>
    <div class="col-md-6"></div>
</div>

<form action="" method="post" autocomplete="off">
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <input type="text" name="nombre" class="form-control" required autofocus placeholder="Nombre de Bodega">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <select name="localidad" class="form-control">
<?php
$localidades    =   $model->ShowAll( 'localidades', 'ORDER BY contrato, nombre' );
foreach( $localidades as $value ):
echo'           <option value="'.$value['id'].'">'.$value['nombre'].'</option>';
endforeach;
?>
            </select>
        </div>
    </div>
    <div class="col-md-4">
        <div class="input-group">
            <select name="usuario" class="form-control">
<?php
$usuario    =   $model->ShowAll( 'usuarios', 'WHERE ( perfil = 3 OR perfil = 4 ) AND estado = "ACTIVO" ORDER BY nombre' );
foreach( $usuario as $value ):
echo'           <option value="'.$value['id'].'">'.$value['nombre'].'</option>';
endforeach;
?>
            </select>
            <span class="input-group-btn">
                <button type="submit" class="btn btn-success" name="p" value="save">Guardar</button>
            </span>
        </div>
    </div>
</div>
</form>

<?php require_once '../../layouts/templateDown.php'; ?>