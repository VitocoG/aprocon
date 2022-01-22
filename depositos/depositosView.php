<?php 
$JefeTerreno    =   ( isset( $_POST['buscar'] ) )   ?   $_POST['buscar']    :   0;
$anio           =   ( isset( $_POST['anio'] ) )     ?   $_POST['anio']      :   date( 'Y' );
$mes            =   ( isset( $_POST['mes'] ) )      ?   $_POST['mes']       :   date( 'm' );

require_once '../../layouts/templateUp.php';
?>

    <!--Contenido-->
    <div class="row">
        <div class="col-lg-8">
            <form action="" method="post">
            <h3>Listado de Dep&oacute;sitos 
                <button type="submit" name="p" value="create" class="btn btn-success">Nuevo</button>
            </h3>
            </form>
        </div><!-- /.col -->
    </div><!-- /.row -->
    
    <div class="row">
        <form method="post" action="">
        <div class="col-md-4">
            <div class="form-group">
                <select name="buscar" class="form-control  selectpicker" required  data-show-subtext="none" data-live-search="true" autofocus>
                    <option value="0">Seleccione Jefe de Terreno</option>
                    
<?php
$usuarios   =   $model->ShowAll( 'usuarios', ' WHERE perfil !=4 AND estado = "ACTIVO" ORDER BY nombre' );
foreach ( $usuarios as $row ):
    $selected   =   ( $JefeTerreno == $row['id'] ) ?   'selected'    :   '';
echo '
                    <option value="'.$row['id'].'" '.$selected.'>'.$row['nombre'].'</option>';
endforeach; ?>
                </select>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <select name="mes" id="" class="form-control">
<?php
$meses  =   $model->ShowAll( 'meses' , '' );
foreach( $meses as $value ):
    $selected   =   ( $mes == $value['id'] )    ?   'selected'  :   '';
    echo '          <option value="'.$value['id'].'" '.$selected.'>'.$value['nombre'].'</option>';
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
    
    $selected   =   ( $anio == $i )    ?   'selected'  :   '';
    echo '          <option value="'.$i.'" '.$selected.'>'.$i.'</option>';
endfor;
?> 
                </select>
                <span class="input-group-btn">
                    <button class="btn btn-warning" type="submit">Buscar</button>
                </span>
            </div>
        </div>
        </form>
    </div><br>

    <div class="row">
        <div class="col-xs-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover" id="DataTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Monto</th>
                            <th>Detalle</th>
                            <th>Fecha</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>

    <?php 
    $query      =   $clase->ListarDepositosFiltro( $JefeTerreno, $mes, $anio );
                                
    foreach ($query as $fila) { ?>
                        <tr>
                            <td><?php echo $fila['id'] ?> </td>
                            <td><?php echo $fila['nombre'] ?> </td>
                            <td>
    <?php
    $numero = $fila['monto'];
    echo '$ '.number_format( $numero, '0',',', '.' ); ?>
                            </td>
                            <td><?php echo $fila['detalle'] ?></td>
                            <td><?php echo $fila['fecha'] ; ?></td>
                            <td>
                                <form action="" method="post">
                                    <button type="submit" name="p" value="edit" class="btn btn-info">Editar</button>
                                    <button type="submit" name="p" value="delete" class="btn btn-danger">Eliminar</button>
                                    <input type="hidden" name="id" value="<?php echo $fila['id'] ?>">
                                    <input type="hidden" name="buscar" value="<?php echo $JefeTerreno ?>">
                                    <input type="hidden" name="mes" value="<?php echo $mes ?>">
                                    <input type="hidden" name="anio" value="<?php echo $anio ?>">
                                </form>
                            </td> 
                        </tr>
    <?php } ?>
                    </tbody>
                </table>
            </div><!-- /.table-responsive -->
        </div><!-- /.col -->
    </div><!-- /.row -->





    <script type="text/javascript" class="init">
	$(document).ready(function() {
        $('#DataTable').DataTable( {
            "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"},
            responsive: true
        } );
    } );
	</script>




<?php require_once '../../layouts/templateDown.php';  ?>