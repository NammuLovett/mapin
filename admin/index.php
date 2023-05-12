<?php

session_start();

require_once 'config/config.php';
require_once '../model/Db.php';
require_once '../model/Category.php';
require_once '../model/Manager.php';
require_once '../model/Mapin.php';
require_once '../model/Place.php';



if (!isset($_GET["controller"])) $_GET["controller"] = constant("DEFAULT_CONTROLLER_ADMIN");
if (!isset($_GET["action"])) $_GET["action"] = constant("DEFAULT_ACTION_ADMIN");

$controller_path = 'controller/' . $_GET["controller"] . '.php';

if (!file_exists($controller_path)) $controller_path = 'controller/' . constant("DEFAULT_CONTROLLER_ADMIN") . '.php';

require_once $controller_path;

$controladorName = $_GET["controller"];

$controlador = new $controladorName();

$dataToView = array();
$dataToView  = $controlador->{$_GET["action"]}();

// Leer vistas
/* require_once 'view/template/header.php';
 */
require_once 'view/' . $controlador->view . '.php';
/* require_once 'view/template/footer.php'; */
