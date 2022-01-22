<?php require_once '../../layouts/templateUp.php'; 
$buscar =   ( isset( $_POST['buscar'] ) ) ? $_POST['buscar'] : "0";
?>



<!--Contenido-->  
<div class="row">
    <div class="col-lg-8">
        <form action="" method="post">
        <h3>Listado de Trabajadores 
            <button type="submit" name="p" value="create" class="btn btn-success">Nuevo</button>
        </h3>
        </form>
    </div>
</div>



  
<div class="row">
    <div class="col-md-6">
        <form method="post" action="">
        <div class="input-group">
            <select name="buscar" class="form-control">
                <option value="0">Seleccione Localidad</option>

<?php                 
############    SI QUIEN INGRESA ES ADMINISTRADOR, VE ESTE TROZO DE CODIGO  ########## 
$localidad   =   ( $_SESSION['perfil']==1 )     ?   $clase->ShowAll( 'localidades', 'ORDER BY nombre' )
                                                :   $clase->SelectByKey( 'localidades', 'contrato', $_SESSION['contrato'], 'ORDER BY nombre' );
    foreach ( $localidad as $row ): 
        echo '  <option value="'.$row['id'].'">'.$row['nombre'].'</option>';
    endforeach; ?>

            </select>
            <span class="input-group-btn">
                <button class="btn btn-warning" type="submit">Buscar</button>
            </span>
        </div>
        </form>
    </div>
</div><br>


<div class="row">
    <div class="col-xs-12">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover" id="DataTable">
                <thead>
                    <tr>
                        <th>Localidad</th>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Estado</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
            <tbody>

<?php $trabajador =   $clase->ListarIndex( $buscar, $_SESSION['contrato'] );  
    foreach( $trabajador as $row ):
        $opciones   = ( $row['activo']=='0' ) ? "ACTIVO" : "INACTIVO"; 
        $estado     = ( $row['activo']=='0' ) ? " " : "class='bg-danger'"; 
        echo '        
                    
                    <tr>
                        <td '.$estado.'>'.$row['localidad'].'</td>
                        <td '.$estado.'>'.$row['id'].'</td>
                        <td '.$estado.'>'.$row['apellido'].' '.$row['nombre'].'</td>
                        <td '.$estado.'>'.$opciones.'</td>
                        <td '.$estado.'>
                        <form action="" method="post">
                            <button type="submit" name="p" value="edit" class="btn btn-info">Editar</button>';
                            $domicilio = ( $row['cargo'] == '0' || $row['activo'] == 1 ) ? '' : '<button type="submit" name="p" value="pdf" class="btn btn-danger">FICHA</button>'; 
        echo $domicilio.'
                            <input type="hidden" name="id" value="'.$row['id'].'">
                        </form>
                        </td>
                    </tr>';
    endforeach; ?>      
 
 
        </tbody>
      </table>
    </div>
  </div>
</div>

<script type="text/javascript" class="init">
	$(document).ready(function() {
        $('#DataTable').DataTable( {
            "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"},
            responsive: true
        } );
    } );
	</script>

<?php require_once '../../layouts/templateDown.php'; ?>