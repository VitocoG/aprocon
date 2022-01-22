<?php require_once '../../layouts/templateUp.php'; ?>

<!-- row -->
<div class="row">
    <div class="col-md-12">
        <h3>Solicitud de Compra para <strong><?php echo $ShowById['nombre'] ?></strong></h3>
    </div>
</div>
<!-- /row -->

<!-- row -->
<div class="row">
    <form action="" method="post" autocomplete="off">
        <div class="col-md-4">
            <div class="form-group">
                <label>Forma de Pago</label>
                <input type="text" name="formaPago" value="" class="form-control" required autofocus placeholder="Ej: Cr&eacute;dito 30 Dias">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>N&deg; Cotizaci&oacute;n</label>
                <input type="number" name="cotizacion" value="" class="form-control">
            </div>
        </div>
        <div class="col-md-4">
        <label> </label><br>
            <button type="submit" name="p" value="CreateDet" class="btn btn-success">
                <i class="fa fa-forward"> Siguiente</i>
            </button>
            <input type="hidden" name="proveedor" value="<?php echo $ShowById['id'] ?>">
        </div>
    </form>
</div>
<!-- /row -->

<?php require_once '../../layouts/templateDown.php'; ?>