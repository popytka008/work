<?php


// засечь время
include 'lib/scripts/start_timing.php';

require_once "lib/c/C_List.php";
require_once "lib/c/C_Edit.php";
$controller = null;


if ($_SERVER['REQUEST_METHOD'] === 'GET' && !(isset($_GET['id'])))
{
  $controller = new C_List();
}
else
{
  $controller = new C_Edit();
}

$controller->Request();

// засечь время вывести время генерации скрипта
include 'lib/scripts/end_timing.php';
