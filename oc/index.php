<?php
session_start();

date_default_timezone_set( 'America/Santiago');

$class  =   'oc';

require_once '../../config/model.class.php';
$model  =   new model;

require_once $class.'Model.php';
$clase  =   new $class;

require_once '../oc/ocController.php';

?>