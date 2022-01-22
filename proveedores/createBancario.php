<?php

require_once '../../layouts/templateUp.php';
?>


<!--Contenido-->
<div class="row">
  <div class="col-md-6">
    <h3>Nuevo Proveedor</h3>
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
    echo '                      <option value="'.$listarBancos['id'].'">'.$listarBancos['nombre'].'</option>';
endforeach;
?>

                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>Tipo de Cuenta</label>
                            <input type="text" name="cuenta" class="form-control" >
                        </div>
                        <div class="col-md-3">
                            <label>N&uacute;mero de Cuenta</label>
                            <input type="number" name="numeroCuenta" class="form-control">
                            <input type="hidden" name="id" value="<?php echo $id ?>">
                        </div>
                        <div class="col-md-3">
                            <label>&Oacute;rden de Compra</label>
                            <select name="oc" class="form-control">
                                <option value="1">SI</option>
                                <option value="0">NO</option>
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