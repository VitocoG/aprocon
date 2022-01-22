<?php require_once '../../layouts/templateUp.php'; ?>


<h3>Nueva Hora Extra de <?php echo $ShowById['nombre'].' '.$ShowById['apellido'] ?></h3><br><br>


<?php

$datos = '

<div class="row">
    <form action="" method="post" autocomplete="off">
        <div class="col-md-4">
            <div class="form-group">
                <input type="number" name="ods" placeholder="N&deg; ODS" class="form-control" required autofocus min="1222" max="999999999" title="Maximo 9 Numeros">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <input type="text" name="motivo" placeholder="Detalle del Trabajo realizado" class="form-control" required>
                <input type="hidden" name="trabajador" value="'.$trabajador.'">
                <input type="hidden" name="localidad" value="'.$localidad.'">
                <input type="hidden" name="estado" value="1">
            </div>
        </div>
        <div class="col-md-4">
            <div class="input-group">
                <select name="jefe_terreno" class="form-control" required>';


foreach( $listarJefesDeTerreno as $row ):
    if( $_SESSION['perfil'] == 3 ):
        $selected = ( $_SESSION['id'] == $row['id'] ) ? 'selected' : '';
    endif;
    $datos.= '          <option value="'.$row['id'].'" '.$selected.'>'.$row['usuario'].'</option>';
endforeach;

$datos.= '
                </select>
                <span class="input-group-btn">
                    <button class="btn btn-warning" type="submit" name="p" value="SaveAdmin">
                        <i class="fa fa-plus-square"></i>
                    </button>
                </span>
            </div>
        </div>
    </form>
</div>';

if ( $_SESSION['perfil'] == 1 ):
    echo $datos;
elseif( $total_horas > 90 || $validarTrabajador['activo'] == '1' ):
    if ( $total_horas > 90):
        echo '<div class="col-md-12 bg-danger"><h3><strong>El trabajador supera las 90 horas extras durante este Mes. Solicite autorizaci&oacute;n a martaalmonacid@aprocon.cl para generar mas Horas para este Trabajador</strong></h3></div>
';
    endif;
    if ( $validarTrabajador['activo'] == '1' ):
        echo' <div class="col-md-12 bg-danger"><h3><strong>El trabajador se encuentra realizando Horas Extras';
    else:
        '<p></p>';
    endif;
    echo '<div class="col-md-12"><h3><strong>Cierre esta ventana para continuar</strong></h3></div>';
else:
    echo $datos;
endif;
 require_once '../../layouts/templateDown.php'; ?>