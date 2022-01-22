<?php require_once '../../layouts/templateUp.php'; ?>

<div class="row">
    <div class="col-md-6">
        <form action="" method="post" target="_blank">
            <h3>
                Lista de Horas Extras 
                <button type="submit" name="p" value="HorasActivas" class="btn btn-success">
                <i class="fa fa-clock-o"> Horas Activas</i>
                </button>
            </h3>
        </form>
    </div>    
    <div class="col-md-6"><br>
<?php if( $_SESSION['perfil'] == 3 ): ?>    
        <form action="" method="post" target="_blank">
            <button type="submit" name="p" value="JefeTerreno" class="btn btn-success">
                <i class="fa fa-user"> Horas por Fecha</i>
            </button>
            <input type="hidden" name="mes" value="<?php echo $mes ?>">
            <input type="hidden" name="anio" value="<?php echo $anio ?>">
        </form>
<?php endif; ?>        
    </div>
</div><br>

<div class="row">
    <form action="" method="post">
        <div class="col-md-4">
            <div class="form-group">
                <select name="localidad" class="form-control" autofocus>
                    <option value="0">Todas las Locallidades</option>

<?php
foreach ( $listarLocalidades as $value ):
    $selected   =   ( $localidad == $value['id'] )  ? 'selected' : '';
echo '                
                    <option value="'.$value['id'].'" '.$selected.'>'.$value['nombre'].'</option>';
endforeach; ?>     
     
                    </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <select name="mes" class="form-control">

<?php
foreach ( $listarMeses as $value ):
    $selected   =   ( $value['id'] == $mes )    ?   'selected'  : '';
    $meses        =   ( $value['id'] < 10 )       ?   '0'.$value['id'] : $value['id'];
echo '                
                    <option value="'.$meses.'" '.$selected.'>'.$value['nombre'].'</option>';
endforeach; ?>     
     
                    </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="input-group">
                <select name="anio" class="form-control">

<?php
for ( $i = date( 'Y' ); $i >= 2018  ; $i-- ):
echo '                
                    <option value="'.$i.'">'.$i.'</option>';
endfor;?>

                </select>
                <span class="input-group-btn">
                    <button class="btn btn-warning" type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </div>
    </form>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-bordered table-condensed table-hover table-striped" id="DataTable">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Trabajador</th>
                        <th>Total Horas</th>
                        <th>Localidad</th>
                        <th>Crear Hora Extra</th>
                        <th>Detalles</th>
                    </tr>
                </thead>
                <tbody>

<?php
$sum = 0;
foreach ( $listarTodosUsuarios as $value ):
echo '
                    <tr>
                        <td>'.$value['id'].'</td>
                        <td>'.$value['apellido'].' '.$value['nombre'].'</td>
                        <td>';
    
    $listarTotalHoras    =   $clase->listarTotalHoras( $mes, $anio, $value['id'] );  
        echo                number_format( $listarTotalHoras['total_horas'], 2, '.', ',' );
    echo '
                        </td>
                        <td>'.$value['localidad'].'</td>
                        <td>
                            <form action="" method="post" target="_blank">
                                <button type="submit" class="btn btn-success" name="p" value="CreateTrabajador">
                                    <i class="fa fa-plus-circle"></i>
                                </button>
                                <input type="hidden" name="trabajador" value="'.$value['id'].'">
                                <input type="hidden" name="localidad" value="'.$value['localidadId'].'">
                                <input type="hidden" name="total_horas" placeholder="hola" value="'.number_format( $listarTotalHoras['total_horas'], 2, '.', ',' ).'">
                            </form>
                        </td>
                        <td>
                        <form action="" method="post" target="_blank">
                            <button type="submit" class="btn btn-info" name="p" value="Detalle">
                                <i class="fa fa-info-circle"></i>
                            </button>
                            <input type="hidden" name="trabajador" value="'.$value['id'].'">
                            <input type="hidden" name="localidad" value="'.$value['localidadId'].'">
                            <input type="hidden" name="mes" value="'.$mes.'">
                            <input type="hidden" name="anio" value="'.$anio.'">
                        </form>
                    </td>
                    </tr>';
$sum+= $listarTotalHoras['total_horas'];
endforeach; ?>

                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="2">Total</th>
                        <th><?php echo $sum ?></th>
                        <th></th>
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