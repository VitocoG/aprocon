<?php 
require_once '../../layouts/templateUp.php';


?>

<div class="row">
    <div class="col-md-8">
<?php
    echo '
        <h3>Detalle de Horas Extras de '.$trabajadores['nombre'].' '.$trabajadores['apellido'].'</h3>';
?>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped table-condensed">
                <tr>
                    <th>ODS</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha T&eacute;rmino</th>
                    <th>Total Horas</th>
                    <th>Motivo</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
<?php
$horaExtra  =   $clase->ListarDetalle( $trabajador, $mes, $anio );
foreach ($horaExtra as $key ):
    $suma+=$key['total_horas'];
    $inicio =   date( 'd-m-Y H:i', strtotime( $key['fecha_inicio'] ) );
    $termino=   date( 'd-m-Y H:i', strtotime( $key['fecha_termino'] ) );

echo '
                <tr>
                    <td>'.$key['ods'].'</td>
                    <td>'.$inicio.'</td>
                    <td>'.$termino.'</td>
                    <td>'.$key['total_horas'].'</td>
                    <td>'.$key['motivo'].'</td>';

    echo '
                <form action="" method="post">
                    <td>
                        <button type="submit" name="p" value="edit" class=" btn btn-success"><i class="fa fa-edit"></i></button>
                    </td>
                    <td>
                        <button type="submit" name="p" value="delete" class=" btn btn-danger"><i class="fa fa-trash"></i></button>
                        <input type="hidden" name="id" value="'.$key['id'].'">
                        <input type="hidden" name="trabajador" value="'.$trabajador.'">
                        <input type="hidden" name="mes" value="'.$_POST['mes'].'">
                        <input type="hidden" name="anio" value="'.$_POST['anio'].'">
                    </td>
                </form>';

echo '
                </tr>';
endforeach;
?>
            </table>
            
        </div>
    </div>
</div>

<?php
require_once '../../layouts/templateDown.php';
?>