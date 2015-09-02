<?php



require_once 'lib/components/File.php';
$str = '/'.PHP_EOL.'/'.PHP_EOL.'/'.PHP_EOL;
$str .= '/**************** вход в файл test_dbms.php *****************/'.PHP_EOL;
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

//  $str = '/*------------------- вход в разбор МЕТОДА  ---------------------*/'.PHP_EOL;
//  File::append('test_file.txt', $str);
//
//  File::append('test_file.txt', var_export($_POST, true));
//  File::append('test_file.txt', PHP_EOL);

  require_once 'lib/m/Model.php';
  $model = new Model();

//  $content .= sprintf("new Model()->getMethod(): %s\n<br/>", $model ->getMethod());
//  $content .= sprintf("new Model()->isGet(): %s\n<br/>", $model ->isGet());
//  $content .= sprintf("new Model()->isPost(): %s", $model ->isPost());
//
//
//  $str = '/*------------------- выход из разбора МЕТОДА  ------------------*/'.PHP_EOL;
//  File::append('test_file.txt', $str);
}

//*работа с методами класса Connection

// метод select
// метод update
// метод insert
// метод delete

{

  $str = '/*------------------- вход в разбор методов класса DBMS ---------------------*/'.PHP_EOL;
  File::append('test_file.txt', $str);

  require_once 'lib/m/Model.php';
  $d = new DBMS();
  $content .= sprintf("После \$d = new DBMS();; определим компоненты объекта \$d<br/>".PHP_EOL);
  $content .= sprintf("%s<br/>".PHP_EOL, var_export($d, true));
  // метод select
  $id = 0;
  if($arr = $d->select()){
    $content .= sprintf("После \$d->select(); количество полученных строк: %d<br/>".PHP_EOL, count($arr));
  }

  // метод insert
  $t = "Училка диктует в классе диктант:";
  $c = "Училка диктует в классе диктант: \"Стояла тишина, только на полу скребет мышь...\"

Вовочка ее перебивает и говорит: \"То, что мышь - это понятно, а что за зверь такой - \"наполускр\" ?\".";
  if($res = $d->insert(array($t, $c))){
    $content .= sprintf("После \$d->insert(array(\$t, \$c)); количество измененных строк: %d<br/>".PHP_EOL, $res);
    $id = mysql_insert_id();
  }

  // метод update 1
  $t = "Училка задала в классе очинение:";
  $c = "Училка диктует в классе диктант: \"Стояла тишина, только на полу скребет мышь...\"

Вовочка ее перебивает и говорит: \"То, что мышь - это понятно, а что за зверь такой - \"наполускр\" ?\".";
  if($res = $d->update(array($t, $c),$id)){
    $content .= sprintf("1.После \$d->update(array(\$t, \$c),count(\$arr)+1); количество измененных строк: %d<br/>".PHP_EOL, $res);
  }
  // метод update 1
  $t = "Училка задала в классе очинение:";
  $c = "Училка задала в классе очинение: \"Стояла тишина, только на полу скребет мышь...\"

Вовочка ее перебивает и говорит: \"То, что мышь - это понятно, а что за зверь такой - \"наполускр\" ?\".";
  if($res = $d->update(array($t, $c),$id)){
    $content .= sprintf("2.После \$d->update(array(\$t, \$c),count(\$arr)+1); количество измененных строк: %d<br/>".PHP_EOL, $res);
  }


  // метод delete
  if($res = $d->delete($id)){
    $content .= sprintf("После \$d->delete({count($arr)+1}); количество удаленных строк: %d<br/>".PHP_EOL, $res);
  }



  $str = '/*------------------- выход из разбора методов класса DBMS ------------------*/'.PHP_EOL;
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
$title = $view->render("v/v_test_query_title.tpl");

/*
 * теперь $header
 * здесь не нужны параметры
 *
 */
$menu = $view->render("v/v_test_query_menu.tpl", array('message'=>$message));

/*
 * таким же образом $content и $footer
 */

$footer = $view->render("v/v_test_query_footer.tpl");

/*
 * ТЕПЕРЬ ВЫВОДИМ ГЛАВНУЮ СТРАНИЦУ
 * то есть вставляем внутренние шаблоны в главный
 *
 */
$str = '/**************** выход из файла test_dbms.php ***********/'.PHP_EOL.'/'.PHP_EOL.'/'.PHP_EOL.'/';
File::append('test_file.txt', $str);

$page = $view->render("v/v_test_query.tpl", array('title' => $title,
                                                        'menu'=> $menu,
                                                        'content'=> $content,
                                                        'footer' => $footer ));

// проверка:
// ПОРЯДОК!!!

echo $page;









