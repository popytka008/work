<?php

require_once "lib/c/Controller.php";
$controller = null;

if ($_SERVER['REQUEST_METHOD'] === 'GET')
{
  if (!isset($_GET['id'])) $controller = new C_View();
}
else
{
  $controller = new C_Edit($_GET['id']);
}

$controller->Request();



