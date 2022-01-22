<?php require_once '../../layouts/templateUp.php'; 

$encabezado =   $model->SelectByKey( $class.'_enc', 'id', $id_enc, '' );
foreach ( $encabezado as $value ):
    $fechaTraspaso  =   date( 'd-m-Y', strtotime( $value['fecha'] ));
endforeach;
?>

<div class="row">
    <div class="col-md-8">
        <h3>Detalles de Traspaso N&deg; <?php echo $id_enc ?></h3>
    </div>
    <div class="col-md-4"></div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>FECHA</label>
            <input type="text" class="form-control" required value="<?php echo $fechaTraspaso ?>" readonly>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>ORIGEN</label>
            <select class="form-control" disabled>
<?php
require_once '../bodegas/bodegasModel.php';
$bodegas = new bodegas;
$origen =   $bodegas->ListarBodegas();
foreach ($origen as $key):
    $selected   =   ( $key['id'] == $value['origen'] )  ?   'selected'  :   '';
    echo '
                <option value="'.$key['id'].'" '.$selected.'>'.$key['nombre'].' '.$key['localidad'].'</option>';
endforeach;
?>
            </select>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>ORIGEN</label>
            <select class="form-control" disabled>
<?php
foreach ($origen as $key):
    $selected   =   ( $key['id'] == $value['destino'] )  ?   'selected'  :   '';
    echo '
                <option value="'.$key['id'].'" '.$selected.'>'.$key['nombre'].' '.$key['localidad'].'</option>';
endforeach;
?>
            </select>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
<?php
$detalles   =   $clase->mostrarMaterial( $id_enc );
if( $detalles->num_rows > 0 ):
echo '
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-condensed table-bordered">
                                <tr>
                                    <th>SAP</th>
                                    <th>Material</th>
                                    <th>Cantidad</th>
                                    <th>Precio</th>
                                    <th>Subtotal</th>
                                </tr>';

foreach( $detalles as $value ):
echo '    
                                <tr>
                                    <td>'.$value['c_sap'].'</td>
                                    <td>'.$value['material'].'</td>
                                    <td>'.$value['cantidad'].'</td>
                                    <td>$ '.number_format( $value['valor'], 0, ',', '.' ).'</td>
                                    <td>$ '.number_format( ( $value['valor'] * $value['cantidad'] ), 0, ',', '.' ).'</td>
                                </tr>';
endforeach; 
echo '
                            </table>
                        </div>';
else:
    echo '              <div class="bg-success"><strong>NO HAY ELEMENTOS AGREGADOS A ESTE INGRESO</strong></div>'; 
endif;?>
    </div>
</div>

<?php require_once '../../layouts/templateDown.php'; ?>