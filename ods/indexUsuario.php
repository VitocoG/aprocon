<?php 
    require_once '../../config/core.class.php';
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
?>

<!--Contenido-->  
<div class="row">
  <div class="col-lg-8">
    <h3>Listado de ODS <a href="create.php" ><button class="btn btn-success">Nuevo</button></a></h3>
  </div>
</div>

<div class="row">
  <div class="col-xs-12">
    <div class="table-responsive">
      <table class="table table-striped table-bordered table-condensed table-hover">
        <thead>
          <tr>
            <th>#</th>
            <th>C&oacute;digo</th>
            <th>Hora de Inicio</th>
            <th>Hora de T&eacute;rmino</th>
            <th>Descripci&oacute;n</th>
            <th>Ito</th>
            <th>Actividad</th>
            <th>Brigada</th>
            <th>Direcci&oacute;n</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
 <?php 
 require_once 'ods.class.php';
 $ods = new ods;
 $mostrar = $ods->mostrar_ods_usuario( $_SESSION['id'] );
 foreach ($mostrar as $valores)
 { ?>
          <tr>
            <td><?php echo $valores['id'] ?></td>
            <td><?php echo $valores['codigo'] ?></td>
            <td><?php echo $valores['horaInicio'] ?></td>
            <td><?php echo $valores['horaTermino'] ?></td>
            <td><?php echo $valores['descripcion'] ?></td>
            <td><?php echo $valores['ito'] ?></td>
            <td><?php echo $valores['actividad'] ?></td>
            <td><?php echo $valores['brigada'] ?></td>
            <td><?php echo $valores['direccion'] ?></td>
            <td>
    <?php
    $update = ( $valores['cierre']=="1111-11-11 00:00:00" ) 
    ?   '<a href="update.php?id='.$valores['id'].'">
            <button class="btn btn-info">Editar</button></a>
        <a href="ods.php?p=eliminar&id='.$valores['id'].'">
            <button class="btn btn-danger">Eliminar</button></a>' 
    :   '<a href="details.php?id='.$valores['id'].'" class="btn btn-warning" target="_blank">Detalles</a>';
    echo $update;
    ?>
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