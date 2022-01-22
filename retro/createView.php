<?php
session_start();
if ($_SESSION['id']):
    require_once('../../layouts/blade/head.php');
    require_once('../../layouts/blade/header.php');
    require_once('../../layouts/blade/aside.php');
    require_once('../../layouts/blade/body_up.php');
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
        <input type="date" name="fecha" class="form-control" value="<?php echo date('Y-m-d') ?>" disabled>
    </div>
    <div class="col-md-4 form-group">
        <label for="ods">ODS</label> 
        <input type="number" name="ods" class="form-control" required min="100000000" max="999999999">
    </div>
    <div class="col-md-4 form-group">
        <label for="report">Report PDF</label> 
        <input type="file" name="report" class="form-control" required accept="application/pdf">
    </div>
</div>

<!--    ##########      FILA 2 DE 5     ##########      -->
<div class="row">
    <div class="col-md-4 form-group">
        <label for="localidad">Localidad</label> 
        <input type="text" name="localidad" class="form-control" required>
    </div>
    <div class="col-md-4 form-group">
        <label for="total_horas">Total de Horas</label> 
        <input type="number" name="total_horas" id="total_horas" class="form-control" min="0" value="0" onKeyup="cambiarReembolso()" required>
    </div>
    <div class="col-md-4 form-group">
        <label for="reembolso">Reembolso</label> 
        <input type="number" name="reembolso" id="reembolso" class="form-control"  disabled>
    </div>
</div>

<!--    ##########      FILA 3 DE 5     ##########      -->
<div class="row">
    <div class="col-md-4 form-group">
        <label for="proveedor">Proveedor</label> 
        <input type="text" name="proveedor" class="form-control" required>
    </div>
    <div class="col-md-4 form-group">
        <label for="monto_pagado_ods">Monto Pagado ODS</label> 
        <input type="number" name="monto_pagado_ods" id="monto_pagado_ods" class="form-control" min="0" value="0" onKeyup="cambiarDiferencia()">
    </div>
    <div class="col-md-4 form-group">
        <label for="diferencia">Diferencia</label> 
        <input type="number" name="diferencia" id="diferencia" class="form-control" disabled>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <button type="submit" class="btn btn-primary" name="p" value="save">Guardar</button>
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
endif;
?>