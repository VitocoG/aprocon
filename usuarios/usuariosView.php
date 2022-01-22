<?php
require_once '../../layouts/templateUp.php';
?>

<div class="row">
    <div class="col-lg-8">
        <form action="" method="post">
        <h3>Listado de Usuarios 
            <button type="submit" name="p" value="create" class="btn btn-success">Nuevo</button>
        </h3>
        </form>
    </div><!-- /.col -->
</div><!-- /.row -->

<!-- @include('compras.proveedores.search') -->
<div class="row">
    <div class="col-xs-12">
        <div class="table-responsive">
        <table class="table table-striped table-bordered table-condensed table-hover" id="DataTable">
            <thead>
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Localidad</th>
                <th>Perfil</th>
                <th>Estado</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>

<?php 
$mostrar 	=	$clase->ListarTodosLosUsuarios();
foreach ( $mostrar as $row ):
	$estado = ( $row['estado'] == 'INACTIVO' ) ? 'class="bg-danger"' : ''; 
    echo '
          <tr>
            <td '.$estado.'>'.$row['id'].'</td>
            <td '.$estado.'>'.$row['nombre'].'</td>
            <td '.$estado.'>'.$row['email'].'</td>
            <td '.$estado.'>'.$row['localidad'].'</td>
            <td '.$estado.'>'.$row['perfil'].'</td>
            <td '.$estado.'>'.$row['estado'].'</td>
            <td>
                <form action="" method="post">
                    <button type="submit" class="btn btn-info" name="p" value="edit">Editar</button>
                    <button type="submit" class="btn btn-danger" name="p" value="permission">Permisos</button>
                    <input type="hidden" name="id" value="'.$row['id'].'">
                </form>
            </td> 
          </tr>';

 endforeach; ?>
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




<?php 
require_once '../../layouts/templateDown.php';  ?>