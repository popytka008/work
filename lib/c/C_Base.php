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
   * значение для значения в подшаблоне статьи (ключ статьи)
   */
  protected $_id_article;
  /**
   * значение для значения в подшаблоне статьи (название статьи)
   */
  protected $_title_article;
  /**
   * значение для значения в подшаблоне статьи (название статьи)
   */
  protected $_content_article;

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
   * @var Model Свой Механик
   */
  protected $_model;


  /**
   * конструктор Контролёра подключеат своего Механика
   * @param Model|null $_model
   */
  public function __construct(Model $_model = null)
  {
    $this->_model = $_model;
    //var_dump($_model);
  }


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

    $this->_title_article = "Назвыание статьи";
    $this->_content_article = "Содержимое статьи";
  }

  /**
   * Передача всех данных Видеопроектору, для отображения.
   * Отображение.
   */
  protected function OnOutput()
  {

    $tmp = new C_Menu();
    $this->_menu = $tmp->Request();

    $tmp = new C_Footer();
    $this->_footer = $tmp->Request();

    $tmp = new C_Header();
    $this->_header = $tmp->Request();

    $template_pathname = "v/v_main.tpl";
    $archive = array('menu' => $this->_menu, 'title' => $this->_title, 'header' => $this->_header,
      'content' => $this->_content, 'footer' => $this->_footer);

    $v = new Viewer();
    $page = $v->render($template_pathname, $archive);
    $v->out($page);
  }
}

