<?php require_once '../../layouts/templateUp.php' ?>

<!-- ROW  -->
<div class="row">
    <!-- col -->
    <div class="col-md-6">
        <!-- form -->
        <form action="" method="post">
           <h3>
            Lista de Materiales
                <button type="submit" class="btn btn-success" name="p" value="Create">
                    <i class="fa fa-plus-circle"> Nuevo</i>
                </button> 
           </h3>
        </form>
        <!-- /form -->
    </div>
    <!-- /col -->
    <!-- col -->
    <div class="col-md-6"></div>
    <!-- /col -->
</div>
<!-- /ROW  -->

<!-- row -->
<div class="row">
    <!-- col -->
    <div class="col-md-12"><?php echo $CrearExito ?>
        <!-- table-responsive  -->
        <div class="table-responsive">
            <!-- table -->
            <table class="table table-bordered table-condensed table-hover table-responsive" id="DataTable">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Categor&iacute;a</th>
                        <th>Comprar Precio</th>
                        <th>Editar</th>
                    </tr>
                </thead>
                <tbody>

<!-- aqui recorremos el array para listar todos los materiales -->
<?php  
foreach ( $ShowAll as $key ):
echo '             
                <tr>
                    <td>'.$key['id'].'</td>
                    <td>'.$key['nombre'].'</td>
                    <td>'.$key['categoria'].'</td>
                    <td>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal'.$key['id'].'">
                            <i class="fa fa-dollar"></i>
                        </button>
                    </td>

                    <td>
                        <form action="" method="post">
                            <button type="submit" name="p" value="Edit" class="btn btn-success">
                                <i class="fa fa-edit"></i>
                            </button>
                            <input type="hidden" name="idMaterial" value="'.$key['id'].'">
                        </form>
                    </td>
                </tr>

                <!-- Modal -->
                    <div class="modal fade" id="myModal'.$key['id'].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header bg-orange">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Comparativo de Precios</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4"><strong>Material</strong></div>
                                <div class="col-md-4"><strong>Proveedor</strong></div>
                                <div class="col-md-4"><strong>Valor Unitario</strong></div>
                            </div>';
    $ListarModal = $clase->ListarModal( $key['id'] );
    foreach( $ListarModal as $value ):
    echo                   '<div class="row">
                                <div class="col-md-4">'.$value['material'].'</div>
                                <div class="col-md-4">'.$value['proveedor'].'</div>
                                <div class="col-md-4">$ '.number_format( $value['valor'], 0, ',', '.' ).'</div>
                            </div>';
    endforeach;                        

echo '                  </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                        </div>
                        </div>
                    </div>
                    </div>
                    ';
endforeach; ?>
<!-- fin recorrido del array -->                
                </tbody>
            </table>
            <!-- /table -->
        </div>
        <!-- /table-responsive  -->
    </div>
    <!-- /col -->
</div>
<!-- /row -->


<script type="text/javascript" class="init">
	$(document).ready(function() {
        $('#DataTable').DataTable( {
            "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"},
            responsive: true
        } );
    } );
</script>

<?php require_once '../../layouts/templateDown.php' ?>