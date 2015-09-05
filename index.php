<?php
//var_export($_GET); echo "\n<br/>";
//var_export($_POST);
require_once 'lib/components/Autoload.php';


// засечь время
include 'lib/scripts/start_timing.php';

// начальное значение
$controller = null;
$fabric = new Fabric();

if (Model::isGet()) {
  $controller = $fabric->getObject($_GET['c']);
} else if (Model::isPost()) {
  $controller = $fabric->postObject($_POST['operation']);
}

//делай!...
$controller->Request();

// засечь время вывести время генерации скрипта
include 'lib/scripts/end_timing.php';
