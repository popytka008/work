<?php
//var_export($_GET);
require_once 'lib/components/Autoload.php';


// засечь время
include 'lib/scripts/start_timing.php';

// начальное значение
$controller = null;


// определим метод HTTP-запроса: если GET и если задан $_GET['id']
//if ($_SERVER['REQUEST_METHOD'] === 'GET' && !(isset($_GET['id'])))
if (Model::isGet()) {
  switch ($_GET['c']) {
    case 'new':
      $controller = new C_New();  // вывести пустую форму новой статьи
      break;
    case 'edit':
      $controller = new C_Edit(); // вывести форму редактирования
      break;
    case 'editor':
      $controller = new C_Editor(); // вывести список заголовков статей
      break;
    case 'one':
      $controller = new C_One(); // вывести выбранную статью
      break;
    default: // простой вход  
      $controller = new C_List(); // вывести список статей
  }
} else if (Model::isPost()) {
  switch ($_POST['operation']) {
    case 'delete':
      $controller = new C_Delete();// обработать удаление статьи
      break;
    case 'insert':
      $controller = new C_New();   // обработать вставку статьи
      break;
    case 'update':
      $controller = new C_Edit();  // обработать обновление статьи
      break;

    default:
  }
}

//делай!...
$controller->Request();

// засечь время вывести время генерации скрипта
include 'lib/scripts/end_timing.php';
