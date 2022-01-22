<?php require_once '../../layouts/templateUp.php'; ?>

<div class="row">
    <div class="col-md-6">
        <h3>Ingresos de Material N&deg; <?php echo $id_enc ?></h3>
    </div>
    <div class="col-md-6"></div>
</div>

<!--    FORMULARIO DE BUSQUEDA  -->
<div class="row">
    <div class="col-md-6">
        <form action="" method="post" autocomplete="off" >
            <div class="input-group">
                <select name="buscar"class="form-control selectpicker" data-live-search="true" autofocus placeholder="Barras, SAP o Nombre" required>
                    <option value="">Escriba material a Buscar</option>
<?php
$material   =   $model->ShowAll( 'materiales', 'ORDER BY nombre' );
foreach( $material as $value ):
echo '    
                <option value="'.$value['id'].'">'.$value['c_barras'].' '.$value['c_sap'].' '.$value['nombre'].'</option>';
endforeach;
?>
                </select>
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-success" name="p" value="search"><i class="fa fa-search-plus"></i></button>
                    <input type="hidden" name="id_enc" value="<?php echo $id_enc ?>">
                </span>
            </div>
        </form>
    </div>
    <div class="col-md-6"></div>
</div><br><!--    FIN FORMULARIO DE BUSQUEDA  -->

<?php
if( $buscar =   $model->ShowById( 'materiales', $search ) ):
    if( $buscar->num_rows == 1 ):

        foreach( $buscar as $row ):
        endforeach;

            $id_det =   $row['id'];
            $nombre =   $row['nombre'];
        else:
            $id_det =   NULL;
           $nombre =   NULL;
    endif;
else:
    
    $id_det =   NULL;
    $nombre =   NULL;
endif;
?>
<div class="row">
    <!--    PANEL DE INGRESO DE MATERIALES -->
    <div class="col-md-4">
        <div class="panel panel-warning">
            <div class="panel-heading">Detalle del Ingreso</div>
            <form action="" method="post" autocomplete="off">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Material" value="<?php echo $nombre ?>" required readonly>
                            <input type="hidden" name="material" value="<?php echo $id_det ?>">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="text" name="cantidad" class="form-control" placeholder="Cantidad" required>
                                <input type="hidden" name="id_enc" value="<?php echo $id_enc ?>">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="input-group">
                            <input type="text" name="valor" class="form-control" placeholder="Valor Neto">
                            <span class="input-group-btn">
                                <button type="submit" name="p" value="add" class="btn btn-success">Agregar</button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div><!--    FIN PANEL DE INGRESO DE MATERIALES -->

    <!-- PANEL CON TABLA DE INGRESOS -->
    <div class="col-md-8">
        <div class="panel panel-warning">
            <div class="panel-heading">Material Ingresado</div>
            <div class="panel-body">
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
                                    <th></th>
                                </tr>';

foreach( $detalles as $value ):
echo '    
                                <tr>
                                    <td>'.$value['c_sap'].'</td>
                                    <td>'.$value['material'].'</td>
                                    <td>'.$value['cantidad'].'</td>
                                    <td>$ '.number_format( $value['valor'], 0, ',', '.' ).'</td>
                                    <td>$ '.number_format( ( $value['valor'] * $value['cantidad'] ), 0, ',', '.' ).'</td>
                                    <td>
                                        <form method="post" action="">
                                            <button class="btn btn-danger" name="p" value="delete_det">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                            <input type="hidden" name="id_det" value="'.$value['id'].'">
                                            <input type="hidden" name="materiales" value="'.$value['materiales'].'">
                                            <input type="hidden" name="id_enc" value="'.$id_enc.'">
                                        </form>
                                    </td>
                                </tr>
                                <tr>';
$total+= ( $value['valor'] * $value['cantidad'] );                                
endforeach;                                
echo '
                                    <th colspan="4" style="text-align: right;">Total:</th>
                                    <th align="left">$ '.number_format( $total, 0, ',', '.' ).'</th>
                                    <th>
                                        <form method="post" action="">
                                            <button class="btn btn-primary" type="submit" name="p" value="close">Guardar</button>
                                            <input type="hidden" name="total" value="'.$total.'">
                                            <input type="hidden" name="id_enc" value="'.$id_enc.'">
                                        </form>
                                    </th>
                                </tr>
                            </table>
                        </div>';
else:
    echo '              <div class="bg-success"><strong>NO HAY ELEMENTOS AGREGADOS A ESTE INGRESO</strong></div>'; 
endif;?>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- PANEL CON TABLA DE INGRESOS -->
</div>


<?php require_once '../../layouts/templateDown.php'; ?>