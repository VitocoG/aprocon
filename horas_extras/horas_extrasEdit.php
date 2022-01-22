<?php require_once '../../layouts/templateUp.php' ; 

$fechaInicio    =   $ShowById['fecha_inicio'];
$inicio         =   explode( " ", $fechaInicio);

$fechaTermino   =   $ShowById['fecha_termino'];
$termino        =   explode( " ", $fechaTermino);

?>

<h3>Editar Hora Extra N&deg; <?php echo $ShowById['id'] ?></h3><br><br>


<?php
$datos = '
<form action="" method="post" autocomplete="off">
<!--    FILA CON LOS DATOS DE ODS - INICIO - TERMINO Y TOTAL DE HORAS   -->
<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label>ODS</label>
            <input type="number" name="ods" value="'.$ShowById['ods'].'" class="form-control" autofocus>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>Inicio</label>
            <input type="datetime-local" name="fecha_inicio" id="fecha_inicio" value="'.$inicio[0].'T'.$inicio[1].'" class="form-control" onkeydown="TotalHoras()">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>T&eacute;rmino</label>
            <input type="datetime-local" name="fecha_termino" id="fecha_termino" value="'.$termino[0].'T'.$termino[1].'" class="form-control" onkeydown="TotalHoras()">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>Total</label>
            <input type="text" name="total_horas" id="total_horas" value="'.$ShowById['total_horas'].'" class="form-control">
        </div>
    </div>
</div>


<!--    FILA CON LOS DATOS DE MOTIVO - TRABAJADOR Y JEFE DE TERRENO   -->
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>Descripci&oacute;n del Trabajo</label>
            <input type="text" name="motivo" class="form-control" value="'.$ShowById['motivo'].'">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Trabajador</label>
            <select name="trabajador" class="form-control">';

foreach ( $SelectByKey as $key ):
    $selected = ( $key['id'] == $ShowById['trabajador'] ) ? 'selected' : '';
    $datos.= '  <option value="'.$key['id'].'" '.$selected.'>'.$key['apellido'].' '.$key['nombre'].'</option>';
endforeach;

$datos.= '            
            </select>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Autoriza</label>
            <select name="jefe_terreno" class="form-control">';

foreach ( $listarJefesDeTerreno as $key ):
    $selected = ( $key['id'] == $ShowById['jefe_terreno'] )    ? 'selected'    :   '';
    $datos.= '  <option value="'.$key['id'].'" '.$selected.'>'.$key['usuario'].'</option>';
endforeach;
            
$datos.= '            
            </select>
        </div>
    </div>
</div>

<!--    FILA CON BOTON DE GUARDAR CAMBIOS   -->
<div class="row">
    <div class="col-md-6">
        <button type="submit" name="p" value="Save" class="btn btn-primary">
            <i class="fa fa-save"> Guardar</i>
        </button>
        <input type="hidden" name="id" value="'.$ShowById['id'].'">
        <input type="hidden" name="mes" value="'.$mes.'">
        <input type="hidden" name="anio" value="'.$anio.'">
        <input type="hidden" name="trabajador" value="'.$ShowById['trabajador'].'">
        <input type="hidden" name="localidad" value="'.$localidad.'">
    </div>
</div>
</form>'; ?>

<?php
echo $datos;
?>


<script>
  function TotalHoras()
  {
    $("#fecha_inicio").keyup(
      function()
      {
        var FechaInicio   =   $("#fecha_inicio" ).val();
        var HoraInicio    =   $("#fecha_inicio" ).val();
        var inicio        =   new Date( FechaInicio.substr(0,10) + " " + HoraInicio.substr(11,15) );

        var FechaTermino  = $("#fecha_termino" ).val( );
        var HoraTermino   = $("#fecha_termino" ).val( );
        var termino       = new Date( FechaTermino.substr(0,10) + " " + HoraTermino.substr(11,15) );
        var total         = ( ( termino - inicio ) / 60000 ) / 60 ;
        
        $("#total_horas").val( total.toFixed( 2 ) ) ;
        console.log( total );
      }
    );

    $("#fecha_termino").keyup(
      function()
      {
        var FechaInicio   =   $("#fecha_inicio" ).val();
        var HoraInicio    =   $("#fecha_inicio" ).val();
        var inicio        =   new Date( FechaInicio.substr(0,10) + " " + HoraInicio.substr(11,15) );

        var FechaTermino  = $("#fecha_termino" ).val( );
        var HoraTermino   = $("#fecha_termino" ).val( );
        var termino       = new Date( FechaTermino.substr(0,10) + " " + HoraTermino.substr(11,15) );
        var total         = ( ( termino - inicio ) / 60000 ) / 60 ;
        
        $("#total_horas").val( total.toFixed( 2 ) ) ;
        console.log( total );
      }
    );
  }
</script>


<?php require_once '../../layouts/templateDOwn.php' ; ?>