<?php require_once '../../layouts/templateUp.php'; ?>

<div class="row">
    <div class="col-md-6">
        <form action="" method="post">
            <h3>Lista de Solicitudes de Compra</h3>
        </form>
    </div>
    <div class="col-md-6"></div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-bordered table-condensed table-hover table-striped" id="DataTable">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Fecha</th>
                        <th>Forma de Pago</th>
                        <th>N&deg; Cotizaci&oacute;n</th>
                        <th>Proveedor</th>
                        <th>Total</th>
                        <th>Solicita</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>

<?php         
foreach( $SelectByKey as $value ):
    echo '          <tr>
                        <td>'.$value['id'].'</td>
                        <td>'.date( 'd-m-Y', strtotime( $value['fecha'] ) ).'</td>
                        <td>'.$value['formaPago'].'</td>
                        <td>'.$value['cotizacion'].'</td>'; 

    $nombreProveedor =  $clase->ShowById( 'proveedores', $value['proveedor'] );                    
    echo '              <td>'.$nombreProveedor['nombre'].'</td>
                        <td>$ '.number_format( $value['total'], 0, ',', '.' ).'</td>';

    $nombreUsuario  =  $clase->ShowById( 'usuarios', $value['solicita'] ); 
    $disabled = ( ( $value['finalizada'] == 1 && $_SESSION['id'] > 11 ) ) ? 'disabled' : '';
    echo '             <td>'.$nombreUsuario['nombre'].'</td>
                        <td>
                          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal'.$value['id'].'">
                            <i class="fa fa-info-circle"> Detalles</i>
                          </button>
                        </td>
                  <form action="" method="post">
                        <td>
                            <button type="submit" name="p" value="EditEnc"  class="btn btn-success" '.$disabled.'><i class="fa fa-edit"> Editar</i></button>
                            <input type="hidden" name="id" value="'.$value['id'].'">  ';                
if( $_SESSION['id'] <= 11 ):                        
echo '
                            <input type="hidden" name="finalizada" value="'.$value['finalizada'].'">
                            <input type="hidden" name="nombreUsuario" value="'.$nombreUsuario['nombre'].'"> 
                        </td>
                        <td>
                          <button type="submit" name="p" value="Autorizar"  class="btn btn-danger"><i class="fa fa-thumbs-up"> Autorizar</i></button>';
 
endif;
echo '                       </td>
                        </form>
                    </tr> 
                    
                    
                    
                    <!-- Modal -->
                    <div class="modal fade bs-example-modal-lg" id="myModal'.$value['id'].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                          <div class="modal-header bg-orange">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Informacion Solicitud de Compra N&deg;'.$value['id'].'</h4>
                          </div>
                          <div class="modal-body">
        
                            <!-- DATOS DE CONTACTO DE LA EMPRESA  -->
                            <div class="row">
                              <div class="col-md-2"><strong>Medida</strong></div>
                              <div class="col-md-4"><strong>Descripci&oacute;n</strong></div>
                              <div class="col-md-2"><strong>Cantidad</strong></div>
                              <div class="col-md-2"><strong>Valor</strong></div>
                              <div class="col-md-2"><strong>Total</strong></div>
                            </div>';

$SelectByKey  = $clase->SelectByKey( $class.'_det', 'idEnc', $value['id'], '' );
if( $SelectByKey->num_rows > 0 ):
  $total = 0;
foreach( $SelectByKey as $row ):
  echo '                    <div class="row">                
                              <div class="col-md-2">'.$row['medida'].'</div>';

    $ShowById = $clase->ShowById( 'materiales_proveedores', $row['descripcion'] );
    echo '                    <div class="col-md-4">'.$ShowById['nombre'].'</div>  
                              <div class="col-md-2">'.$row['cantidad'].'</div>
                              <div class="col-md-2">$ '.number_format( $row['valor'], 0, ',', '.' ).'</div>
                              <div class="col-md-2">$ '.number_format( ( $row['cantidad'] * $row['valor'] ), 0, ',', '.' ).'</div>       
                            </div><br><br>';
   $total+=$row['cantidad'] * $row['valor'];                            
endforeach; 
else:
  echo '                    <div class="row">
                              <div class="col-md-12"><br>
                                <p class="bg-red"><strong>No existen registros para esta solicitad</strong></p>
                              </div>
                            </div>';
endif;                          
        
echo '
        
                          </div>
                          <div class="modal-footer">
                            <div class="col-md-6">
                              <h3><strong>Total Solicitud $ '.number_format( $total, 0, ',', '.' ).'</strong></h3>
                            </div>
                            <div class="col-md-6">
                              <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
                            </div>                            
                          </div>
                        </div>
                      </div>
                    </div>';
endforeach; ?>                    
                </tbody>
            </table>
        </div>
    </div>
</div>









<?php require_once '../../layouts/templateDown.php'; ?>