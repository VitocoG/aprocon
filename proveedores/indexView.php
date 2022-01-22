<?php require_once '../../layouts/templateUp.php'; ?>

<!--Contenido-->  
<div class="row">
  <div class="col-lg-8">
    <form action="" method="post">
      <h3>Listado de Proveedores <button class="btn btn-success" name="p" value="create"><i class="fa fa-plus-circle"> Nuevo</i></button></h3>
    </form>
  </div>
  <div class="col-md-4"></div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="table-responsive">
      <table class="table table-striped table-hover table-condensed table-bordered" id="DataTable">
        <thead>
          <tr>
            <th>Id</th>
            <th>Suministros</th>
            <th>Solicitud de Compra</th>
            <th>Raz&oacute;n Social</th>
            <th>Giro</th>
            <th>Localidades</th>
            <th>Ciudad</th>
            <th>&Oacute;rden de Compra</th>
            <th>Detalles</th>
            <th>Editar</th>
          </tr>
        </thead>
        <tbody>
        
<?php
# METODO PARA LISTAR LOS REGISTROS DE LA TABLA DEL INDEX
$ListarDatosInicio  = $model->ShowAll( $class, '' );
# RECORRE EL ARREGLO
foreach ($ListarDatosInicio as $value ):
  # SE ELIMINAN LOS GUIONES Y SE DIVIDE EL REGISTRO PARA GUARDAR CADA ELEMENTO EN UN ARREGLO
  $localidades = explode( ' ', $value['localidad'] );
  $mostrarCompra = ( $value['oc'] == 1 ) ? '<a href="../compras?proveedor='.$value['id'].'&p=Create" target="_blank" class="btn btn-danger"><i class="fa fa-cart-plus"></i></a>' : '';
  echo '          
            <tr>
              <td>'.$value['id'].'</td>
              <td><a href="../materialesProveedor?proveedor='.$value['id'].'" target="_blank" class="btn btn-info"><i class="fa fa-list-ul"></i></a></td>
              <td>'.$mostrarCompra.'</td>
              <td>'.$value['nombre'].'</td>
              <td>'.$value['giro'].'</td>
              <td>';
  # SE RECORRE EL NUEVO ARREGO DEPENDIENDO DE LA CANTIDAD DE REGISTROS QUE TENGA
  for ( $i=0; $i < count( $localidades ) ; $i++ ):
    # METODO PARA BUSCAR REGISTROS A TRAVES DEL ID
      $ListarLocalidades = $model->ShowById( 'localidades', $localidades[$i] );
      # SE RECORRE EL ARREGLO
      foreach ( $ListarLocalidades as $row ):
        # SE IMPRIME EL NOMBRE DE LA LOCALIDAD
        echo $row['nombre'].'   ';
      endforeach;
  endfor;

  $oc = ( $value['oc'] == 0 ) ? 'NO' : 'SI';
  echo'
              </td>
              <td>'.$value['ciudad'].'</td>
              <td>'.$oc.'</td>
              <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal'.$value['id'].'">
              <i class="fa fa-info-circle"></i>
              </button></td>
              <td>
                <form action="" method="post">
                  <button type="submit" name="p" value="edit"  class="btn btn-success"><i class="fa fa-edit"></i></button>
                  <input type="hidden" name="id" value="'.$value['id'].'">
                </form>
              </td>
            </tr>




            <!-- Modal -->
            <div class="modal fade bs-example-modal-lg" id="myModal'.$value['id'].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header bg-orange">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Datos de '.$value['nombre'].'</h4>
                  </div>
                  <div class="modal-body">

                    <!-- DATOS DE CONTACTO DE LA EMPRESA  -->
                    <div class="row">
                      <div class="col-md-3"><strong>Contacto</strong></div>
                      <div class="col-md-3"><strong>Rut Contacto</strong></div>
                      <div class="col-md-3"><strong>Tel&eacute;fono</strong></div>
                      <div class="col-md-3"><strong>Email</strong></div>
                    </div>
                    <div class="row">

         
                      <div class="col-md-3">'.$value['contacto'].'</div>
                      <div class="col-md-3">'.$value['rutContacto'].'</div>
                      <div class="col-md-3">'.$value['telefono'].'</div>
                      <div class="col-md-3">'.$value['email'].'</div>

                    </div><br><br>


                    <!-- DATOS BANCARIOS DE LA EMPRESA  -->
                    <div class="row">
                      <div class="col-md-4"><strong>Banco</strong></div>
                      <div class="col-md-4"><strong>Tipo Cuenta</strong></div>
                      <div class="col-md-4"><strong>Num. Cuenta</strong></div>
                    </div>
                    <div class="row">';
$bancos = $model->ShowById( 'bancos', $value['id'] );
foreach ($bancos as $valores):
  $mostrar = $valores['nombre'];
endforeach;
echo '
                    <div class="col-md-4">'.$mostrar.'</div>
                    <div class="col-md-4">'.$value['cuenta'].'</div>
                    <div class="col-md-4">'.$value['numeroCuenta'].'</div>
                    </div>

                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
                  </div>
                </div>
              </div>
            </div>';
endforeach;
?>
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