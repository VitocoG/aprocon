<?php require_once '../../layouts/templateUp.php'; ?>

<div class="row">
    <div class="col-md-8">
        <h3>Ingresos a Bodega</h3>
    </div><!--  /.col-md-6   -->
    <div class="col-md-4"></div><!--  /.col-md-6 -->
</div><!--  /.row   -->

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-warning">
            <div class="panel-heading">Datos del Ingreso</div><!--  /.panel-heading -->
            <div class="panel-body">
                <form action="" method="post" autocomplete="off">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <select name="proveedor" class="form-control selectpicker" required data-show-subtext="off" data-live-search="true" autofocus>
                                <option value="0">Inventario Inicial</option>
<?php
$proveedores    =   $model->ShowAll( 'proveedores', 'ORDER BY nombre');
foreach ($proveedores as $value ):
    echo '                      <option value="'.$value['id'].'">'.$value['nombre'].'</option>';
endforeach;
?>

                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="number" name="num_factura" class="form-control" required placeholder="Numero de Factura">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group">
                            <input type="number" name="total" required class="form-control" placeholder="Total Ingreso Neto">
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-success" name="p" value="save_encabezado">Guardar</button>
                            </span>
                            
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>


<?php require_once '../../layouts/templateDown.php'; ?>