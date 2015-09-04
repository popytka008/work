<?php

/**
 * Created by PhpStorm.
 * User: alex
 * Date: 04.09.15
 * Time: 8:37
 */
class C_One extends C_Base
{
  /**
   * @var array[Article] содержит все выбранные из БД записи статей
   */
  protected $_article;
  /**
   * @var string при array[Article]===null держит ошибку при неудачном запросе
   */
  protected $_error;


  /**
   * Передача работы Механику, для подготовки выходных данных.
   * сохранение данных array[Article] в $_articles
   */
  protected function OnInput()
  {
    parent::OnInput();
    $model = new M_One();

    // работаем с одной статьёй
    $this->_title .= '::Просмотр статьи';
    $this->_article = $model->getArticle((int)$_GET['id']);
    $this->_error = $model->getError();
  }

  /**
   * Передача данных для реализации собственного подшаблона (одна сатья)
   * Видеопроектору
   *
   * Вызов метода предка parent::OnOutput() для слияния всех подшаблонов и вывода результата.
   */
  protected function OnOutput()
  {
    $archive = array('error' => nl2br($this->_error), 'article' => $this->_article);

    $v = new Viewer();

    $this->_content = $v->render("v/v_one.tpl", $archive);
    parent::OnOutput();
  }
}