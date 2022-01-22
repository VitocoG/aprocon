<?php require_once '../../layouts/templateUp.php';
?>

<h3>Horas Extras en Curso</h3><br><br>

<div class="row">
    <div class="col-md-12">

<?php
if( $listarHorasActivas->num_rows > 0 ):
$tabla = '
        <div class="table-responsive">
            <table class="table table-bordered table-condensed table-hover table-striped">
                <tr>
                    <th>Id</th>
                    <th>Trabajador</th>
                    <th>Inicio</th>
                    <th>Jefe Terreno</th>
                    <th>Localidad</th>
                    <th>Finalizar</th>
                </tr>';


foreach ( $listarHorasActivas as $value ):
$tabla.='                
                <tr>
                    <td>'.$value['id'].'</td>
                    <td>'.$value['nombre'].' '.$value['apellido'].'</td>
                    <td>'.$value['fecha_inicio'].'</td>
                    <td>'.$value['jefe_terreno'].'</td>
                    <td>'.$value['localidad'].'</td>
                    <td>
                        <form action="" method="post">
                            <button type="submit" class="btn btn-warning" name="p" value="Stop">
                                <i class="fa fa-stop"></i>
                            </button>
                            <input type="hidden" name="id" value="'.$value['id'].'">
                            <input type="hidden" name="fecha_inicio" value="'.$value['fecha_inicio'].'">
                            <input type="hidden" name="trabajador" value="'.$value['trabajadoresId'].'">
                        </form>
                    </td>
                </tr>';
endforeach; 
$tabla.='

            </table>
        </div>'; 
else:
$tabla = '<div class="bg-success"><h4><strong>No existen Horas Extras Activas</strong></h4></div>';
endif;
echo $tabla;?>
    </div>
</div>

<?php require_once '../../layouts/templateDown.php' ?>