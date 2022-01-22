<?php require_once '../../layouts/templateUp.php'; ?>

<!-- row -->
<div class="row">
    <div class="col-md-12">
        <h3>Solicitud de Compra N&deg;<strong><?php echo $id ?></strong></h3>
    </div>
</div>
<!-- /row -->

<!-- row -->
<div class="row">
    <form action="" method="post" autocomplete="off">
        <div class="col-md-4">
            <div class="form-group">
                <label>Forma de Pago</label>
                <input type="text" name="formaPago" value="<?php echo $ShowById['formaPago'] ?>" class="form-control" required autofocus placeholder="Ej: Cr&eacute;dito 30 Dias">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>N&deg; Cotizaci&oacute;n</label>
                <input type="number" name="cotizacion" value="<?php echo number_format( $ShowById['cotizacion'], 0, ',', '.' ) ?>" class="form-control" placeholder="0">
            </div>
        </div>
        <div class="col-md-4">
        <label> </label><br>
            <button type="submit" name="p" value="EditDet" class="btn btn-success">
                <i class="fa fa-forward"> Siguiente</i>
            </button>
            <input type="hidden" name="id" value="<?php echo $ShowById['id'] ?>">
            <input type="hidden" name="proveedor" value="<?php echo $ShowById['proveedor'] ?>">
        </div>
    </form>
</div>
<!-- /row -->

<?php require_once '../../layouts/templateDown.php'; ?>