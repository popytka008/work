<?php
require_once 'lib/m/Model.php';

/**
 * Class Controller базовый абстрактный класс Контролёра
 * задающий основной интерфейс потомкам и концепту действий контролёров.
 * методы:
 * -- Абстрактные
 * OnInput()  void
 * OnOutput() void
 * -- Определенные
 * Request()  void
 * IsGet()    boolean
 * IsPost()   boolean
 * Template() string
 *
 * Целм и смысл абстрактных методов:
 * OnInput()  void - метод делает начальную работу при полученых даных от клиента:
 *                   запросы БД, подготовка полученного.
 * OnOutPut() void - метод выполняет работу по реализации передачи данных клиенту
 */
abstract class Controller
{
  abstract protected function OnInput();

  abstract protected function OnOutput();

  public function Request()
  {
    $this->OnInput();
    $this->OnOutput();
  }

  protected function IsGet()
  {
    return ($_SERVER['REQUEST_METHOD'] === 'GET');
  }

  protected function IsPost()
  {
    return ($_SERVER['REQUEST_METHOD'] === 'POST');
  }

  protected function Template($template_pathname, $content_array = array())
  {
    foreach ($content_array as $key => $item) {
      $$key = $item;
    }

    ob_start();
    include $template_pathname;
    return ob_get_clean();
  }

}

/**
 * Class C_Base
 *
 * Назначение: выполнение взаимодействия с "контентом" - на потомках.
 *             на себя берется лишь пдключение сервисов и слияние в выходную страницу.
 *
 */
class C_Base extends Controller
{
  protected $_id_article;
  protected $_title_article;
  protected $_content_article;

  protected $_title;
  protected $_menu;
  protected $_header;
  protected $_content;
  protected $_footer;

  /**
   * Заглушка, назначает значения ан всякий случай для $title и $content
   * (в нашем случае - создать соединение)
   *
   */
  protected function OnInput()
  {
    $this->_title = "Статьи";
    $this->_menu = "Содержимое меню";
    $this->_header = "Содержимое шапки";
    $this->_content = "Содержимое основной части";
    $this->_footer = "Содержимое подвала";

    $this->_title_article = "Назвыание статьи";
    $this->_content_article = "Содержимое статьи";

  }

  /**
   * Слияние шаблонов в выходную страницы
   * (закрытие соединения)
   */
  protected function OnOutput()
  {
    $template_pathname = "v/v_main.tpl";
    $content_array = array('menu' => $this->_menu, 'title' => $this->_title, 'header' => $this->_header,
      'content' => $this->_content, 'footer' => $this->_footer);
    $page = $this->Template($template_pathname, $content_array);

    echo $page;
  }
}

/**
 * Class C_View
 *
 * Задачей класса является выборка данных (помощь механика), развёртка шаблона v_list.php
 * с сохранением развертки в свойство $this->content
 */
class C_View extends C_Base
{
  protected $_articles;
  protected $_error;

  protected function OnInput()
  {
    parent::OnInput();
    $this->_title .= '::Просмотр списка статей';

    $model = new Model();
    $this->_articles = $model->getArticles();
    $this->_error = $model->getError();
  }

  protected function OnOutput()
  {
    $arr = array('error' => nl2br($this->_error), 'articles' => $this->_articles);

    $this->_content = $this->Template("v/v_list.tpl", $arr);
    parent::OnOutput();
  }
}


/**
 * Class C_Edit
 * вносит в форму редактирования (v_edit) значения
 * проверяет правильность введенных (исправленных) данных в форме.
 */
class C_Edit extends C_Base
{
  protected $_error;
  protected $_article;

  protected function OnInput()
  {
    parent::OnInput();

    // сначала определить метод прихода - get / post
    // если post - вставить данные в источник данных
    if ($this->IsPost()) {
//      echo '<br/>или: Ухожу в сохранение статьи: C_Edit--$this->IsPost()<br/>';
//      echo '<br/>или: Ухожу в удаление статьи: C_Edit--$this->IsPost()<br/>';

      $model = new Model();
      if($_POST["operation"]==="update")
        $model->saveArticle(array((int)$_POST['id_article'], $_POST['title_article'], $_POST['content_article']));
      else
        $model->deleteArticle((int)$_POST['id_article']);

      $this->_error = $model->getError();
      header("Location: index.php");
    }

    // метод get - просмотр статьи

    $this->_title .= '::Редактирование статьи';

    $model = new Model();
    $this->_article = $model->getArticle((int)$_GET['id']);
    $this->_error = $model->getError();
  }

  protected function OnOutput()
  {
    $arr = array('error' => nl2br($this->_error), 'article' => $this->_article);

    $this->_content = $this->Template("v/v_edit.tpl", $arr);
    parent::OnOutput();
  }
}