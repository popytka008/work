<?php


class C_New extends C_Base
{

  /**
   * Заглушка (здесь: для всех элементов), назначает значения для реализации:
   * титула($_title), шапки($_header), меню($_menu), контента($_content), подвала($_footer).
   * Так же заглушаются и значения для подшаблона статьи (титул и содержимое статьи)
   *
   * (в нашем случае - создать соединение)
   *
   */

  protected $_error;
  protected $_article;
//  /**
//   * @var M_New
//   */

  protected function OnInput()
  {
    parent::OnInput();

    $this->_error = '';
    $this->_title .= "::Новая статья";


    // post - добавить строку (сохранить) вывести результат предыдущего редактирования
    if (Model::isPost()) {

      $this->_model->addArticle(array($_POST['title_article'], $_POST['content_article']));

      // если нет ощибок - на чтартовую страницу
      if (!($this->_error = $this->_model->getError())) {
        header("Location: index.php");
      } else {
        $this->_article = new Article(array('', $_POST['title_article'], $_POST['content_article']));
      }
    }

    if (Model::isGet()) {
      $this->_article = new Article(array('', '', ''));
    }
  }

  /**
   * Передача всех данных Видеопроектору, для отображения.
   * Отображение.
   */
  protected function OnOutput()
  {
    $archive = array('error' => nl2br($this->_error), 'article' => $this->_article);

    $v = new Viewer();
    $this->_content = $v->render("v/v_new.tpl", $archive);
    parent::OnOutput();
  }
}