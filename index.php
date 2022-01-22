<?php 
require_once '../config/core.class.php';
$core   =   new core;
session_start();
$usuarios  = $core->Permisos( 'inventario', 'permisos', $_SESSION['id'] );
foreach($usuarios as $row)
{
    $dep = $row['inventario'];
}

if( $dep == 1 )
{
require_once '../layouts/blade/head.php';
require_once '../layouts/blade/header.php'; 
require_once '../layouts/blade/aside.php';
require_once '../layouts/blade/body_up.php';
?>


<div class="row">
        <form action="inventario.php" method="post" enctype="multipart/form-data">
            
            <div class="form-group col-md-8">
                <input type="file" class="form-control" name="archivo" autofocus required>
            </div>
            
            <div class="form-group col-md-4">
                <input class="btn btn-warning" name="boton" type="submit">
            </div>
        </form>
    </div>
</div>


<?php
require_once'../layouts/blade/body_down.php';
require_once'../layouts/blade/footer.php';
require_once'../layouts/blade/jquery.php';  
require_once'../layouts/blade/fin.php';
}
else
{
    header('Location:../../');
}
?>