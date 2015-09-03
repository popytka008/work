<?php


/**
 * Class Article
 * Описывает сущность СТАТЬЯ - элемент таблицы БД Articles
 * $_id
 * $_title
 * $_content
 *
 * $_id_naming        наименование колонки таблицы
 * $_title_naming     наименование колонки таблицы
 * $_content_naming   наименование колонки таблицы
 *
 * __construct($values = array()) - поля статьи в массиве
 * getArticle()             изъять статью
 * getContent()             изъять основное содержимое статьи
 * getContentTruncated()    изъять усечённое до 200 символов основное содержимое статьи
 * getTitle()               изъять заголовок статью
 * getId()                  изъять ключ
 */
class Article
{

  /**
   * @var int ключевое поле статьи
   */
  protected $_id;
  /**
   * @var string заголовок статьи
   */
  protected $_title;
  /**
   * @var string содержимое статьи
   */
  protected $_content;

  /**
   * @var string имя поля таблицы
   */
  protected $_id_naming;
  /**
   * @var string имя поля таблицы
   */
  protected $_title_naming;
  /**
   * @var string имя поля таблицы
   */
  protected $_content_naming;


  /**
   * @param array $values
   */
  function __construct($values = array())
  {
    if(count($values)){
      $this->_id = $values[0];
      $this->_title = $values[1];
      $this->_content = $values[2];
    }else
    {
      $this->_id = "";
      $this->_title = "";
      $this->_content = "";
    }

    //именование имён полей таблицы статей
    $this->_id_naming = Data::FIRST_COLUMN;
    $this->_title_naming = Data::SECOND_COLUMN;
    $this->_content_naming = Data::THIRD_COLUMN;
  }

  /**
   * @return array
   */
  function getArticle()
  {
    return array($this->_id_naming => $this->_id, $this->_title_naming => $this->_title, $this->_content_naming => $this->_content);
  }

  /**
   * @return string
   */
  public function getContent()
  {
    return $this->_content;
  }

  /**
   * @return string усекновение содержимого статьи до 200 символов
   */
  public function getContentTruncated()
  {
    return
      (strlen($this->_content) > 250)
        ? substr($this->_content, 0, 220)
        : $this->_content;
  }

  /**
   * @return string
   */
  public function getTitle()
  {
    return $this->_title;
  }

  /**
   * @return int
   */
  public function getId()
  {
    return $this->_id;
  }


}