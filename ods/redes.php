<?php 
    require_once '../../config/core.class.php';
    require_once 'ods.class.php';
    $ods = new ods;
    $core   =   new core;
    session_start();

    $usuarios  = $core->Permisos( 'ods', 'permisos', $_SESSION['id'] );
    foreach($usuarios as $row)
    {
        $dep = $row['ods'];
    }
    
    if( $dep == 1 )
    {
        require_once '../../layouts/blade/head.php';
        require_once '../../layouts/blade/header.php';
        require_once '../../layouts/blade/aside.php';
        require_once '../../layouts/blade/body_up.php';

  $fecha1     = $_REQUEST['inicio'];
  $fecha2     = $_REQUEST['termino'];     
  $condicion  =   ( $fecha1 == $fecha2 ) ? (" horaInicio LIKE '".$fecha2."%' ") : ("horaInicio BETWEEN '".$fecha1."' AND '".$fecha2."'");
?>

<!--Contenido-->  
<div class="row">
  <div class="col-lg-8">
    <h3>Listado de ODS Mantenimiento de Redes</h3>
  </div>
</div>

<div class="row">
  <div class="col-xs-12">
    <div class="table-responsive">
      <table class="table table-striped table-bordered table-condensed table-hover">
        <thead>
          <tr>
            <th>C&oacute;digo</th>
            <th>Hora de Inicio</th>
            <th>Hora de T&eacute;rmino</th>
            <th>Jefe de Terreno</th>
            <th>Minutos para Cierre</th>
            <th>Cumple Contratista</th>
            <th>Cumple Ito</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
 <?php 

 $mostrar = $ods->mostrar_ods( $condicion, 1);
 foreach ($mostrar as $valores)
 {
    $prioridad_orden        =   $valores['prioridad_orden'];

 

    // 	#####	VERIFICAR TIPO DE ORDEN Y OBTENER MINUTOS
    if( $prioridad_orden > 0 )
    {
        $prioridad  =   $core->ShowById( 'prioridad_orden', $prioridad_orden );
        foreach( $prioridad as $row)
        {
          $minutos_ods =   $row['minutos'];
        }
    }
    else
    {
        $minutos_ods    =   15840;
    }
    $minutos_ods;

      // ##### VERIFICAR SI CUMPLE EL CONTRATISTA  #####
      $cierreContratista   =  ( $valores['horaTermino'] == '1111-11-11 00:00:00' ) ? date('Y-m-d H:i:s') : $valores['horaTermino'];
      $minutosCierre    = strtotime( $cierreContratista ) - strtotime( $valores['horaInicio'] );
      $cierre           = intval($minutosCierre/60);
      $diferencia       = ( $cierre > $minutos_ods ) ? ( $minutos_ods  - $cierre ) : ( ( $cierre - $minutos_ods ) *-1) ;
      $contratista  = ( $valores['cumplimiento_contratista'] == 1 ) ? '<td class="bg-success">CUMPLE</td>' :  '<td class="bg-danger">NO CUMPLE</td>';
      

  
   // ##### VERIFICAR SI CUMPLE EL ITO  #####
   $ito  = ( $valores['cumplimiento_ito'] == 1 ) ? '<td class="bg-success">CUMPLE</td>' :  '<td class="bg-danger">NO CUMPLE</td>';
   
  
  ?>
          <tr>
            <td><?php echo $valores['codigo'] ?></td>
            <td><?php echo $valores['horaInicio'] ?></td>
            <td><?php echo $valores['horaTermino'] ?></td>
            <td><?php echo $valores['jefeTerreno'] ?></td>
            <td><?php echo $diferencia ?></td>
            <?php echo $contratista ?>
            <?php echo $ito ?>
            <td>
    
            <?php
    $update = ( $valores['cierre']=="1111-11-11 00:00:00" ) ? '<a href="update.php?id='.$valores['id'].'"><button class="btn btn-info">Editar</button></a><a href="ods.php?p=eliminar&id='.$valores['id'].'"><button class="btn btn-danger">Eliminar</button></a>' : '<a href="details.php?id='.$valores['id'].'" class="btn btn-warning" target="_blank">Detalles</a>';
    echo $update;
    ?>
    <!-- <a href="details.php?id=<?php echo $valores['id'] ?>" class="btn btn-warning" target="_blank">Detalles</a> -->
            </td> 
          </tr>
<?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>



<?php 
    require_once '../../layouts/blade/body_down.php';
    require_once '../../layouts/blade/footer.php';
    require_once '../../layouts/blade/jquery.php';
    require_once '../../layouts/blade/fin.php';
        
    
}
else
{
    header( 'Location:../../' );
}
?>
