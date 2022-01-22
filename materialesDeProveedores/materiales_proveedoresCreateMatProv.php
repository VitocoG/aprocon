<?php require_once '../../layouts/templateUp.php'; ?> 

<!-- row del encabezado -->
<div class="row">
    <div class="col-md-6">
        <h3> Nuevo Material de <?php echo $ShowById['nombre'] ?></h3>
    </div>
    <div class="col-md-6"></div>
</div>
<!-- ----------------------------------------------------------------- -->

<!-- row del formulario -->
<form action="" method="post">
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>Material</label>
            <select name="idMaterial" value="" class="form-control selectpicker" title="Seleccione Material" autofocus data-live-search="true">

<?php 
foreach( $ShowAll as $row ):           
    echo '      <option value="'.$row['id'].'">'.$row['nombre'].'</option>';
endforeach; ?>

            </select>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Precio Neto</label>
            <input type="number" name="valor" value="" class="form-control">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
        <label></label><br>
            <button type="submit" name="p" value="SaveMatProv" class="btn btn-success">
                <i class="fa fa-save"> Guardar</i>
            </button>
            <input type="hidden" name="proveedor" value="<?php echo $ShowById['id'] ?>">
        </div>
    </div>
</div>
</form>

<?php require_once '../../layouts/templateDown.php'; ?> 