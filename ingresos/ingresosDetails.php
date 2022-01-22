<?php require_once '../../layouts/templateUp.php'; ?>

<div class="row">
    <div class="col-md-8">
        <h3> Detalles del Ingreso N&deg; <?php echo $id_enc ?></h3>
    </div>
    <div class="col-md-4"></div>
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
                                    <td align="left"><strong>SAP</strong></th>
                                    <td align="left"><strong>Material</strong></th>
                                    <td align="right"><strong>Cantidad</strong></th>
                                    <td align="right"><strong>Precio</strong></th>
                                    <td align="right"><strong>Subtotal</strong></th>
                                    <th></th>
                                </tr>';

foreach( $detalles as $value ):
echo '    
                                <tr>
                                    <td align="left">'.$value['c_sap'].'</td>
                                    <td align="left">'.$value['material'].'</td>
                                    <td align="right">'.$value['cantidad'].'</td>
                                    <td align="right">$ '.number_format( $value['valor'], 0, ',', '.' ).'</td>
                                    <td align="right">$ '.number_format( ( $value['valor'] * $value['cantidad'] ), 0, ',', '.' ).'</td>
                                </tr>
                                <tr>';
$total+= ( $value['valor'] * $value['cantidad'] );                                
endforeach;                                
echo '
                                    <th colspan="4" style="text-align: right;"><h3>Total:</h3></th>
                                    <th align="left"><h3>$ '.number_format( $total, 0, ',', '.' ).'</h3></th>
                                </tr>
                            </table>
                        </div>';
endif;?>
</div>
</div>
<?php require_once '../../layouts/templateDown.php'; ?>