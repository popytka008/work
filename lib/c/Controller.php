<?php


/**
 * Class Controller ������� ����������� ����� ���������
 * �������� �������� ��������� �������� � �������� �������� ����������.
 * ������:
 * -- �����������
 * OnInput()  void
 * OnOutput() void
 * -- ������������
 * Request()  void
 * IsGet()    boolean
 * IsPost()   boolean
 * Template() string
 *
 * ���� � ����� ����������� �������:
 * OnInput()  void - ����� ������ ��������� ������ ��� ��������� ����� �� �������:
 *                   ������� ��, ���������� �����������.
 * OnOutPut() void - ����� ��������� ������ �� ���������� �������� ������ �������
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
    return ($_SERVER['REQUEST_METHOD'] === 'GET') ? 'true' : 'false';
  }

  protected function IsPost()
  {
    return ($_SERVER['REQUEST_METHOD'] === 'POST') ? 'true' : 'false';
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
 * ����������: ���������� �������������� � "���������" - �� ��������.
 *             �� ���� ������� ���� ���������� �������� � ������� � �������� ��������.
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
   * ��������, ��������� �������� �� ������ ������ ��� $title � $content
   * (� ����� ������ - ������� ����������)
   *
   */
  protected function OnInput()
  {
    $this->_title = "������";
    $this->_menu = "���������� ����";
    $this->_header = "���������� �����";
    $this->_content = "���������� �������� �����";
    $this->_footer = "���������� �������";

    $this->_id_article = 0;
    $this->_title_article = "��������� ������";
    $this->_content_article = "���������� ������";

    Model::connect();
  }

  /**
   * ������� �������� � �������� ��������
   * (�������� ����������)
   */
  protected function OnOutput()
  {
    $template_pathname = "v/v_main.php";
    $content_array = array('menu' => $this->_menu, 'title' => $this->_title, 'header' => $this->_header,
      'content' => $this->_content, 'footer' => $this->_footer);
    $page = $this->Template($template_pathname, $content_array);

    Model::disconnect();

    Viewer::out($page);
  }
}

/**
 * Class C_View
 *
 * ������� ������ �������� ������� ������ (������ ��������), �������� ������� v_list.php
 * � ����������� ��������� � �������� $this->content
 */
class C_View extends C_Base
{
  protected $_articles;
  protected $_error;


  protected function OnInput()
  {
    parent::OnInput();
    $this->_title .= '::�������� ������ ������';

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
 * ������ � ����� �������������� (v_edit) ��������
 * ��������� ������������ ��������� (������������) ������ � �����.
 */
class C_Edit extends C_Base
{
  protected $_error;
  protected $_article;
  protected $_id;

  public function __construct($id){
    $this->_id = (int)$id;
  }

  protected function OnInput()
  {
    parent::OnInput();

    // ������� ���������� ����� ������� - get / post
    // ���� post - �������� ������ � �������� ������
    if($this->IsPost())
    {
      $model = new Model();
      $model->saveArticle(array($_POST['id_article'], $_POST['title_article'], $_POST['content_article']));
      http_redirect("index.php");
    }

    // ����� get - �������� ������

    $this->_title .= '::�������������� ������';

    $model = new Model();
    $this->_article = $model->getArticle($this->_id);
    $this->_error = $model->getError();
  }

  protected function OnOutput()
  {
    $arr = array('error' => nl2br($this->_error), 'article' => $this->_article);

    $this->_content = $this->Template("v/v_edit.tpl", $arr);
    parent::OnOutput();
  }
}