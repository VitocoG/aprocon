<?php require_once '../../layouts/templateUp.php'; ?>

<div class="row">
    <div class="col-md-8">
        <form action="" method="post">
            <h3>Ingresos a Bodega Central <?php echo $_SESSION['bodegaNombre'] ?>
                <button type="submit" name="p" value="create_enc" class="btn btn-success">Nuevo</button>
            </h3>
        </form>
    </div>
    <div class="col-md-4"></div>
</div>

<!--    TABLA CON LISTA DE INGRESOS   -->
<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-bordered table-condensed table-hover table-striped">
<?php
$materiales =   $clase->listarEncabezadosBodega( $_SESSION['bodegaId'] );
if( $materiales->num_rows > 0 ):
    echo '      <tr>
                    <th>Id</th>
                    <th>Bodega</th>
                    <th>Fecha</th>
                    <th>Total</th>
                    <th>N&deg; Factura</th>
                    <th></th>
                    <th></th>
                </tr>';
    foreach( $materiales as $value ):
        echo'   <tr>
                    <td>'.$value['id'].'</td>
                    <td>'.$value['almacen'].' '.$value['localidad'].'</td>
                    <td>'.date( 'd-m-Y', strtotime( $value['fecha'] ) ).'</td>
                    <td>$ '.number_format( $value['total'], 0, ',', '.' ).'</td>
                    <td>'.$value['num_factura'].'</td>
                    <form method="post" action="" autocomplete="off">
                    <td>
                        <button type="submit" name="p" value="details" class="btn btn-success"><i class="fa fa-info-circle"></i></button>
                    </td>
                    <td>
                        <button type="submit" name="p" value="edit_enc" class="btn btn-success"><i class="fa fa-edit"></i></button>
                        <input type="hidden" name="id_enc" value="'.$value['id'].'">
                    </td>
                    </form>
                    <td>
                    </td>
                </tr>';
    endforeach;
else:
    echo'       <tr>
                    <th class="bg-success">NO EXISTEN INGRESOS A ESTA BODEGA</th>
                </tr>';
endif;
?>  
                
                
            </table>
        </div>
    </div>
</div>

<?php require_once '../../layouts/templateDown.php'; ?>