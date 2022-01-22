<?php require_once '../../layouts/templateUp.php'; 
$inicio =   ( isset( $_POST['inicio'] ) )   ?   $_POST['inicio']    : date( '2018-01-01' );
$termino =   ( isset( $_POST['termino'] ) )   ?   $_POST['termino']    : date( 'Y-m-d' );
$anios  =   ( isset( $_POST['anios'] ) )    ?   $_POST['anios'] :   date( 'Y' )
?>

<div class="row">
    <div class="col-md-6">
        <h3>Informe de Saldos de cada Usuario</h3>
    </div>
    <div class="col-md-6"></div>
</div>

<div class="row">
    <div class="col-md-12">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#fechas" aria-controls="fechas" role="tab" data-toggle="tab">Resumen por rango de Fechas</a></li>
            <li role="presentation"><a href="#resumen" aria-controls="resumen" role="tab" data-toggle="tab">Resumen por Meses</a></li>
            <li role="presentation"><a href="#anios" aria-controls="anios" role="tab" data-toggle="tab">Resumen por A&ntilde;os</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">

            <!-------------------------    Resumen por rango de Fechas ------------------------->
            <div role="tabpanel" class="tab-pane fade in active" id="fechas">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-warning">
                            <div class="panel-heading"><h4>Resumen por rango de Fechas</h4></div>
                            <div class="panel-body">

                                <!-- DIV CON CALENDARIOS -->
                                <div class="row">
                                    <form action="" method="post">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="date" name="inicio" class="form-control" value="<?php echo $inicio ?>">
                                            </div>
                                           
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <input type="date" name="termino" class="form-control" value="<?php echo $termino ?>">
                                                <span class="input-group-btn">
                                                    <button type="submit" class="btn btn-success" name="p" value="usuarios">Buscar</button>
                                                </span>
                                            </div>
                                        </div>
                                    </form>
                                </div><!-- FIN DIV CON CALENDARIOS -->

                                <!-- DIV CON CONTENIDO DINAMICO -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-condensed table-hover table-striped">
                                                <tr>
                                                    <th>Usuario</th>
                                                    <th>Dep&oacute;sitos</th>
                                                    <th>Gastos</th>
                                                    <th>Diferencia</th>
                                                </tr>
<?php
$usuarios  =   $model->ShowAll( 'usuarios', 'ORDER BY estado, localidad, nombre, estado' );
foreach( $usuarios as $row ):
    $Deposito   =   $clase->DepositosRangoUsuarios( $row['id'], $inicio, $termino );
    $Gastos     =   $clase->GastosRangoUsuarios( $row['id'], $inicio, $termino );

echo '                                          <tr>
                                                    <td>'.$row['nombre'].'</td>
                                                    <td>$ '.number_format( $Deposito, 0, ",", "." ).'</td>
                                                    <td>$ '.number_format( $Gastos, 0, ",", "." ).'</td>
                                                    <td>$ '.number_format( ( $Deposito - $Gastos ), 0, ",", "." ).'</td>
                                                </tr>';
    $dep    =   $dep + $Deposito;
    $gas    =   $gas + $Gastos;
endforeach;
echo '
                                                <tr>
                                                    <th>Totales</th>
                                                    <th>$ '.number_format( $dep, 0, ",", "." ).'</th>
                                                    <th>$ '.number_format( $gas, 0, ",", "." ).'</th>
                                                    <th>$ '.number_format( ( $dep + $gas ), 0, ",", "." ).'</th>
                                                </tr>  ';                                               
?>                                                                                              
                                            </table>
                                        </div>
                                    </div>
                                </div><!-- FIN DIV CON CONTENIDO DINAMICO -->
                                
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-------------------------    FIN Resumen por rango de Fechas ------------------------->


            <!-------------------------    Resumen por rango de Meses ------------------------->
            <div role="tabpanel" class="tab-pane fade" id="resumen">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-warning">
                            <div class="panel-heading"><h4>Resumen por Meses</h4></div>
                            <div class="panel-body">

                                <!--    DIV CON MESES Y AÑOS    -->
                                <form action="" method="post">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <select name="anios" class="form-control">
<?php   
for( $i = date( 'Y' ); $i > 2017; $i-- ):
    $selected   =   ( $i == $anios ) ? 'selected' : '';
echo '                                             
                                                <option value="'.$i.'" '.$selected.'>'.$i.'</option>';
endfor; ?>                                                
                                            </select>
                                            <span class="input-group-btn">
                                                <button type="submit" class="btn btn-success"  name="p" value="usuarios">Buscar</button>
                                            </span>                                            
                                        </div><!--  form-group  -->
                                    </div><!--    col-md-6    -->
                                    <div class="col-md-6"></div><!--    col-md-6    -->
                                </div><!--  row -->
                                </form>
                                <!--    FIN DIV CON MESES Y AÑOS    -->

                                <!--    CONTENIDO DINAMICO  -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover table-condensed table-bordered">
                                                <tr>
                                                    <th>Localidad</th>
                                                    <th></th>
<?php
$meses  =   $model->ShowAll( 'meses', '' );
foreach ($meses as $value ):
    echo '                                          <th>'.$value['nombre'].'</th>';
endforeach;
?>
                                                </tr> 
<?php
$usuarios    =   $model->ShowAll( 'usuarios' , 'ORDER BY estado, localidad, nombre' );
foreach ( $usuarios as $key ):
    echo '                                      <tr>
                                                    <th rowspan="2" class="bg-success">'.$key['nombre'].'</th>
                                                    <th class="bg-info">Dep&oacute;sitos</th>';
foreach ( $meses as $value ):
    $mes    =   ( $value['id'] < 10 )   ?   '0'.$value['id']    :   $value['id'];
echo    '                                           <td class="bg-info">$ '.number_format( $clase->DepositosMesesUsuario( $key['id'], $anios, $mes), 0, ",", "." ).'</td>';
endforeach;
echo '                                              </tr>
                                                <tr>
                                                    <th class="bg-danger">Gastos</th>';
foreach ( $meses as $value ):
    $mes    =   ( $value['id'] < 10 )   ?   '0'.$value['id']    :   $value['id'];
echo    '                                           <td class="bg-danger">$ '.number_format( $clase->GastosMesesUsuario( $key['id'], $anios, $mes), 0, ",", "." ).'</td>';
endforeach;
echo    '                                       </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                </tr>';
endforeach;
?>
                                            </table>
                                        </div><!--  table-responsive    -->
                                    </div><!--  col-md-12   -->
                                </div><!--  row -->
                                <!--    FIN CONTENIDO DINAMICO  -->

                            </div><!-- panel-body -->
                        </div><!-- panel -->
                    </div><!-- col-md-12 -->
                </div><!-- row  -->
            </div><!-------------------------    FIN Resumen por rango de Meses ------------------------->

            <!-------------------------    Resumen por rango de Años ------------------------->
            <div role="tabpanel" class="tab-pane fade" id="anios">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-warning">
                            <div class="panel-heading"><h4>Resumen por A&ntilde;os</h4></div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table-bordered table-condensed table-hover table-striped">
                                                <tr>
                                                    <th>Localidad</th>
                                                    <th></th>
<?php

for($i = 2018; $i <= date( 'Y' ); $i++ ):
    echo '                                          <th>'.$i.'</th>';
endfor;
?>
                                                </tr> 
<?php
$usuarios    =   $model->ShowAll( 'usuarios' , 'ORDER BY estado, localidad, nombre' );
foreach ( $usuarios as $key ):
    echo '                                      <tr>
                                                    <th rowspan="2" class="bg-success">'.$key['nombre'].'</th>
                                                    <th class="bg-info">Dep&oacute;sitos</th>';
for($i = 2018; $i <= date( 'Y' ); $i++ ):
echo    '                                           <td class="bg-info">$ '.number_format( $clase->DepositosAniosUsuario( $key['id'], $i ), 0, ",", "." ).'</td>';
endfor;
echo '                                              </tr>
                                                <tr>
                                                    <th class="bg-danger">Gastos</th>';
for($i = 2018; $i <= date( 'Y' ); $i++ ):
echo    '                                           <td class="bg-danger">$ '.number_format( $clase->GastosAniosUsuario( $key['id'], $i ), 0, ",", "." ).'</td>';
endfor;
echo    '                                       </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                </tr>';
endforeach;
?>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- panel-body -->
                        </div><!-- panel -->
                    </div><!-- col-md-12 -->
                </div>
            </div>
            <!-------------------------    FIN Resumen por rango de Años ------------------------->

        </div>
    </div>
</div>

<?php require_once '../../layouts/templateDown.php'; ?>