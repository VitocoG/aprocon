<?php require_once '../../layouts/templateUp.php'; 
$nombre = NULL;
$stock  = NULL;
?>

<div class="row">
    <div class="col-md-8">
        <h3>Traspaso N&deg;<?php echo $id_enc.' desde Bodega '.$_SESSION['nombreBodega'] ?> </h3>
    </div>
    <div class="col-md-4"></div>
</div>

<!--    FORMULARIO DE BUSQUEDA  -->
<div class="row">
    <div class="col-md-6">
        <form action="" method="post" autocomplete="off" >
            <div class="input-group">
                <select name="material"class="form-control selectpicker" data-live-search="true" autofocus placeholder="Barras, SAP o Nombre" required>
                    <option value="">Escriba material a Buscar</option>
<?php 
$materialesStock   =   $materiales->materialesStock( $_SESSION['bodegaId'] );
foreach( $materialesStock as $value ):
echo '    
                <option value="'.$value['id'].'">'.$value['c_barras'].' '.$value['c_sap'].' '.$value['nombre'].'</option>';
endforeach;
?>
                </select>
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-success" name="p" value="search"><i class="fa fa-search-plus"></i></button>
                    <input type="hidden" name="id_enc" value="<?php echo $id_enc ?>">
                    <input type="hidden" name="destino" value="<?php echo $destino ?>" class="form-control">
                </span>
            </div>
        </form>
    </div>
    <div class="col-md-6"></div>
</div><br><!--    FIN FORMULARIO DE BUSQUEDA  -->



<?php

if( $stockMateriales    =   $clase->listarStockMateriales( $_SESSION['bodegaId'], $material )):
    foreach ( $stockMateriales as $key ):
        $nombre =   $key['nombre'];
        $stock  =   $key['bodega'.$_SESSION['bodegaId']];
        $valor  =   $key['valor'];
    endforeach;
else:
        $nombre =   "";
        $stock  =   "";
endif;

?>
<div class="row">
    <!--    PANEL DE INGRESO DE MATERIALES -->
    <div class="col-md-4">
        <div class="panel panel-warning">
            <div class="panel-heading">Detalle del Traspaso</div>
            <form action="" method="post" autocomplete="off">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Material" value="<?php echo $nombre ?>" required readonly>
                            <input type="hidden" name="material" value="<?php echo $material ?>">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="number" name="cantidad" class="form-control" placeholder="Maximo <?php echo $stock ?>" required max="<?php echo $stock ?>">
                                <input type="hidden" name="id_enc" value="<?php echo $id_enc ?>">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="input-group">
                            <input type="text" name="valor" class="form-control" placeholder="Valor Neto" required value="<?php echo $valor ?>" readonly>
                            <span class="input-group-btn">
                                <input type="hidden" name="destino" value="<?php echo $destino ?>" class="form-control">
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
                                            <input type="hidden" name="material" value="'.$value['id_material'].'">
                                            <input type="hidden" name="cantidad" value="'.$value['cantidad'].'">
                                            <input type="hidden" name="destino" value="'.$destino.'" class="form-control">
                                        </form>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>';
$total+= ( $value['valor'] * $value['cantidad'] );                                
endforeach;                                
echo '
                                    <th colspan="4" style="text-align: right;">Total:</th>
                                    <th align="left">$ '.number_format( $total, 0, ',', '.' ).'</th>
                                    <form method="post" action="">
                                    <th>
                                        <button class="btn btn-primary" type="submit" name="p" value="close">Guardar</button>
                                        <input type="hidden" name="total" value="'.$total.'">
                                        <input type="hidden" name="id_enc" value="'.$id_enc.'">
                                        <input type="hidden" name="destino" value="'.$destino.'" class="form-control">
                                    </th>
                                    <th>
                                        <button class="btn btn-danger" type="submit" name="p" value="pdf">
                                            <i class="fa fa-file-pdf-o"></i> PDF
                                        </button>
                                    </th>
                                    </form>
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


<?php  require_once '../../layouts/templateDown.php'; ?>