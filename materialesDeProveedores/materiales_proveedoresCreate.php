<?php require_once '../../layouts/templateUp.php'; ?>

<!-- row -->
<div class="row">
    <div class="col-md-6">
        <h3> Nuevo Material</h3>
    </div>
    <div class="col-md-6"></div>
</div>
<!-- /row -->


<!-- row -->
<div class="row">
    <form action="" method="post" autocomplete="off">
        <div class="col-md-4">
            <div class="form-group">
                <label>Nombre</label>
                <input type="text" name="nombre" value="" class="form-control" required autofocus>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Categor&iacute;a</label>
                <select name="categoria" class="form-control">

<!-- recorremos el array para mostrar todas las categorias en el control -->  
<?php
foreach( $ShowAll as $value ):
    echo '        <option value="'.$value['id'].'">'.$value['nombre'].'</option>';
endforeach; ?>
<!-- cierre del recorrido del array -->

                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label> </label><br>
                <button type="submit" name="p" value="Save" class="btn btn-success">
                    <i class="fa fa-save"> Guardar</i>
                </button>
            </div>
        </div>
    </form>
</div>
<!-- /row -->


<?php require_once '../../layouts/templateDown.php'; ?>