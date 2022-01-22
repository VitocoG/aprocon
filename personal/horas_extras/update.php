<?php 
require_once '../../layouts/templateUp.php';

$hora   =   $clase->ShowById( $class, $_POST['id'] );
  $ods            =   $hora['ods'];
  $motivo         =   $hora['motivo'];
  $jefeTerreno    =   $hora['jefe_terreno'];
  $trabajador     =   $hora['trabajador'];
  $totalHoras     =   $hora['total_horas'];

  $fechaInicio    =   $hora['fecha_inicio'];
  $inicio         =   explode( " ", $fechaInicio);

  $fechaTermino   =   $hora['fecha_termino'];
  $termino        =   explode( " ", $fechaTermino);
?>



<!--Contenido-->
<div class="row">
  <div class="col-md-6">
    <h3>Actualizar Hora Extra N&deg;<?php echo $_POST['id'] ?></h3>
    <br>
  </div>
</div>

<form action="" method="post" accept-charset="utf-8" autocomplete="off">
  <div class="row">
    <div class="col-md-3">
      <div class="form-group">
        <label for="ods">ODS</label>
        <input type="number" name="ods" class="form-control" value="<?php echo $ods ?>" autofocus>
        <input type="hidden" name="id" value="<?php echo $id ?>">
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label for="fecha_inicio">Fecha Inicio</label>
        <input type="datetime-local" name="fecha_inicio" id="fecha_inicio" onkeydown="TotalHoras()" class="form-control" value="<?php echo $inicio[0].'T'.$inicio[1] ?>">
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label for="fecha_termino">Fecha de T&eacute;rmino</label>
        <input type="datetime-local" name="fecha_termino" id="fecha_termino" onkeydown="TotalHoras()"  class="form-control" value="<?php echo $termino[0].'T'.$termino[1] ?>">
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label for="total_horas">Total de Horas</label>
        <input type="text" name="total_horas" class="form-control" id="total_horas" value="<?php echo $totalHoras ?>">
      </div>
    </div>
  </div>


  <div class="row">
    <div class="col-md-4">
      <div class="form-group">
        <label for="motivo">Motivo</label>
        <input type="text" name="motivo" class="form-control" value="<?php echo $motivo ?>">
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label for="trabajador">Trabajador</label>
        <select name="trabajador" class="form-control">
          <option value="">Seleccione Trabajador</option>
<?php
$MostrarLocalidad  = $clase->ShowById( 'usuarios', $jefeTerreno );
  $localidad  = $MostrarLocalidad['localidad'];

$MostrarTrabajadores  = $clase->SelectByKey( 'trabajadores', 'localidad', $localidad, ' AND activo = 0 ORDER BY apellido' );
foreach( $MostrarTrabajadores as $value ):
  $selected = ( $value['id'] == $trabajador ) ? 'selected' : '';
  echo '
        <option value="'.$value['id'].'" '.$selected.'>'.$value['apellido'].' '.$value['nombre'].'</option>';
endforeach;
?>
        </select>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label for="jefe_terreno">Jefe de Terreno</label>
        <select name="jefe_terreno" class="form-control">
          <option value="">Seleccione Jefe de Terreno</option>
<?php
$MostrarJefeTerreno = $clase->SelectByKey( 'usuarios', 'localidad', $localidad, ' AND perfil = 3 AND estado = "ACTIVO"  ORDER BY nombre' );
foreach( $MostrarJefeTerreno as $valor ):
  $selected = ( $valor['id'] == $jefeTerreno )? 'selected' : '';
  echo '   <option value="'.$valor['id'].'" '.$selected.'>'.$valor['nombre'].'</option>';
endforeach;
?>
        </select>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <button type="submit" class="btn btn-primary" name="p" value="update">Guardar</button>
        <button type="reset" class="btn btn-danger">Cancelar</button>
        <input type="hidden" name="id" value="<?php echo $_POST['id'] ?>">
      </div>
    </div>
  </div>
  
</form>
<!--Fin Contenido-->  

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

<?php 
require_once '../../layouts/templateDown.php';

?>