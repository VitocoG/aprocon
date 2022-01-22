<?php

require_once '../../layouts/templateUp.php';
?>


<!--Contenido-->
<div class="row">
  <div class="col-md-6">
    <h3>Editar Proveedor</h3>
  </div>
  <div class="col-md-6"></div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading bg-orange"><h4><strong>Datos Bancarios del Proveedor</strong></h4></div>
            <div class="panel-body">
                <form action="" method="post" autocomplete="off">
                    <div class="row">
                        <div class="col-md-3">
                            <label>Banco</label>
                            <select name="banco" class="form-control selectpicker" data-live-search="true" title="Seleccione Banco">
                            
<?php
$bancos     =   $model->ShowAll( 'bancos' , '');
foreach ($bancos as $listarBancos):
    $selected = ( $valor['banco'] == $listarBancos['id'] ) ? 'selected' : '';
    echo '                      <option value="'.$listarBancos['id'].'" '.$selected.'>'.$listarBancos['nombre'].'</option>';
endforeach;
?>

                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>Tipo de Cuenta</label>
                            <input type="text" name="cuenta" class="form-control" value="<?php echo $valor['cuenta'] ?>">
                        </div>
                        <div class="col-md-3">
                            <label>N&uacute;mero de Cuenta</label>
                            <input type="number" name="numeroCuenta" class="form-control" value="<?php echo $valor['numeroCuenta'] ?>">
                            <input type="hidden" name="id" value="<?php echo $id ?>">
                        </div>
                        <div class="col-md-3">
                            <label>&Oacute;rden de Compra</label>
                            <select name="oc" class="form-control">

<?php
for ($i=1; $i >= 0 ; $i--):
    $selected = ( $valor['oc'] == $i ) ? 'selected' : '';
    $label = ( $i == 0 ) ? 'NO' : 'SI';
    echo '                      <option value="'.$i.'" '.$selected.'>'.$label.'</option>                      
    ';
endfor;

?>
                            </select>
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="col-md-3">
                            <button type="submit" name="p" value="guardar" class="btn btn-success">
                            <i class="fa fa-forward"> Finalizar</i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<?php require_once '../../layouts/templateDown.php'; ?>