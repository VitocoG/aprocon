<?php require_once '../../layouts/templateUp.php'; ?>


<!--Contenido-->
<form action="" method="post">
<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">DATOS PERSONALES</h3>
  </div>
  <div class="panel-body">
    <div class="row">
        <div class="col-md-4 form-group">
            <label for="nombre">Nombres</label>
            <input type="text" name="nombre" class="form-control"  value="<?php echo $trabajador['nombre'] ?>" autofocus>
            <input type="hidden" name="id" value="<?php echo $id ?>">
        </div>
        <div class="col-md-4 form-group">
            <label for="apellido">Apellidos</label>
            <input type="text" name="apellido" class="form-control"  value="<?php echo $trabajador['apellido'] ?>">
        </div>
        <div class="col-md-2 form-group">
            <label for="rut">Rut</label>
            <input type="text" name="rut" id="rut" class="form-control"  value="<?php echo $trabajador['rut'] ?>">
        </div>
        <div class="col-md-2 form-group">
            <label for="fecha">F. Nacimiento</label>
            <input type="date" name="fecha" class="form-control"  value="<?php echo $trabajador['fecha'] ?>">
        </div>
    </div>
    
    
    <div class="row">
        <div class="col-md-4 form-group">
            <label for="domicilio">Domicilio</label>
            <input type="text" name="domicilio" class="form-control"  value="<?php echo $trabajador['domicilio'] ?>">
        </div>
        <div class="col-md-2 form-group">
            <label for="localidad">Localidad</label>
            <select name="localidad" class="form-control" >
                <option value="">Seleccione Localidad</option>
<?php
foreach( $localidad as $value )
{
    $selected   = ( $trabajador['localidad'] == $value['id'] ) ? 'selected':'';
    echo '
                <option value="'.$value['id'].'" '.$selected.'>'.$value['nombre'].'</option>
    ';
}
?>
            </select>
        </div>
        <div class="col-md-2 form-group">
            <label for="ecivil">Estado Civil</label>
            <select name="ecivil" class="form-control">
<?php
foreach( $ecivil2 as $value )
{
    $selected   = ( $trabajador['ecivil'] == $value['id'] ) ? 'selected':'';
    echo '
                <option value="'.$value['id'].'" '.$selected.'>'.$value['nombre'].'</option>
    ';
}
?>
            </select>
        </div>
        <div class="col-md-2 form-group">
            <label for="telefono">Telefono</label>
            <input type="number" name="telefono" class="form-control"  value="<?php echo $trabajador['telefono'] ?>">
        </div>
        <div class="col-md-2 form-group">
            <label for="estudios">Estudios</label>
            <select name="estudios" class="form-control">
                <option value="">Seleccione Nivel de Estudios</option>

<?php
foreach( $estudios2 as $fila )
{
    $selected   = ( $trabajador['estudios'] == $fila['id'] ) ? 'selected':'';
    echo '
                <option value="'.$fila['id'].'" '.$selected.'>'.$fila['nombre'].'</option>
    ';
}
?>
            </select>
        </div>
    </div>
    
    
    <div class="row">
        <div class="col-md-2 form-group">
            <label for="talla">Talla Vestuario</label>
            <select name="talla" class="form-control">
<?php
foreach( $talla2 as $value )
{
    $selected   = ( $trabajador['talla'] == $row['id'] ) ? 'selected':'';
    echo '
                <option value="'.$value['id'].'" '.$selected.'>'.$value['nombre'].'</option>
    ';
}
?>
            </select>
        </div>
        <div class="col-md-2 form-group">
            <label for="calzado">Calzado</label>
            <select name="calzado" class="form-control">
<?php
foreach( $calzado2 as $value )
{
    $selected   = ( $trabajador['calzado'] == $value['id'] ) ? 'selected':'';
    echo '
                <option value="'.$value['id'].'" '.$selected.'>'.$value['nombre'].'</option>
    ';
}
?>
            </select>
        </div>
        <div class="col-md-2 form-group">
            <label for="alergia">Alergias</label>
            <select name="alergia" class="form-control">
<?php
echo            '<option value="'.$trabajador['alergia'].'" selected>'.$trabajador['alergia'].'</option>';
?>
                <option value="SI">SI</option>
                <option value="NO">NO</option>
            </select>
        </div>
        <div class="col-md-2 form-group">
            <label for="licencia">Licencia Conducir</label>
            <input type="text" name="licencia" class="form-control"  value="<?php echo $trabajador['licencia'] ?>">
        </div>
        <div class="col-md-4 form-group">
            <label for="observaciones" rows="10">Observaciones</label>
<?php
echo '<textarea class="form-control">'.$trabajador['observaciones'].'</textarea>';
?>
        </div>
    </div>
    
  </div>
</div>


<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">DATOS LABORALES</h3>
  </div>
  <div class="panel-body">
    <div class="row">
        <div class="col-md-2 form-group">
            <label for="cargo">Cargo</label>
            <select name="cargo" class="form-control">
                <option value="">Seleccione Cargo</option>

<?php
foreach( $cargos as $value )
{
    $selected   = ( $trabajador['cargo'] == $value['id'] ) ? 'selected':'';
    echo '
                <option value="'.$value['id'].'" '.$selected.'>'.$value['nombre'].'</option>
    ';
}
?>
            </select>
        </div>
        <div class="col-md-2 form-group">
            <label for="ingreso">Fecha de Ingreso</label>
            <input type="date" name="ingreso" class="form-control" value="<?php echo $trabajador['ingreso'] ?>">
        </div>
        <div class="col-md-2 form-group">
            <label for="retiro">Fecha de Retiro</label>
            <input type="date" name="retiro" class="form-control" value="<?php echo $trabajador['retiro'] ?>">
        </div>
        <div class="col-md-3 form-group">
            <label for="supervisor">Supervisor</label>
            <select name="supervisor" class="form-control">
                <option value="">Seleccione Supervisor</option>
                
<?php
foreach( $supervisor2 as $value )
{
    $selected   = ( $trabajador['supervisor'] == $value['id'] ) ? 'selected':'';
    echo '
                <option value="'.$value['id'].'" '.$selected.'>'.$value['nombre'].'</option>
    ';
}
?>

            </select>
        </div>
        <div class="col-md-3 form-group">
            <label for="brigada">Brigada</label>
            <select name="brigada" class="form-control">
                <option value="">Seleccione Brigada</option>
                
<?php
foreach( $brigada2 as $value )
{
    $selected   = ( $trabajador['brigada'] == $value['id'] ) ? 'selected':'';
    echo '
                <option value="'.$value['id'].'" '.$selected.'>'.$value['nombre'].'</option>
    ';
}
?>

            </select>
        </div>
    </div>
  </div>
</div>

<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">DATOS PREVISIONALES</h3>
  </div>
  <div class="panel-body">
    <div class="row">
        <div class="col-md-4 form-group">
            <label for="afp">AFP</label>
            <select name="afp" class="form-control">
<?php
foreach( $afp2 as $value )
{
    $selected   = ( $trabajador['afp'] == $value['id'] ) ? 'selected':'';
    echo '
                <option value="'.$value['id'].'" '.$selected.'>'.$value['nombre'].'</option>
    ';
}
?>
            </select>
        </div>
        <div class="col-md-4 form-group">
            <label for="salud">Sistema de Salud</label>
            <select name="salud" class="form-control">
<?php
foreach( $salud2 as $value )
{
    $selected   = ( $trabajador['salud'] == $value['id'] ) ? 'selected':'';
    echo '
                <option value="'.$value['id'].'" '.$selected.'>'.$value['nombre'].'</option>
    ';
}
?>
            </select>
        </div>
        <div class="col-md-4 form-group">
            <label for="cargas">N&uacute;mero de Cargas</label>
            <input type="number" name="cargas" class="form-control" min="0" max="7" value="<?php echo $trabajador['cargas'] ?>">
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <label for="accidenteNombre">En caso de Accidente avisar a</label>
            <input type="text" name="accidenteNombre" class="form-control" value="<?php echo $trabajador['accidenteNombre'] ?>">
        </div>
        <div class="col-md-4 form-group">
            <label for="accidenteNumero">Tel&eacute;fono</label>
            <input type="number" name="accidenteNumero" class="form-control" value="<?php echo $trabajador['accidenteNumero'] ?>">
        </div>
        <div class="col-md-4 form-group">
            <label for="activo">Estado</label>
            <select name="activo" class="form-control">
<?php
for( $i=0; $i<2; $i++ )
{
    $selected   =   ( $trabajador['activo'] == $i )? ' selected' : '';
    $valor      =   ( $i == 0 ) ? 'ACTIVO' : 'INACTIVO';
    echo '
                <option value="'.$i.'" '.$selected.'>'.$valor.'</option>
    ';
}
?>
            </select>
        </div>
    </div>
  </div>
</div>

    <div class="row col-md-6 form-group">
        <button type="submit" class="btn btn-primary" name="p" value="update">Guardar</button>
    </div>
</form>


<!--Fin Contenido-->  





<script>
  $("#rut").inputmask({
	mask: "9[9.999.999]-[9|K|k]",
});
</script>
<!--Fin Contenido-->  



<?php require_once '../../layouts/templateDown.php'; ?>