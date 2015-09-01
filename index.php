<?php

require_once "lib/c/Controller.php";
$controller = null;


if ($_SERVER['REQUEST_METHOD'] === 'GET' && !(isset($_GET['id'])))
{
  $controller = new C_View();
}
else
{
  $controller = new C_Edit();
}

$controller->Request();



