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

//  /**
//   * @var M_Editor
//   */
//  protected $_model;
//
//  /**
//   * C_Editor constructor.
//   */
//  public function __construct()
//  {
//    $this->_model = new M_Editor();
//  }

  /**
   * Анализ входных данных, передача работы Механику, для подготовки выходных данных.
   * сохранение данных array[Article] в $_articles
   */
  protected function OnInput()
  {
    parent::OnInput();

    // работаем со списком статей
    $this->_title .= '::Просмотр списка статей для редактирования';
    $this->_articles = $this->_model->getArticles();
    $this->_error = $this->_model->getError();
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

    $this->_content = $this->_viewer->render("v/v_editor.tpl", $archive);
    parent::OnOutput();
  }

}