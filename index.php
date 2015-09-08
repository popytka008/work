<?php
//var_export($_GET); echo "\n<br/>";
//var_export($_POST);

// засечь время
include 'lib/scripts/start_timing.php';

require_once 'lib/components/Autoload.php';

// начальное значение
$controller = null;

if (Model::isGet() && isset($_GET['c']))
    $controller = Fabric::getObject($_GET['c']);
 else if (Model::isPost()) {
     $controller = Fabric::postObject($_POST['operation']);
} else {
   $controller = new C_List(new M_List()); // вывести список статей полюбому
 }
//var_dump($controller);
//делай!...
$controller->Request();

// засечь время вывести время генерации скрипта
include 'lib/scripts/end_timing.php';
