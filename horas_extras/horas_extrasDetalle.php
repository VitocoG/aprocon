<?php require_once '../../layouts/templateUp.php'; ?>

<h3>Detalles de Horas Extras de <?php echo $nombreTrabajador['nombre'].' '.$nombreTrabajador['apellido'] ?></h3>

<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-bordered table-condensed table-hover table-striped" id="DataTable">
                <thead>
                    <tr>
                        <th>ODS</th>
                        <th>Fecha Inicio</th>
                        <th>Fecha T&eacute;rmino</th>
                        <th>Total Horas</th>
                        <th>Motivo</th>
                        <th>Jefe Terreno</th>
                        <th>PDF</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>

<?php 
$sum = 0;
foreach ( $listarDetalle as $key ):
echo'               
                    <tr>
                        <td>'.$key['ods'].'</td>
                        <td>'.$key['fecha_inicio'].'</td>
                        <td>'.$key['fecha_termino'].'</td>
                        <td>'.$key['total_horas'].'</td>
                        <td>'.$key['motivo'].'</td>
                        <td>'.$key['jefe_terreno'].'</td>
                        <form action="" method="post">
                        <td>
                            <button type="submit" name="p" value="Pdf" class="btn btn-danger">
                                <i class="fa fa-file-pdf-o"></i>
                            </button>
                            <input type="hidden" name="id" value="'.$key['id'].'">
                            <input type="hidden" name="trabajador" value="'.$nombreTrabajador['id'].'">
                            <input type="hidden" name="localidad" value="'.$nombreTrabajador['localidad'].'">
                            <input type="hidden" name="mes" value="'.$mes.'">
                            <input type="hidden" name="anio" value="'.$anio.'">
                        </td>';


if( $_SESSION['perfil'] == 1):
    echo '           
                        <td>
                            <button type="submit" name="p" value="Edit" class="btn btn-success">
                                <i class="fa fa-edit"></i>
                            </button>
                        </td>
             <td>
                            <button type="submit" name="p" value="Delete" class="btn btn-danger">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>';
else:
    echo '           
                        <td></td>
                        <td></td>';
endif;
echo'
                        </form>
                    </tr>';

$sum+= $key['total_horas'];                    
endforeach; ?>

                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3" style="text-align: right;"><h3>Total</h3></th>
                        <th><h3><?php echo $sum ?></h3></th>
                        <th colspan="3"></th>
                    </tr>
                </tfoot>
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