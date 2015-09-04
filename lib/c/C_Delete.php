<?php


/**
 * Class C_Delete
 *
 * класс реализует контролёра целью которого является:
 * - передача Мехаику данных для обработки входных и подготовки выходных данных,
 * (здесь реализуется подшаблон редактирования статьи, ключ в $_GET['id'])
 * - передача Видеопроектору выходных данных для реализации своего подшаблона.
 * - передача управления классу-предку для слияния всех шаблонов и вывода результата.
 *(здесь слияние реализует страницу HTML с формой редактирования статьи)
 */
class C_Delete extends C_Base
{

  /**
   * @var string держит ошибку при неудачном запросе при Article===null
   */
  protected $_error;
  /**
   * @var Article - объект класса, описывает удаляемую статью
   */
  protected $_article;

  /**
   * Анализ входных данных, передача работы Механику, для подготовки выходных данных.
   * сохранение данных статьи в $_article
   */
  protected function OnInput()
  {
    parent::OnInput();

    $this->_title .= '::Редактирование статьи';
    $model = new M_Delete();
    $model->deleteArticle((int)$_POST['id_article']);


    // при удаче на главную страницу
    if (!($this->_error = $model->getError())) {
      header("Location: index.php");
    } else {
      // метод post- неудачное сохранение - повторить форму
      $this->_article = new Article(array($_POST['id_article'], $_POST['title_article'], $_POST['content_article']));
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
    $archive = array('error' => nl2br($this->_error), 'article' => $this->_article);

    $v = new Viewer();
    $this->_content = $v->render("v/v_edit.tpl", $archive);
    parent::OnOutput();
  }
}