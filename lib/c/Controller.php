<?php
require_once 'lib/m/Model.php';
require_once 'lib/v/Viewer.php';

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
 * Render() string
 *
 * Целм и смысл абстрактных методов:
 * OnInput()  void - метод делает начальную работу при полученых даных от клиента:
 *                   запросы БД, подготовка полученного.
 * OnOutPut() void - метод выполняет работу по реализации передачи данных клиенту
 */
abstract class Controller
{
  /**
   * Перечень процедур для работы с входными данными
   */
  abstract protected function OnInput();

  /**
   * Перечень процедур для работы с выходными данными
   */
  abstract protected function OnOutput();

  /**
   * Загрузка стандортной работой
   * $this->OnInput();  - работа с входными данными
   * $this->OnOutput(); - работа с выходными данными
   */
  public function Request()
  {
    $this->OnInput();
    $this->OnOutput();
  }

  /**
   * Проверка текущего метода HTTP REQUEST
   * @return bool - если HTTP REQUEST METHOD = GET
   */
  protected function IsGet()
  {
    return ($_SERVER['REQUEST_METHOD'] === 'GET');
  }

  /**
   * Проверка текущего метода HTTP REQUEST
   * @return bool - если HTTP REQUEST METHOD = POST
   */
  protected function IsPost()
  {
    return ($_SERVER['REQUEST_METHOD'] === 'POST');
  }
}

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
    $this->_menu = "Содержимое меню";
    $this->_header = "Содержимое шапки";
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
    $template_pathname = "v/v_main.tpl";
    $content_array = array('menu' => $this->_menu, 'title' => $this->_title, 'header' => $this->_header,
      'content' => $this->_content, 'footer' => $this->_footer);

    $v = new Viewer();
    $page = $v->render($template_pathname, $content_array);
    echo $page;
  }
}


/**
 * Class C_View
 *
 * класс реализует контролёра целью которого является:
 * - передача Мехаику данных для обработки входных и подготовки выходных данных,
 * (здесь реализуется подшаблон списка статей)
 * - передача Видеопроектору выходных данных для реализации своего подшаблона.@deprecated
 * - передача управления классу-предку для слияния всех шаблонов и вывода результата.
 *(здесь слияние реализует страницу HTML со списком статей)
 */
class C_View extends C_Base
{
  /**
   * @var array[Article] содержит все выбранные из БД записи статей
   */
  protected $_articles;
  /**
   * @var string при array[Article]===null держит ошибку при неудачном запросе
   */
  protected $_error;


  /**
   * Анализ входных данных, передача работы Механику, для подготовки выходных данных.@deprecated
   * сохранение данных array[Article] в $_articles
   */
  protected function OnInput()
  {
    parent::OnInput();
    $this->_title .= '::Просмотр списка статей';

    $model = new Model();
    $this->_articles = $model->getArticles();
    $this->_error = $model->getError();
  }

  /**
   * Передача данных для реализации собственного подшаблона (списка статей)
   * Видеопроектору
   *
   * Вызов метода предка parent::OnOutput() для слияния всех подшаблонов и вывода результата.
   */
  protected function OnOutput()
  {
    $arr = array('error' => nl2br($this->_error), 'articles' => $this->_articles);

    $v = new Viewer();

    $this->_content = $v->render("v/v_list.tpl", $arr);
    parent::OnOutput();
  }
}


/**
 * Class C_Edit
 *
 * класс реализует контролёра целью которого является:
 * - передача Мехаику данных для обработки входных и подготовки выходных данных,
 * (здесь реализуется подшаблон редактирования статьи, ключ в $_GET['id'])
 * - передача Видеопроектору выходных данных для реализации своего подшаблона.
 * - передача управления классу-предку для слияния всех шаблонов и вывода результата.
 *(здесь слияние реализует страницу HTML с формой редактирования статьи)
 */
class C_Edit extends C_Base
{
  /**
   * @var string при Article===null держит ошибку при неудачном запросе
   */
  protected $_error;
  /**
   * @var Article - объект класса, описывает редактируемую статью
   */
  protected $_article;

  /**
   * Анализ входных данных, передача работы Механику, для подготовки выходных данных.
   * сохранение данных статьи в $_article
   */
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
    {
      $this->_title .= '::Редактирование статьи';

      $model = new Model();
      $this->_article = $model->getArticle((int)$_GET['id']);
      $this->_error = $model->getError();
    }
  }

  /**
   * Передача данных для реализации собственного подшаблона (редактирование статьи)
   * Видеопроектору
   *
   * Вызов метода предка parent::OnOutput() для слияния всех подшаблонов и вывода результата.
   */
  protected function OnOutput()
  {
    $arr = array('error' => nl2br($this->_error), 'article' => $this->_article);

    $v = new Viewer();
    $this->_content =$v->render("v/v_edit.tpl", $arr);
    parent::OnOutput();
  }
}