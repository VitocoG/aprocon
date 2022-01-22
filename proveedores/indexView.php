<?php

require_once ( '../../layouts/blade/head.php');
require_once ( '../../layouts/blade/header.php');
require_once ( '../../layouts/blade/aside.php');
require_once ( '../../layouts/blade/body_up.php');

?>

<!--Contenido-->  
<div class="row">
  <div class="col-lg-8">
    <form action="" method="post">
      <h3>Listado de Proveedores <button class="btn btn-success" name="p" value="create">Nuevo</button></h3>
    </form>
    
  </div>
</div>

<!-- @include('compras.proveedores.search') -->
<div class="row">
  <div class="col-xs-12">
    <div class="table-responsive">
      <table class="table table-striped table-bordered table-condensed table-hover">
        <thead>
          <tr>
            <th>#</th>
            <th>Nombre</th>
            <th>Rut</th>
            <th>Direccion</th>
            <th>Giro</th>
            <th>Tel&eacute;fono</th>
            <th>Email</th>
            <th>Ciudad</th>
            <th>Opciones</th>
          </tr>
        </thead>
        <tbody>

 <?php
$query = $model->ShowAll( $clase );
                                        
foreach( $query as $fila ): ?>
          <tr>
            <td><?php echo $fila['id'] ?> </td>
            <td><?php echo $fila['nombre'] ?> </td>
            <td><?php echo $fila['rut'] ?> </td>
            <td><?php echo $fila['direccion'] ?> </td>
            <td><?php echo $fila['giro'] ?> </td>
            <td><?php echo $fila['telefono'] ?> </td>
            <td><?php echo $fila['mail'] ?> </td>
            <td><?php echo $fila['ciudad'] ?> </td>
            <td>
              <form action="" method="post">
                <button class="btn btn-info"name="p" value="edit">Editar</button>
                <button class="btn btn-danger"name="p" value="delete">Eliminar</button>
                <input type="hidden" name="id" value="<?php echo $fila['id'] ?>">
              </form>
            </td> 
          </tr>
<?php 
endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php
require_once ( '../../layouts/blade/body_down.php');
require_once ( '../../layouts/blade/footer.php');
require_once ( '../../layouts/blade/jquery.php');
require_once ( '../../layouts/blade/fin.php');
?>