<?php
require_once '../../layouts/templateUp.php';


$jefe_terreno   =   ( isset( $_POST['jefe_terreno'] ) )  ? $_POST['jefe_terreno'] : $_SESSION['id'];
?>

<div class="row">
    <div class="col-md-8">
        <form action="" method="post">
            <h3>Listado de Horas Extras 
                <button type="submit" class="btn btn-success"  name="p" value="new"> 
                    <i class="fa fa-plus" aria-hidden="true"></i>
                </button>
            </h3>
        </form>
    </div>
    <div class="col-md-4"></div>
</div>

<form action="" method="post">
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <select name="jefe_terreno" id="" class="form-control">
                <option value=""></option>
<?php
$JT =   $model->SelectByKey( 'usuarios', 'localidad', $_SESSION['localidad'], ' AND estado = "ACTIVO" ORDER BY nombre' );
foreach ($JT as $key ) :
    $selected   =   ( $_SESSION['id'] == $key['id'] ) ? 'selected' : '';
    echo '      <option value="'.$key['id'].'" '.$selected.'>'.$key['nombre'].'</option>';
endforeach;
?>
            </select>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <select name="mes" id="" class="form-control">
<?php
$meses  =   $model->ShowAll( 'meses', '');
foreach ($meses as $key ):
    $selected   = ( $mes == $key['id'] ) ? 'selected' : '';
    echo '      <option value="'.$key['id'].'" '.$selected.'>'.$key['nombre'].'</option>';
endforeach;
?>
            </select>
        </div>
    </div>
    <div class="col-md-4">
        <div class="input-group">
            <select name="anio" id="" class="form-control">
<?php
for( $i = date( 'Y' ); $i > 2017; $i-- ):
    $selected   =   ( $anio == $i ) ? 'selected' : '';
    echo '      <option value="'.$i.'" '.$selected.'>'.$i.'</option>';
endfor;
?>
            </select>
            <span class="input-group-btn">
                <button type="submit" class="btn btn-facebook">
                    <i class="fa fa-search" aria-hidden="true"></i>
                </button>
            </span>
        </div>
    </div>
</div>
</form>

<div class="row">
    <div class="col-md-12 table-responsive">
        <table class="table table-bordered table-condensed table-hover table-striped">
            <tr>
                <th>Trabajador</th>
                <th>Motivo</th>
                <th>ODS</th>
                <th>Inicio</th>
                <th>T&eacute;rmino</th>
                <th>Total</th>
                <th>Autoriza</th>
                <th>Opciones</th>
                <th>PDF</th>
            </tr>
<?php
$HE =   $clase->ListarHorasPorJefeTerreno( $jefe_terreno, $mes, $anio );
foreach ($HE as $key ):
    if( $key['estado'] == 1 ):
        $opciones   =
                    '<td>
                        <button type="submit" name="p" value="stop" class="btn btn-warning"> 
                            <i class="fa fa-stop-circle-o" aria-hidden="true"></i>
                        </button>
                        <input type="hidden" name="trabajador" value="'.$key['trabajador'].'">
                    </td>';
        $pdf        =  '';
    else:
        $opciones   =
                     '<td class="bg-danger">TURNO FINALIZADO</td>';
        $pdf        =   
                    '
                    <td>
                        <button type="submit" name="p" value="pdf" class="btn btn-danger"> 
                            <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                        </button>
                    </td>';
    endif;
echo '
            <tr>
                <td>'.$key['nombre'].' '.$key['apellido'].'</td>
                <td>'.$key['motivo'].'</td>
                <td>'.$key['ods'].'</td>
                <td>'.$key['fecha_inicio'].'</td>
                <td>'.$key['fecha_termino'].'</td>
                <td>'.$key['total_horas'].'</td>
                <td>'.$key['jefe_terreno'].'</td>
                <form action="" method="post">'
                .$opciones.
                $pdf.'
            
                        <input type="hidden" name="id" value="'.$key['id'].'">
                </form>
                </tr>';
endforeach;
?>
        </table>
    </div>
</div>

<?php
require_once '../../layouts/templateDown.php';