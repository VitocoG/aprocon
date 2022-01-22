<?php require_once '../../layouts/templateup.php' ;
$nombreBodega   =   "desde ".$_SESSION['nombreBodega'];  
?>

<div class="row">
    <div class="col-md-8">
        <form action="" method="post">
        <h3>Lista de Traspasos <?php echo $nombreBodega ?>
            <button type="submit" class="btn btn-success" name="p" value="create_enc"><i class="fa fa-plus-circle"></i></button>
        </h3>
        </form>
    </div>
    <div class="col-md-4"></div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover ta" id="DataTable">
                <tr>
                    <th>ID</th>
                    <th>FECHA</th>
                    <th>DESTINO</th>
                    <th>TOTAL</th>
                    <th>DETALLES</th>
                    <th></th>
                    <th></th>
                </tr>

<?php

foreach ( $listar as $value ):
echo '                
                <tr>
                    <td>'.$value['id'].'</td>
                    <td>'.$value['fecha'].'</td>
                    <td>'.$value['bodega'].' '.$value['localidad'].'</td>
                    <td>$ '.number_format( $value['total'],0, ',', '.' ) .'</td>
                    <form action="" method="post">
                    <td><button type="submit" name="p" value="details" class="btn btn-primary"><i class="fa fa-info-circle"></i></button></td>
                    <td><button type="submit" name="p" value="edit" class="btn btn-success"><i class="fa fa-edit"></i></button></td>
                    <td><button type="submit" name="p" value="delete" class="btn btn-danger"><i class="fa fa-trash"></i></button></td>
                    <input type="hidden" name="destino" value="'.$value['destino'].'">
                    <input type="hidden" name="id_enc" value="'.$value['id'].'">
                    </form>
                </tr>';
endforeach;
?>
                
            </table>
        </div>
    </div>
</div>


<!-- jQuery 2.1.4 -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap.min.js"></script>
<!-- Bootstrap 3.3.5 -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.16/js/bootstrap-select.min.js"></script>
<!-- AdminLTE App -->
<script src="../../public/js/app.min.js"></script> 
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> 



    <script type="text/javascript" class="init">
	$(document).ready(function() {
        $('#DataTable').DataTable( {
            "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"},
            responsive: true
        } );
    } );
	</script>




<?php require_once '../../layouts/footer.php';
require_once '../../layouts/fin.php';  ?>