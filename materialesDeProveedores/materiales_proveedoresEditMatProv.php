<?php require_once '../../layouts/templateUp.php'; ?> 

<!-- row del encabezado -->
<div class="row">
    <div class="col-md-6">
        <h3> Editar Material de <?php echo $ShowById['nombre'] ?></h3>
    </div>
    <div class="col-md-6"></div>
</div>
<!-- ----------------------------------------------------------------- -->

<!-- row del formulario -->
<form action="" method="post">
<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label>Material</label>
            <select name="idMaterial" value="" class="form-control selectpicker" title="Seleccione Material" autofocus data-live-search="true">

<?php 
foreach( $ShowAll as $row ):   
    $selected   =   ( $row['id'] == $listaMat['material'] ) ? 'selected' : '';        
    echo '      <option value="'.$row['id'].'" '.$selected.'>'.$row['nombre'].'</option>';
endforeach; ?>

            </select>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>Precio Neto</label>
            <input type="number" name="valor" value="<?php echo $listaMat['valor'] ?>" class="form-control">
        </div>
    </div><div class="col-md-3">
        <div class="form-group">
            <label>Proveedor</label>
            <select name="proveedor" value="" class="form-control selectpicker" title="Seleccione Material" autofocus data-live-search="true">

<?php 
foreach( $ShowProv as $row ):   
    $selected   =   ( $row['id'] == $listaMat['proveedor'] ) ? 'selected' : '';        
    echo '      <option value="'.$row['id'].'" '.$selected.'>'.$row['nombre'].'</option>';
endforeach; ?>

            </select>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
        <label></label><br>
            <button type="submit" name="p" value="UpdateMatProv" class="btn btn-success">
                <i class="fa fa-save"> Guardar</i>
            </button>
            <input type="hidden" name="id" value="<?php echo $id ?>">
        </div>
    </div>
</div>
</form>

<?php require_once '../../layouts/templateDown.php'; ?> 