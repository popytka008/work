<?php

class Article
{
  protected $_id;
  protected $_title;
  protected $_content;

  protected $_id_naming;
  protected $_title_naming;
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
   * @return mixed
   */
  public function getContent()
  {
    return $this->_content;
  }

  /**
   * @return mixed
   */
  public function getContentTruncated()
  {
    return
      (strlen($this->_content) > 250)
        ? substr($this->_content, 0, 220)
        : $this->_content;
  }

  /**
   * @return mixed
   */
  public function getTitle()
  {
    return $this->_title;
  }

  /**
   * @return mixed
   */
  public function getId()
  {
    return $this->_id;
  }


}