<?php require_once '../../layouts/templateup.php' ?>

<div class="row">
    <div class="col-md-8">
        <h3>Nuevo Traspaso</h3>
    </div>
    <div class="col-md-4"></div>
</div>


<div class="row">
    <form action="" method="post" autocomplete="off">
        <div class="col-md-4">
            <div class="form-group">
                <input type="date" name="fecha" value="<?php echo $fecha ?>" class="form-control">
            </div>
        </div>
        <div class="col-md-4">
            <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-home"></i></div>
                    <select name="origen" readonly class="form-control">
                        <option value="<?php echo $_SESSION['idBodega'] ?>"><?php echo $_SESSION['nombreBodega'] ?></option>
                    </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-home"></i></div>
                    <select name="destino" class="form-control selectpicker" required  data-show-subtext="true" data-live-search="true" autofocus>
                        <option value="">Bodega de Destino</option>
<?php
foreach ( $bodegas as $value ):
    echo '              <option value="'.$value['id'].'">'.$value['nombre'].' '.$value['localidad'].'</option>';
endforeach;
?>
                    </select>
                    <span class="input-group-btn">
                        <button class="btn btn-warning" type="submit" name="p" value="save_enc" title="Guardar">
                            <i class="fa fa-save"></i>
                        </button>
                    </span>
                    <input type="hidden" name="nombreDestino" value="<?php echo $value['nombre'].' '.$value['localidad'] ?>">
                </div>
            </div>
        </div>
    </form>
</div>

<?php require_once '../../layouts/templateDown.php' ?>