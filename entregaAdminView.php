<?php
require_once '../../layouts/templateUp.php';
?>

<div class="row">
    <div class="col-md-6">
        <form action="" method="post">
            <h2>Lista de EntregasSS
                <button class="btn btn-success" name="p" value="create">Nuevo</button>
            </h2>
        </form>
        
    </div>
    <div class="col-md-6"></div>
</div>

<div class="row">
    <div class="col-md-12">

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#abierta" aria-controls="abierta" role="tab" data-toggle="tab">Abiertas</a></li>
            <li role="presentation"><a href="#entregada" aria-controls="entregada" role="tab" data-toggle="tab">Entregadas</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">

            <div role="tabpanel" class="tab-pane fade in active" id="abierta">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-warning">
                            <div class="panel-heading"><h4>Abiertos</h4></div>
                            <div class="panel-body">
<?php                                
if( $mostrarAbiertas->num_rows > 0 ):
    echo'                               
                                <div class="table-responsive">
                                    <table class="table table-bordered table-condensed table-hover table-striped">
                                        <tr>
                                            <th>ID</th>
                                            <th>Fecha</th>
                                            <th>Entrega</th>
                                            <th>Localidad</th>
                                            <th>Recibe</th>
                                            <th>Concepto</th>
                                            <th>$ Total</th>
                                            <th>PDF</th>
                                            <th>EDITAR</th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>';


foreach ( $mostrarAbiertas as $key ):
    if( $key['tipo'] == 'u' ):
        $clases =   'usuarios';
        $recibe =   $clases.'.nombre';
    else:
        $clases =   'trabajadores';
        $recibe =   "CONCAT(".$clases.".apellido, ' ', ".$clases.".nombre )"; 
    endif;

    $quienEntrega = $clase->SelectByKey( 'usuarios', 'id', $key['entrega'], '' );
    foreach ($quienEntrega as $valor):
        $nombreEntrega = $valor['nombre'];
    endforeach;
                    
$Listar =   $clase->ListarAbiertas( $recibe, $clases,  $key['id'] );
    foreach ($Listar as $value ):
        echo '
                                        <tr>
                                            <td>'.$value['id'].'</td>
                                            <td>'.date( 'd-m-Y H:i', strtotime( $value['fecha'] ) ).'</td>
                                            <td>'.$nombreEntrega.'</td>
                                            <td>'.$value['localidad'].'</td>
                                            <td>'.$value['recibe'].'</td>
                                            <td>'.$value['concepto'].'</td>
                                            <td>$ '.number_format( $value['total'], 0,',', '.' ).'</td>
											
											<form method="post" action="" target="_blank">
                                            <td>
                                                <button type="submit" name="p" value="pdf" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i></button>
                                                <input type="hidden" name="idEnc" value="'.$value['id'].'">   
											</td>
                                            </form>
											
											<form method="post" action="">
                                            <td>
                                                <button type="submit" name="p" value="edit" class="btn btn-success"><i class="fa fa-edit"></i></button>
                                                <input type="hidden" name="idEnc" value="'.$value['id'].'">   
											</td>
                                            </form>                                            
											
                                            <form method="post" action=""  enctype="multipart/form-data">
                                            <td><input type="text" name="observaciones" placeholder="observaciones Generales" class="form-control"></td>
                                            <td>
												<input type="file" name="archivo" class="form-control" accept="application/pdf" required>
											</td>
                                            <td>
                                                <button type="submit" name="p" value="cerrar" class="btn btn-facebook">Subir Archivo</button>
                                                <input type="hidden" name="idEnc" value="'.$value['id'].'">    
                                            </td>
                                            </form>
                                        </tr>';   
                    
    endforeach;   
                        
endforeach;   
echo'
                                    </table>
                                </div><!-- table-responsive -->';
else:
    echo'
    <div class="alert alert-success"><h4>No hay Entregas Abiertas</h4></div>';
endif;
    ?>                                

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div role="tabpanel" class="tab-pane fade" id="entregada">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-warning">
                            <div class="panel-heading"><h4>Entregados</h4></div>
                            <div class="panel-body">
<?php
if( $mostrarEntregas->num_rows > 0 ):
    echo '
                                <div class="table-responsive">
                                    <table class="table table-bordered table-condensed table-hover table-striped">
                                        <tr>
                                            <th>ID</th>
                                            <th>Fecha</th>
                                            <th>Entrega</th>
                                            <th>Localidad</th>
                                            <th>Recibe</th>
                                            <th>Concepto</th>
                                            <th>Observaciones</th>
                                            <th>$ Total</th>
                                            <th>PDF</th>
                                            <th></th>
                                        </tr>';


foreach ( $mostrarEntregas as $key ):
    if( $key['tipo'] == 'u' ):
        $clases =   'usuarios';
        $lista = $clase->ShowById( $clases, $key['recibe'] );
        
        $recibe =   $lista['nombre'];
    else:
        $clases =   'trabajadores';
        $lista = $clase->ShowById( $clases, $key['recibe'] );
        
        $recibe =   $lista['apellido'].' '.$lista['nombre']; 
    endif;

        $entrega    =   $clase->ShowById( 'usuarios', $key['entrega'] );
        $quienEntrega = $entrega['nombre'];

        
                    
$Listar =   $clase->ListarEntrega( $clases,  $key['id'] );
    foreach ($Listar as $value ):
        echo '
                                            <tr>
                                                <td>'.$value['id'].'</td>
                                                <td>'.date( 'd-m-Y H:i', strtotime( $value['fecha'] ) ).'</td>
                                                <td>'.$quienEntrega.'</td>
                                                <td>'.$value['localidad'].'</td>
                                                <td>'.$recibe.'</td>
                                                <td>'.$value['concepto'].'</td>
                                                <td>'.$value['observaciones'].'</td>
                                                <td>$ '.number_format( $value['total'], 0,',', '.' ).'</td>
                                                <td><a href="'.$value['archivo'].'" class="btn btn-danger" target="_blank"><i class="fa fa-file-pdf-o"></i></td>
                                                <td></td>
                                            </tr>';   
                                                            
    endforeach;   
                                                                
endforeach; 
echo '
                                    </table>
                                </div><!-- table-responsive -->';
else:
echo '                          <div class="alert alert-success"><h4>No hay Registros</h4></div>' ;  
endif;                            
?>
                            </div><!-- panel-body -->
                        </div><!-- panel -->
                    </div><!-- col-md-12 -->
                </div>
            </div>

            
        </div>

    </div>
</div>


<?php
require_once '../../layouts/templateDown.php';
?>