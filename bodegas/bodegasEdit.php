<?php require_once '../../layouts/templateUp.php'; 
$update =   $model->ShowById( $class, $id );
foreach( $update as $row ):

?>

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
            <input type="text" name="nombre" class="form-control" required autofocus placeholder="Nombre de Bodega" value="<?php echo $row['nombre'] ?>">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <select name="localidad" class="form-control">

<?php
$localidades    =   $model->ShowAll( 'localidades', 'ORDER BY contrato, nombre' );

foreach( $localidades as $value ):
    $selected   =   ( $row['localidad'] == $value['id'] ) ?   'selected'  :   '';
echo'           <option value="'.$value['id'].'" '.$selected.'>'.$value['nombre'].'</option>';
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
    $selected   =   ( $row['usuario'] == $value['id'] ) ?   'selcted'   :   '';
echo'           <option value="'.$value['id'].'" '.$selected.'>'.$value['nombre'].'</option>';
endforeach;
?>
            </select>
            <span class="input-group-btn">
                <button type="submit" class="btn btn-success" name="p" value="update">Guardar</button>
                <input type="hidden" name="id" value="<?php echo $id ?>">
            </span>
        </div>
    </div>
</div>
</form>

<?php 
endforeach;
require_once '../../layouts/templateDown.php'; ?>