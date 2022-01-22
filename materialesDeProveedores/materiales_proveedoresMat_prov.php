<?php require_once '../../layouts/templateUp.php'; ?>

<!-- row de encabezado -->
<div class="row">
    <div class="col-md-10">
        <form action="" method="post">
            <h3>
                Materiales de <?php echo $ShowById['nombre'] ?>
                <button type="submit" name="p" value="CreateMatProv" class="btn btn-success">
                    <i class="fa fa-plus-circle"> Nuevo</i>
                </button>
                <input type="hidden" name="proveedor" value="<?php echo $ShowById['id'] ?>">
            </h3>
        </form>
    </div>
    <div class="col-md-2"></div>
</div>


<div class="row">
    <div class="col-md-12"><?php echo $CrearExito ?></div>
</div>
<!-- -------------------------- -->

<!-- row de la tabla de materiales -->
<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-striped table-hover table-condensed table-bordered" id="DataTable">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Material</th>
                        <th>Proveedor</th>
                        <th>Valor</th>
                        <th>Editar</th>
                    </tr>
                </thead>
                <tbody>
                
<?php
foreach( $ListarMatProv as $row ):
     echo       '<tr>
                    <td>'.$row['id'].'</td>
                    <td>'.$row['material'].'</td>
                    <td>'.$row['proveedor'].'</td>
                    <td>$ '.number_format( $row['valor'], 0, ',', '.') .'</td>
                    <td>
                        <form action="" method="post">
                            <button type="submit" name="p" value="EditMatProv" class="btn btn-success">
                                <i class="fa fa-edit"></i>
                            </button>
                            <input type="hidden" name="id" value="'.$row['id'].'">
                        </form>
                    </td>
                </tr>';
endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- ----------------------------- -->

<script type="text/javascript" class="init">
	$(document).ready(function() {
        $('#DataTable').DataTable( {
            "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"},
            responsive: true
        } );
    } );
</script>

<?php require_once '../../layouts/templateDown.php'; ?>