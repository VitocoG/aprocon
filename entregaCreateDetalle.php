<?php
require_once '../../layouts/templateUp.php'; ?>

<div class="row">
    <div class="col-md-6">
        <h3>Entrega N&deg; <?php echo $idEnc ?></h3>
    </div>
    <div class="col-md-6"></div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-warning">
            <div class="panel-heading"><h4>Detalle de la Entrega</h4></div>
            <div class="panel-body">
                <form action="" method="post">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="number" name="cantidad" id="cantidad" min="1" placeholder="cantidad" class="form-control" required autofocus>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="number" name="precio" id="precio" min="0" placeholder="precio" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" name="estado" id="estado" placeholder="estado" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" name="concepto" id="concepto" placeholder="concepto" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group">
                            <input type="text" name="observaciones" class="form-control" id="observaciones" class="form-control" placeholder="observaciones" class="form-control">
                                <span class="input-group-btn">
                                    <button type="submit" name="p" value="detalle" class="btn btn-warning"> Agregar</button>
                                    <input type="hidden" name="idEnc" value="<?php echo $idEnc ?>">
                                </span>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-striped table-hover table-condensed table-bordered">
                <tr>
                    <th>Cantidad</th>
                    <th>Concepto</th>
                    <th>Precio</th>
                    <th>Sub-Total</th>
                    <th>Estado</th>
                    <th>Observaciones</th>
                    <th></th>
                </tr>
<?php
$MostrarDetalle =   $model->SelectByKey( $class.'_det', 'entrega_enc', $idEnc, '' );
$suma = 0;
foreach( $MostrarDetalle as $row ):
echo '
                <tr>
                    <td>'.$row['cantidad'].'</td>
                    <td>'.$row['concepto'].'</td>
                    <td>$ '.number_format( $row['precio'], 0, ',', '.' ).'</td>
                    <td>$ '.number_format( $row['cantidad'] * $row['precio'], 0, ',', '.' ).'</td>
                    <td>'.$row['estado'].'</td>
                    <td>'.$row['observaciones'].'</td>
                    <td>
                        <form action="" method="post">
                            <button name="p" value="delete_det" class="btn btn-danger">X</button>
                            <input type="hidden" name="idDetalle" value="'.$row['id'].'">
                        </form>
                    </td>
                </tr>';
$suma = $suma + ( $row['cantidad'] * $row['precio'] );
endforeach;
?>               <tr>
                    <th colspan="3" style="text-align: right;">TOTAL: </th>
                    <th><?php echo '$ '.number_format( $suma, 0, ',', '.' ) ?></th>
                    <td>
                        <form action="" method="post">
                            <button type="submit" class="btn btn-dropbox">Guardar</button>
                        </form>
                    </td>
                </tr> 
            </table>
        </div>
    </div>
</div>
<?php
require_once '../../layouts/templateDown.php'
?>