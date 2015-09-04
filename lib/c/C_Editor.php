<?php

/**
 * Created by PhpStorm.
 * User: alex
 * Date: 04.09.15
 * Time: 8:38
 */
class C_Editor extends C_Base
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
   * Анализ входных данных, передача работы Механику, для подготовки выходных данных.
   * сохранение данных array[Article] в $_articles
   */
  protected function OnInput()
  {
    parent::OnInput();
    $model = new M_Editor();

    // работаем со списком статей
    $this->_title .= '::Просмотр списка статей для редактирования';
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
    $archive = array('error' => nl2br($this->_error), 'articles' => $this->_articles);

    $v = new Viewer();

    $this->_content = $v->render("v/v_editor.tpl", $archive);
    parent::OnOutput();
  }

}