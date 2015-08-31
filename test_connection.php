<?php



require_once 'lib/components/File.php';
$str = '/'.PHP_EOL.'/'.PHP_EOL.'/'.PHP_EOL;
$str .= '/**************** вход в файл test_connection.php *****************/'.PHP_EOL;
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
{

  $str = '/*------------------- вход в разбор МЕТОДА  ---------------------*/'.PHP_EOL;
  File::append('test_file.txt', $str);

  File::append('test_file.txt', var_export($_POST, true));
  File::append('test_file.txt', PHP_EOL);

  require_once 'lib/m/Model.php';
  $model = new Model();

  $content .= sprintf("new Model()->getMethod(): %s\n<br/>", $model ->getMethod());
  $content .= sprintf("new Model()->isGet(): %s\n<br/>", $model ->isGet());
  $content .= sprintf("new Model()->isPost(): %s", $model ->isPost());


  $str = '/*------------------- выход из разбора МЕТОДА  ------------------*/'.PHP_EOL;
  File::append('test_file.txt', $str);
}

//*работа с методами класса Connection
{

  $str = '/*------------------- вход в разбор методов класса Connection ---------------------*/'.PHP_EOL;
  File::append('test_file.txt', $str);

  require_once 'lib/m/Model.php';
  $connection = new Connection();
  $content .= sprintf("После \$connection = new Connection(); соединение: %s<br/>".PHP_EOL, $connection->test_connection());
  $connection->close();
  $content .= sprintf("После \$connection->close(); соединение: %s<br/>".PHP_EOL, $connection->test_connection());
  $connection->open();
  $content .= sprintf("После \$connection->open(); соединение: %s<br/>".PHP_EOL.PHP_EOL, $connection->test_connection());

  $connection->close();
  $content .= sprintf("После \$connection->close(); соединение: %s<br/>".PHP_EOL, $connection->test_connection());
  $tmp = Connection::getConnection();
  $content .= sprintf("После \$tmp = Connection::getConnection(); соединение: %s<br/>".PHP_EOL, $connection->test_connection());
  $connection->close();
  $content .= sprintf("После \$connection->close(); соединение: %s<br/>".PHP_EOL.PHP_EOL, $connection->test_connection());

  File::append('test_file.txt', var_export($connection, true));
  File::append('test_file.txt', PHP_EOL);



  $str = '/*------------------- выход из разбора методов класса Connection ------------------*/'.PHP_EOL;
  File::append('test_file.txt', $str);
}

File::append('test_file.txt', 'ВВОД ВСЕХ ПЕРЕМЕННЫХ И ИХ ЗАНЧЕНИЙ:'.PHP_EOL);
File::append('test_file.txt', $content.PHP_EOL);
File::append('test_file.txt', ' $result = '.$result.PHP_EOL);

/*
 * настройка шаблонов на новые переменные
 */






/*
 * предварительно:
 * - вывод всегда и везде постоянен, по ятму вывожу его вниз подальше
 *
 */
require_once "lib/v/Viewer.php";
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

$footer = $view->view_include("v/v_test_query_footer.tpl");

/*
 * ТЕПЕРЬ ВЫВОДИМ ГЛАВНУЮ СТРАНИЦУ
 * то есть вставляем внутренние шаблоны в главный
 *
 */
$str = '/**************** выход из файла test_connection.php ***********/'.PHP_EOL.'/'.PHP_EOL.'/'.PHP_EOL.'/';
File::append('test_file.txt', $str);

$page = $view->view_include("v/v_test_query.tpl", array('title' => $title,
                                                        'menu'=> $menu,
                                                        'content'=> $content,
                                                        'footer' => $footer ));

// проверка:
// ПОРЯДОК!!!

echo $page;









