<?php
session_start();
if ($_SESSION['id'])
{
    require_once('../../layouts/blade/head.php');
    require_once('../../layouts/blade/header.php');
    require_once('../../layouts/blade/aside.php');
    require_once('../../layouts/blade/body_up.php');

    require_once('retroModel.class.php');
    $retro  =   new retroModel;
?>


<div class="row">
  <div class="col-lg-8">
    <form action="" method="post">
        <h3>Arriendo de Retroexcavadoras <button class="btn btn-success" type="submit" name="p" value="create">Nuevo</button></h3>
    </form>
  </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Fecha</th>
                        <th>Jefe Terreno</th>
                        <th>Localidad</th>
                        <th>Cantidad de Horas</th>
                        <th>PDF</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
<?php
$show   =   $retro->ListarRetro();
foreach($show as $row)
{
    $estado         =   ($row['estado_factura']=='Parcialmente Pagado') ? ' class="bg-warning"' : ( ( $row['estado_factura']== 'Pagado' ) ? ' class="bg-success"' : ' class="bg-danger"' );
    $reportPDF      =   (empty($row['report'])) ? '' : '<a href="'.$row['report'].'" target="_blank"><button class="btn btn-primary">REPORT</button></a>';
    $facturaPDF     =   (empty($row['factura'])) ? '' : ' <a href="'.$row['factura'].'" target="_blank"><button class="btn btn-primary">FACTURA</button></a>';
    $comprobantePDF =   (empty($row['comprobante_pago'])) ? '' : ' <a href="'.$row['comprobante_pago'].'" target="_blank"><button class="btn btn-primary">COMPROBANTE</button></a>';
echo '
            <tr>
                <td '.$estado.'>'.$row['id'].'</td>
                <td '.$estado.'>'.$row['fecha'].'</td>
                <td '.$estado.'>'.$row['usuario'].'</td>
                <td '.$estado.'>'.$row['localidad'].'</td>
                <td '.$estado.'>'.$row['total_horas'].'</td>
                <td '.$estado.'>'.$reportPDF.$facturaPDF.$comprobantePDF.'
                </td>
                <td>
                    <form action="" method="post">
                        <input type="hidden" name="id" value="'.$row['id'].'">
                        <button class="btn btn-success" value="edit" name="p">Editar</button></a> 
                        <button class="btn btn-danger" value="delete" name="p">Eliminar</button></a> 
                    </form>
            </td>
            </tr>
';
}
?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
    require_once('../../layouts/blade/body_down.php');
    require_once('../../layouts/blade/footer.php');
    require_once('../../layouts/blade/jquery.php');
    require_once('../../layouts/blade/fin.php');
}
?>