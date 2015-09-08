<?php


/**
 * Class C_Base
 *
 * Назначение: выполнение взаимодействия с "контентом" - на потомках.
 * на себя берется лишь пдключение сервисов (поработать) и передача данных в Viewer->render - слияние в выходную страницу.
 *
 */
class C_Base extends Controller
{
  /**
   * значение титула страницы: тэгов <title> и <h1>
   */
  protected $_title;
  /**
   * значение для подшаблона, реализующего меню
   */
  protected $_menu;
  /**
   * значение вместо подшаблона, реализующего шапку
   *
   */
  protected $_header;
  /**
   * значение вместо подшаблона, реализующего контент
   */
  protected $_content;
  /**
   * * значение вместо подшаблона, реализующего подвал
   */
  protected $_footer;

  /**
   * Заглушка (здесь: для всех элементов), назначает значения для реализации:
   * титула($_title), шапки($_header), меню($_menu), контента($_content), подвала($_footer).
   * Так же заглушаются и значения для подшаблона статьи (титул и содержимое статьи)
   *
   * (в нашем случае - создать соединение)
   *
   */
  protected function OnInput()
  {
    $this->_title = "Статьи";
    $this->_header = "Содержимое шапки";
    $this->_menu = "Содержимое меню";

    $this->_content = "Содержимое основной части";
    $this->_footer = "Содержимое подвала";
  }

  /**
   * Передача всех данных Видеопроектору, для отображения.
   * Отображение.
   */
  protected function OnOutput()
  {
    $this->_header = (new C_Header())->Request();
    $this->_menu = (new C_Menu())->Request();
    $this->_footer = (new C_Footer())->Request();

    $template_pathname = "v/v_main.tpl";
    $archive = array('menu' => $this->_menu, 'title' => $this->_title, 'header' => $this->_header,
      'content' => $this->_content, 'footer' => $this->_footer);

    $page = $this->_viewer->render($template_pathname, $archive);
    $this->_viewer->out($page);
  }
}
