<?php require_once '../../layouts/templateUp.php'; ?>

<div class="row">
    <div class="col-md-6">
        <h3>Solicitud de Compra N&deg; <?php echo $id ?></h3>
    </div>
    <div class="col-md-6"></div>
</div>


<!-- ---------------------------------------------------------------------------------------------------------- -->
<!--    FORMULARIO DE BUSQUEDA  -->
<div class="row">
    <div class="col-md-6">
        <form action="" method="post" autocomplete="off" >
            <div class="input-group">
                <select name="buscar"class="form-control selectpicker" data-live-search="true" autofocus placeholder="Barras, SAP o Nombre" required>

<!-- array con los materiales -->
<?php
foreach( $listarMaterialesProveedor as $value ):
echo '    
                <option value="'.$value['material'].'">'.$value['materialNombre'].'</option>';
endforeach;
?>
<!-- fin array con los materiales -->
                </select>
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-success" name="p" value="search"><i class="fa fa-search-plus"></i></button>
                    <input type="hidden" name="id" value="<?php echo $id ?>" class="form-control">
                    <input type="hidden" name="proveedor" value="<?php echo $proveedor ?>" class="form-control">>
                </span>
            </div>
        </form>
    </div>
    <div class="col-md-6"></div>
</div><br><!--    FIN FORMULARIO DE BUSQUEDA  -->
<!-- ------------------------------------------------------------------------------------------------------------- -->




<div class="row">
    <!--    PANEL DE INGRESO DE MATERIALES -->
    <div class="col-md-4">
        <div class="panel panel-warning">
            <div class="panel-heading">Detalle del Ingreso</div>
            <form action="" method="post" autocomplete="off" class="form-horizontal">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="producto" class="col-sm-4 control-label">Producto</label>
                            <div class="col-sm-8">
                                <input type="text" name="producto" class="form-control" placeholder="Material" value="<?php echo $listarBuscar['descripcion'] ?>" required readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="producto" class="col-sm-4 control-label">Medida</label>
                            <div class="col-sm-8">
                                <input type="text" name="medida" class="form-control" placeholder="Ej. Talla M"  value="">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="producto" class="col-sm-4 control-label">Cantidad</label>
                            <div class="col-sm-8">    
                                <input type="text" name="cantidad" class="form-control" placeholder="Cantidad" required value="1">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="producto" class="col-sm-4 control-label">Valor</label>
                            <div class="col-sm-8"> 
                                <input type="number" name="valor" class="form-control" placeholder="Valor Neto" value="<?php echo $listarBuscar['valor'] ?>" min="0">                                
                            </div>
                            <input type="hidden" name="id" value="<?php echo $id ?>">
                            <input type="hidden" name="proveedor" value="<?php echo $proveedor ?>">
                            <input type="hidden" name="descripcion" value="<?php echo $listarBuscar['material']; ?>">
                        </div>
                    </div>
                    <div class="col-md-9"></div>
                    <div class="col-md-3"><button type="submit" name="p" value="add" class="btn btn-success">Agregar</button></div>
                </div>
            </div>
            </form>
        </div>
    </div><!--    FIN PANEL DE INGRESO DE MATERIALES -->
    <!-- --------------------------------------------------------------------------------------------------------------------------------- -->





    <!-- PANEL CON TABLA DE INGRESOS -->
    <div class="col-md-8">
        <div class="panel panel-warning">
            <div class="panel-heading">Material Ingresado</div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">

<?php if( $listarDetalle->num_rows > 0 ):
echo '                   
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-condensed table-bordered">
                                <tr>
                                    <th>Medida</th>
                                    <th>Descripci&oacute;n</th>
                                    <th>Cantidad</th>
                                    <th>Precio</th>
                                    <th>Subtotal</th>
                                    <th></th>
                                </tr>';

/* <!-- LISTAR REGISTROS INGRESADOS AL DETALLE --> */   
$sum = 0;
foreach( $listarDetalle as $row ):
    echo '                      <tr>
                                    <td>'.$row['medida'].'</td>
                                    <td>'.$row['descripcion'].'</td>
                                    <td>'.$row['cantidad'].'</td>
                                    <td>$ '.number_format( $row['valor'], 0, ',', '.' ).'</td>
                                    <td>$ '.number_format( $row['total'], 0, ',', '.' ).'</td>
                                    <td>
                                        <form method="post" action="">
                                            <button class="btn btn-danger" name="p" value="delete_det">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                            <input type="hidden" name="idDet" value="'.$row['id'].'">
                                            <input type="hidden" name="descripcion" value="'.$row['idDescripcion'].'">
                                            <input type="hidden" name="id" value="'.$id.'">
                                            <input type="hidden" name="proveedor" value="'.$proveedor.'">
                                        </form>
                                    </td>
                                </tr>';
$sum+= $row['total'];
endforeach;                            
/* <!-- /LISTAR REGISTROS INGRESADOS AL DETALLE -->   */
echo '   
                                <form method="post" action="">
                                <tr>
                                    <th colspan="3" style="text-align: right;">Total:</th>
                                    <th align="left">$ '.number_format( $sum, 0, ',', '.' ).'</th>
                                    <th>
                                        <button class="btn btn-success" type="submit" name="p" value="Save">Guardar Borrador</button>
                                        <input type="hidden" name="total" value="'.$sum.'">
                                        <input type="hidden" name="id" value="'.$id.'">
                                        <input type="hidden" name="solicita" value="'.$nombreSolicita['nombre'].'">
                                    </th>
                                    <th>
                                        <button class="btn btn-primary" type="submit" name="p" value="Close">Finalizar</button>
                                    </th>
                                </tr>
                                </form>
                            </table>
                        </div>';
else:
    echo '              <div  class="bg-danger">
                            <h4><br>
                                <p class="text-center">
                                    <strong>No hay productos agregados a esta solicitad</strong>
                                </p><br>
                            </h4>
                        </div> 
                    </div>';
endif; ?>
                </div>
            </div>
        </div>
    </div><!-- PANEL CON TABLA DE INGRESOS -->
</div>


<?php require_once '../../layouts/templateDown.php'; ?>