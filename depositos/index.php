<?php 
require_once '../../config/core.class.php';
$core   =   new core;
session_start();
$usuarios  = $core->Permisos( 'depositos', 'permisos', $_SESSION['id'] );
foreach($usuarios as $row)
{
    $dep = $row['depositos'];
}

if( $dep == 1 )
{ 
        require_once'../../layouts/blade/head.php'; 
        require_once'../../layouts/blade/header.php'; 
        require_once'../../layouts/blade/aside.php'; 
        require_once '../../layouts/blade/body_up.php';
?>

    <!--Contenido-->
    <div class="row">
        <div class="col-lg-8">
            <h3>Listado de Dep&oacute;sitos <a href="create.php" ><button class="btn btn-success">Nuevo</button></a></h3>
        </div><!-- /.col -->
    </div><!-- /.row -->
    
    <div class="row">
        <div class="col-md-6">
            <form method="post" action="">
            <div class="input-group">
                <select name="buscar" class="selectpicker" required  data-show-subtext="true" data-live-search="true">
                    <option value="">Seleccione Jefe de Terreno</option>
                    
<?php
    require_once('depositos.class.php');
    $depositos   =   new depositos;
$usuarios   =   $depositos->ListarUsuariosDeposito();
foreach ( $usuarios as $row )
{
?>
                    <option value="<?php echo $row['nombre'] ?>"><?php echo $row['nombre'] ?></option>
<?php } ?>
                </select>
                <span class="input-group-btn">
                    <button class="btn btn-warning" type="submit">Buscar</button>
                </span>
            </div>
        </form>
        </div>
    </div><br>

    <div class="row">
        <div class="col-xs-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Monto</th>
                            <th>Detalle</th>
                            <th>Fecha</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>

    <?php 
    require_once('depositos.class.php');
    $depositos   =   new depositos;
    $query      =   ( isset( $_POST['buscar'] ) ) ? $depositos->ListarDepositosFiltro( $_POST['buscar'] ) : $depositos->ListarDepositos();
                                
    foreach ($query as $fila) { ?>
                        <tr>
                            <td><?php echo $fila['id'] ?> </td>
                            <td><?php echo $fila['nombre'] ?> </td>
                            <td>
    <?php
    $numero = $fila['monto'];
    echo '$ '.number_format( $numero, '0',',', '.' ); ?>
                            </td>
                            <td><?php echo $fila['detalle'] ?></td>
                            <td><?php echo date( 'd-m-Y', strtotime( $fila['fecha'] ) ); ?></td>
                            <td>
                                <a href="update.php?id=<?php echo $fila['id'] ?>"><button class="btn btn-info">Editar</button></a>
                                <a href="create.class.php?p=eliminar&id=<?php echo $fila['id'] ?>"><button class="btn btn-danger">Eliminar</button></a>
                            </td> 
                        </tr>
    <?php } ?>
                    </tbody>
                </table>
            </div><!-- /.table-responsive -->
        </div><!-- /.col -->
    </div><!-- /.row -->

<?php 
    require_once'../../layouts/blade/body_down.php';
    require_once'../../layouts/blade/footer.php'; 
    require_once'../../layouts/blade/jquery.php';
    require_once'../../layouts/blade/fin.php';  
}
else
{
    header('Location:../../');
}
?>