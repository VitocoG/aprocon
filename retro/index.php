<?php
session_start();
require_once('../../config/model.class.php');
$model = new model;
$retro = $model->SelectByKey('permisos', 'persona', $_SESSION['id'], '' );
foreach ($retro as $value)
{
  $permiso  =   $value['arriendo_retro'];
}

if ($permiso==1)
{
    require_once('retroController.php');
}
else 
{    
    header('Location:../../');
}

?>