<?php


/**
 * Class Viewer
 * ПРЕДНАЗНАЧЕНИЕ - Видеопроектор -
 * дарует информации требуемую форму (HTML, XML, прочее)
 *
 */
class Viewer {


  /**
   * Метод выводит время генерирования страницы
   * @param string $str
   */
  static public function echoCreatePgeTime($time)
  {
    printf('<!-- Генерация за  . %f  секунд -->' . PHP_EOL, $time);
  }

  /**
   * Непосредственно преобразование в нужную форму (строка-страница HTML)
   * @param string $template_pathname - место шаблона
   * @param array $content_array - содержит переменные для шаблона
   * @return string - результат созидания - в данном случае строка-страница HTML для вывода
   */
  public function render($template_pathname, $content_array = array())
  {

    foreach ($content_array as $key => $item) {
      $$key = $item;
    }

    ob_start();
    include $template_pathname;
    //if(isset($article)) var_export($article);
    return ob_get_clean();
  }

  /**
   * @param string $str вывод в поток
   */
  public function out($str)
  {
    echo $str;
    $this->echoStringLength($str);
  }

  /**
   * Метод выводит длину генерируемой страницы в символах и байтах
   * @param string $str
   */
  static public function echoStringLength($str)
  {
    $l = strlen($str);
    echo '<!-- В шаблоне ' . $l . ' символов или ' . ($l * 2) . 'байт -->' . PHP_EOL;
  }

}
