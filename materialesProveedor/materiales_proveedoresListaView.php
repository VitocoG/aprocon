<?php require_once '../../layouts/templateUp.php';  ?>

<div class="row">
    <div class="col-md-10">
        <form action="" method="post">
            <h3>Materiales de <strong><?php echo $listaProveedor['nombre'] ?></strong>
                <button type="submit" name="p" value="Create" class="btn btn-success">
                    <i class="fa fa-plus-circle"> Nuevo Material</i>
                </button>
                <input type="hidden" name="proveedor" value="<?php echo $proveedor ?>">
            </h3>
        </form>
    </div>
    <div class="col-md-2"></div>
</div>


<div class="row">
    <div class="col-md-12">

<?php if( $listarMaterialesProveedor->num_rows > 0 ):
$tabla = '
        <div class="table-responsive">
            <table class="table table-bordered table-condensed table-hover table-striped" id="DataTable">
                <thead>
                    <tr>
                        <th>Material</th>
                        <th>Valor</th>
                    </tr>
                </thead>
                <tbody>';


foreach( $listarMaterialesProveedor as $row ):  
$tabla.=              
                    '<tr>
                        <td>'.$row['material'].'</td>
                        <td>$ '.number_format( $row['valor'], 0, ',', '.' ).'</td>
                    </tr>';
endforeach; 
$tabla.=
                '</tbody>
            </table>
        </div>'; 
else:
$tabla = '<div class="bg-danger"><h3>Este Proveedor no tiene Materiales.</h3></div>'; 
endif;
echo $tabla;
?>
        
    </div>
</div>

<?php require_once '../../layouts/templateDown.php'; ?>