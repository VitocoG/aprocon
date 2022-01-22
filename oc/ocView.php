<?php require_once '../../layouts/templateUp.php'; ?>

<div class="row">
    <div class="col-md-12">
        <h3>&Oacute;rdenes de Compra</h3>
    </div>
</div>


<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-bordered table-condensed table-hover table-striped" id="DataTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Fecha</th>
                        <th>Autoriza</th>
                        <th>Solicita</th>
                        <th>Proveedor</th>
                        <th>Total</th>
                        <th>PDF</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>

<?php foreach( $mostrarOC as $value ):
echo '              <tr>
                        <td>'.$value['id'].'</td>
                        <td>'.date( 'd-m-Y', strtotime( $value['fecha'] ) ).'</td>';
    $ShowById   =   $clase->ShowById( 'usuarios', $value['autoriza'] );
    echo'               <td>'.$ShowById['nombre'].'</td>';
    echo'               <td>'.$value['solicita'].'</td>
                        <td>'.$value['proveedor'].'</td>
                        <td>$ '.number_format( $value['total'], 0, ',', '.').'</td>
                        <td>
                          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal'.$value['id'].'">
                            <i class="fa fa-info-circle"> Detalles</i>
                          </button>
                        </td>
                        <td>
                            <form action="" method="post">
                                <button type="submit" name="p" value="pdf" class="btn btn-danger">
                                    <i class="fa fa-file-pdf-o"></i>
                                </button>
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
                                                <h4 class="modal-title" id="myModalLabel">Informacion &Oacute;rden de Compra N&deg;'.$value['id'].'</h4>
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
                    
                    $SelectByKey  = $clase->SelectByKey( 'compras_det', 'idEnc', $value['compra'], '' );
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