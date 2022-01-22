<?php require_once '../../layouts/templateUp.php'; ?>

<section class="content-header">
    <h1>Gastos<small>Aprocon</small></h1>
</section><br>

<div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-aqua">
                1 <small>d&iacute;a</small>
            </span>

            <div class="info-box-content">
                <span class="info-box-text">&Uacute;ltimo d&iacute;a</span>
                <span class="info-box-number">$ <?php echo number_format( $clase->GastoDia(), 0 ,',', '.' ); ?></span>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-red">
                7 <small>d&iacute;as</small>
            </span>

            <div class="info-box-content">
                <span class="info-box-text">&Uacute;ltima Semana</span>
                <span class="info-box-number">$ <?php echo number_format( $clase->GastoSemana(), 0 ,',', '.' ); ?></span>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-green">
                30 <small>d&iacute;as</small>
            </span>

            <div class="info-box-content">
                <span class="info-box-text">&Uacute;ltimo Mes</span>
                <span class="info-box-number">$ <?php echo number_format( $clase->GastoMes(), 0 ,',', '.' ); ?></span>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-yellow">
                1 <small>A&ntilde;o</small>
            </span>

            <div class="info-box-content">
                <span class="info-box-text">&Uacute;ltimo A&ntilde;o</span>
                <span class="info-box-number">$ <?php echo number_format( $clase->GastoAnio(), 0 ,',', '.' ); ?></span>
            </div>
        </div>
    </div>

</div>


<section class="content-header">
    <h1>Dep&oacute;sitos<small>Aprocon</small></h1>
</section><br>

<div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-aqua">
                1 <small>d&iacute;a</small>
            </span>

            <div class="info-box-content">
                <span class="info-box-text">&Uacute;ltimo d&iacute;a</span>
                <span class="info-box-number">$ <?php echo number_format( $clase->DepositoDia(), 0 ,',', '.' ); ?></span>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-red">
                7 <small>d&iacute;as</small>
            </span>

            <div class="info-box-content">
                <span class="info-box-text">&Uacute;ltima Semana</span>
                <span class="info-box-number">$ <?php echo number_format( $clase->DepositoSemana(), 0 ,',', '.' ); ?></span>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-green">
                30 <small>d&iacute;as</small>
            </span>

            <div class="info-box-content">
                <span class="info-box-text">&Uacute;ltimo Mes</span>
                <span class="info-box-number">$ <?php echo number_format( $clase->DepositoMes(), 0 ,',', '.' ); ?></span>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-yellow">
                1 <small>A&ntilde;o</small>
            </span>

            <div class="info-box-content">
                <span class="info-box-text">&Uacute;ltimo A&ntilde;o</span>
                <span class="info-box-number">$ <?php echo number_format( $clase->DepositoAnio(), 0 ,',', '.' ); ?></span>
            </div>
        </div>
    </div>

</div>

<div class="row">
    <form action="" method="post">
        <div class="col-md-6">
            <div class="form-group">
                <button type="submit" name="p" value="localidades" class="btn btn-warning">Localidades</button>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <button type="submit" name="p" value="usuarios" class="btn btn-warning">Usuarios</button>
            </div>
        </div>
    </form>
</div>
<?php require_once '../../layouts/templateDown.php'; ?>