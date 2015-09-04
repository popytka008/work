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

  protected function OnInput()
  {
    parent::OnInput();

    $model = new M_New();
    $this->_error = '';
    $this->_title .= "::Новая статья";


    if ($model->isGet()) {
      $this->_article = new Article(array('', '', ''));
    } else {
      // post - добавить строку (сохранить)
      $model->addArticle(array($_POST['title_article'], $_POST['content_article']));
      // если нет ощибок - на чтартовую страницу
      if (!($this->_error = $model->getError())) {
        header("Location: index.php");
      } else {
        //$archive = Array('title_article' => $_POST['title_article'],'content_article' => $_POST['content_article'], 'this->_error'=> $this->_error);
        $this->_article = new Article(array('', $_POST['title_article'], $_POST['content_article']));
      }
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