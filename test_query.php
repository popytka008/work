<?php

require_once 'lib/components/File.php';
$str = '/'.PHP_EOL.'/'.PHP_EOL.'/'.PHP_EOL;
$str .= '/**************** вход в файл test_query.php *****************/'.PHP_EOL;
File::append('test_file.txt', $str);

$title = "";
$menu = "";
$content = "";
$footer="";
/*
 * Эти переменные видимо остаются по ка неизменяемыми, но:
 * - $content должен добавлять текущие данные шаблон формы
 * - также необходимо давать видное сообщение об успешности операции
 * - так, как $menu незадействовано, добавим в шаблон переменную сообщения
 */
$message = "";
$text_id = "";
$text_title = "";
$text_content = "";
$result = "";
$command = "";
/*
 * эти переменные обновит СУЩЕСТВУЮЩИЙ $_POST
 */
if(isset($_POST['command'])){

  $str = '/*------------------- вход в разбор $_POST  ---------------------*/'.PHP_EOL;
  File::append('test_file.txt', $str);

  File::append('test_file.txt', var_export($_POST, true));
  File::append('test_file.txt', PHP_EOL);

  $_ = $_POST;
  $text_id = ($_["text_id"] == "" ? null: $_["text_id"]);
  $text_title = ($_["text_title"] == "" ? null : $_["text_title"]);
  $text_content = ($_["text_content"] == "" ? null : $_["text_content"]);
  //$result = $_["result"];   - вычисляется компонентами
  $command = $_["command"];

// внутри - если была операция (кнопка SUBMIT), тогда выяснить генерацию запроса
  require_once "lib/components/QueryConstructor.php";
  $query = new QueryConstructor($command, array($text_title, $text_content), null, $text_id);
  $result = $query->getQuery();

  $str = '/*------------------- выход из разбора $_POST  ------------------*/'.PHP_EOL;
  File::append('test_file.txt', $str);
  if(!$result) $message = "ВНИМАНИЕ: не получен сгенерированный запрос!";
}

File::append('test_file.txt', 'ВВОД ВСЕХ ПЕРЕМЕННЫХ И ИХ ЗАНЧЕНИЙ:'.PHP_EOL);
File::append('test_file.txt', ' $message = '.$message.PHP_EOL);
File::append('test_file.txt', ' $command = '.$command.PHP_EOL);
File::append('test_file.txt', ' $result = '.$result.PHP_EOL);
File::append('test_file.txt', ' $text_id = '.$text_id.PHP_EOL);
File::append('test_file.txt', ' $text_title = '.$text_title.PHP_EOL);
File::append('test_file.txt', ' $text_content = '.$text_content.PHP_EOL);

/*
 * настройка шаблонов на новые переменные
 */






/*
 * предварительно:
 * - вывод всегда и везде постоянен, по ятму вывожу его вниз подальше
 *
 */
require_once "lib/v/viewer.php";
$view = new Viewer();

/*
 * сначала сделаем $title
 */
$title = $view->view_include("v/v_test_query_title.tpl");

/*
 * теперь $header
 * здесь не нужны параметры
 *
 */
$menu = $view->view_include("v/v_test_query_menu.tpl", array('message'=>$message));

/*
 * таким же образом $content и $footer
 */
$content = $view->view_include("v/v_test_query_content.tpl", array('text_id'=>$text_id, 'text_title'=>$text_title, 'text_content'=>$text_content, 'result'=>$result));
$footer = $view->view_include("v/v_test_query_footer.tpl");

/*
 * ТЕПЕРЬ ВЫВОДИМ ГЛАВНУЮ СТРАНИЦУ
 * то есть вставляем внутренние шаблоны в главный
 *
 */
$str = '/**************** выход из файла test_query.php **************/'.PHP_EOL.'/'.PHP_EOL.'/'.PHP_EOL.'/';
File::append('test_file.txt', $str);

echo $view->view_include("v/v_test_query.tpl", array('title' => $title,
                                                            'menu'=> $menu,
                                                            'content'=> $content,
                                                            'footer' => $footer ));

// проверка:
// ПОРЯДОК!!!

