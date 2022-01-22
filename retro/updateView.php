<?php
session_start();
if ($_SESSION['id'])
{
    require_once('../../layouts/blade/head.php');
    require_once('../../layouts/blade/header.php');
    require_once('../../layouts/blade/aside.php');
    require_once('../../layouts/blade/body_up.php');

    require_once( '../../config/model.class.php' );
    $model  =   new model;
    $mostrar = $model->ShowById('arriendo_retro', $id);
    foreach ($mostrar as $row)
    {
        $id                 =   $row['id'];
        $ods                =   $row['ods'];
        $localidad          =   strtoupper( $row['localidad'] );
        $total_horas        =   $row['total_horas'];
        $reembolso          =   $row['reembolso'];;
        $monto_pagado_ods   =   $row['monto_pagado_ods'];
        $proveedor          =   strtoupper( $row['proveedor'] );
        $pago_ods           =   $row['pago_ods'];
        $diferencia         =   $row['diferencia'];
        $reporte            =   (empty($row['report'])) ? '<input type="file" name="report" class="form-control">' : '<input type="text" name="report" class="form-control" readonly value="'.$row['report'].'">';
        $factura            =   (empty($row['factura'])) ? '<input type="file" name="factura" class="form-control">' : '<input type="text" name="factura" class="form-control" readonly value="'.$row['factura'].'">';
        $comprobante_pago   =   (empty($row['comprobante_pago'])) ? '<input type="file" name="comprobante_pago" class="form-control">' : '<input type="text" name="comprobante_pago" class="form-control" readonly value="'.$row['comprobante_pago'].'">';
        $numero_factura     =   $row['numero_factura'];
        $estado_factura     =   $row['estado_factura'];
         }
?>
   <!--Contenido-->
<div class="row">
  <div class="col-md-6">
    <h3>Arriendo de Retroexcavadoras</h3>
  </div>
</div>

<form action="" method="post" enctype="multipart/form-data">
<!--    ##########      FILA 1 DE 5     ##########      -->
<div class="row">
    <div class="col-md-4 form-group">
        <label for="fecha">Fecha</label> 
        <input type="date" name="fecha" class="form-control" value="<?php echo $row['fecha'] ?>" disabled>
    </div>
    <div class="col-md-4 form-group">
        <label for="ods">ODS</label> 
        <input type="number" name="ods" class="form-control" value="<?php echo $row['ods'] ?>">
        <input type="hidden" name="id" value="<?php echo $id ?>">
    </div>
    <div class="col-md-4 form-group">
        <label for="report">Report PDF</label> 
        <?php echo $reporte ?>
    </div>
</div>

<!--    ##########      FILA 2 DE 5     ##########      -->
<div class="row">
    <div class="col-md-4 form-group">
        <label for="localidad">Localidad</label> 
        <input type="text" name="localidad" class="form-control" value="<?php echo $row['localidad'] ?>">
    </div>
    <div class="col-md-4 form-group">
        <label for="total_horas">Total de Horas</label> 
        <input type="number" name="total_horas" id="total_horas" class="form-control" min="0" value="<?php echo $row['total_horas'] ?>" onKeyup="cambiarReembolso()">
    </div>
    <div class="col-md-4 form-group">
        <label for="reembolso">Reembolso</label> 
        <input type="number" name="reembolso" id="reembolso" class="form-control"  readonly value="<?php echo $row['reembolso'] ?>">
    </div>
</div>

<!--    ##########      FILA 3 DE 5     ##########      -->
<div class="row">
    <div class="col-md-4 form-group">
        <label for="monto_pagado_ods">Monto Pagado ODS</label> 
        <input type="number" name="monto_pagado_ods" id="monto_pagado_ods" class="form-control" min="0" value="<?php echo $row['monto_pagado_ods'] ?>" onKeyup="cambiarDiferencia()">
    </div>
    <div class="col-md-4 form-group">
        <label for="proveedor">Proveedor</label> 
        <input type="text" name="proveedor" class="form-control" value="<?php echo $row['proveedor'] ?>">
    </div>
    <div class="col-md-4 form-group">
        <label for="diferencia">Diferencia</label> 
        <input type="number" name="diferencia" id="diferencia" class="form-control" readonly value="<?php echo $row['diferencia'] ?>">
    </div>
</div>

<!--    ##########      FILA 4 DE 5     ##########      -->
<div class="row">
    <div class="col-md-6 form-group">
        <label for="factura">Factura PDF</label> 
        <?php echo $factura ?>
    </div>
    <div class="col-md-6 form-group">
        <label for="numero_factura">N&uacute;mero de Factura</label> 
        <input type="number" name="numero_factura" class="form-control" value="<?php echo $row['numero_factura'] ?>">
    </div>
</div>

<!--    ##########      FILA 5 DE 5     ##########      -->
<div class="row">
    <div class="col-md-6 form-group">
        <label for="estado_pago">Estado del Pago</label> 
        <select name="estado_pago" class="form-control">
            <option value="">Seleccione Estado de Pago</option>
<?php
$estado = array('Pagado' , 'Parcialemnte Pagado', 'Impago' );
for ($i=0; $i < sizeof( $estado ) ; $i++) 
{ 
    $selected   =   ( $estado[$i]==$estado_factura) ? 'selected' : '' ;
    echo '<option value="'.$estado[$i].'" '.$selected.'>'.$estado[$i] .'</option>';
}
?>
        </select>
    </div>
    <div class="col-md-6 form-group">
        <label for="comprobante">Comprobante del Pago PDF</label> 
        <?php echo $comprobante_pago ?>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <button type="submit" class="btn btn-primary" name="p" value="update">Guardar</button>
    </div>
</div>
</form>

<!-- #################      funcion para calcular la diferencia     ################# -->
<script>
function cambiarReembolso()
{
    document.getElementById("reembolso").value  =   ( document.getElementById("total_horas").value * 20000 );
}

function cambiarDiferencia()
{ 
    document.getElementById("diferencia").value     =  parseInt( document.getElementById("reembolso").value ) - parseInt( document.getElementById("monto_pagado_ods").value );
}

</script>
<!-- #################      fin de la funcion       ################# -->
<?php
    require_once('../../layouts/blade/body_down.php');
    require_once('../../layouts/blade/footer.php');
    require_once('../../layouts/blade/jquery.php');
    require_once('../../layouts/blade/fin.php');
}