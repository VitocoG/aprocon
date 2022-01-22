<?php require_once '../../layouts/templateUp.php'; ?>

<div class="row">
    <div class="col-md-6">
        <form action="" method="post">
            <h3>Lista de Materiales de Proveedores
                <button type="submit" name="p" value="Create" class="btn btn-success"><i class="fa fa-plus-circle"> Nuevo</i></button>
            </h3>
        </form>
    </div>
    <div class="col-md-6"></div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-bordered table-condensed table-hover table-striped" id="DataTable">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Categor&iacute;a</th>
                        <th>Comparativo de Precios</th>
                    </tr>
                </thead>
                <tbody>

<?php
$materiales = $clase->ListarMaterialesIndex();
foreach ( $materiales as $value ):
echo '                
                    <tr>
                        <td>'.$value['id'].'</td>
                        <td>'.$value['nombre'].'</td>
                        <td>'.$value['categoria'].'</td>
                        <td>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal'.$value['id'].'">
                            <i class="fa fa-dollar"></i>
                        </button>
                        </td>
                    </tr>
                    
                    
                    <!-- Modal -->
                    <div class="modal fade" id="myModal'.$value['id'].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                            </div>
                            <div class="row">
                                <div class="col-md-4"></div>
                                <div class="col-md-4"></div>
                                <div class="col-md-4"></div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                        </div>
                        </div>
                    </div>
                    </div>
                    ';
endforeach;
?>
                </tbody>
            </table>
        </div>
    </div>
</div>

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