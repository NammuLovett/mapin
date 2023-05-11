<?php

require_once 'config/config.php';
require_once 'model/Db.php';
require_once 'model/Category.php';
require_once 'model/Location.php';
require_once 'model/Manager.php';
require_once 'model/Place.php';
require_once 'model/Visitor.php';
require_once 'controller/controller.php';
require_once 'admin/controller/adminController.php';


/* Intercambio entre controladores  admin y visitor*/
if (!isset($_GET["action"])) $_GET["action"] = constant("DEFAULT_ACTION");
if (
    $_GET['controller'] = 'adminController'
) {
    $controlador = new adminController();
} else {
    $controlador = new controller();
}



$dataToView = array();
$dataToView  = $controlador->{$_GET["action"]}();
//var_dump($dataToView);


// Leer vistas 
require_once 'view/template/' . $controlador->header . '.php';
require_once 'view/' . $controlador->view . '.php';
require_once 'view/template/footer.php';
