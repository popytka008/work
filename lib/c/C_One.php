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
//  /**
//   * @var M_One
//   */
//  protected $_model;
//
//  /**
//   * C_One constructor.
//   */
//  public function __construct()
//  {
//    $this->_model = new M_One();
//  }
  /**
   * Передача работы Механику, для подготовки выходных данных.
   * сохранение данных array[Article] в $_articles
   */
  protected function OnInput()
  {
    parent::OnInput();

    // работаем с одной статьёй
    $this->_title .= '::Просмотр статьи';
    $this->_article = $this->_model->getArticle((int)$_GET['id']);
    $this->_error = $this->_model->getError();
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

    $this->_content = $this->_viewer->render("v/v_one.tpl", $archive);
    parent::OnOutput();
  }
}