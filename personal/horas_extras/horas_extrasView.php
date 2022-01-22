<?php require_once '../../layouts/templateUp.php';
?>



<!--Contenido-->  
<div class="row">
    <div class="col-lg-8">
        <br>
        <h3>Listado de Horas Extras </h3>
    </div><!-- /.col-lg-8 -->
</div><!-- /.row -->

<br>

<div class="row">
    <form method="post" action="">
        <div class="col-md-4">
            <div class="form-group">
                <select name="localidad" class="form-control" required>
                    <option value="">Seleccione una Localidad</option>
<?php

$localidad  =   ( $_SESSION['perfil'] == 1 )    ?   $model->ShowAll( 'localidades', 'ORDER BY nombre' ) 
                                                :   $model->SelectByKey( 'localidades', 'contrato', $_SESSION['contrato'], 'ORDER BY nombre' );
foreach ( $localidad as $key ):
    $selected   =   ( $loc == $key['id'] ) ? 'selected' : ''; 
    echo '          <option value="'.$key['id'].'" '.$selected.'>'.$key['nombre'].'</option>';
endforeach;
?>
                </select>
            </div>
        </div><!-- /.col-md-3 -->  
    
    
    
        <div class="col-md-4">
            <div class="form-group">
                <select name="mes" class="form-control" required>
                    <option value="">Seleccione un Mes</option>
                    <?php
$meses  =   $model->ShowAll( 'meses', '' );
foreach ( $meses as $key ):
    $selected   =   ( $mes == $key['id'] ) ? 'selected' : ''; 
    echo '          <option value="'.$key['id'].'" '.$selected.'>'.$key['nombre'].'</option>';
endforeach;
?>
                </select>
            </div>
        </div><!-- /.col-md-3 -->
    
    
        <div class="col-md-4">
            <div class="input-group">
                <select name="anio" class="form-control">
                    <option value="">Seleccione A&ntilde;o</option>
<?php
for( $i = date( 'Y' ); $i > 2017; $i-- ) :
    $selected   =   ( $anio == $i ) ? 'selected' : ''; 
    echo '          <option value="'.$i.'" '.$selected.'>'.$i.'</option>'; 
endfor;
?>
                </select>
                <span class="input-group-btn">
                    <button class="btn btn-warning" type="submit">Buscar</button>
                </span>
            </div>
        </div><!-- /.col-md-3 -->
    </form><!-- /.form -->
</div>    
        
<div class="row">
    <div class="col-md-6">
        <table class="table table-hover table-striped table-condensed">
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Cantidad Horas</th>
                <th>Opciones</th>
            </tr> 
<?php
$hora   =   $clase->ListarTodo( $loc, $mes, $anio );
foreach ($hora as $hr ):
    echo '
            <tr>
                <td>'.$hr['id'].'</td>
                <td>'.$hr['apellido'].' '.$hr['nombre'].'</td>
                <td>'.$hr['total_horas'].'</td>
                <td>
                <form action="" method="post" target="_blank">
                    <button type="submit" name="p" value="details" class="btn btn-primary" >Detalle</button> 
                    <input type="hidden" name="trabajador" value="'.$hr['id'].'">  
                    <input type="hidden" name="mes" value="'.$mes.'">
                    <input type="hidden" name="anio" value="'.$anio.'"> 
                </form>
                </td>
            </tr>';
endforeach;
?>
    

        </table>
    </div><!-- /.col-md-6 -->
</div><!-- /.row -->


<?php  
require_once '../../layouts/templateDown.php';
?>