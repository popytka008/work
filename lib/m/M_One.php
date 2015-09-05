<?php

/**
 * Created by PhpStorm.
 * User: alex
 * Date: 04.09.15
 * Time: 8:38
 */
class M_One extends Model
{
  /**
   * @param $id int ключ выборки CRUD-запроса БД
   * @return Article объект, описывающий статью
   */
  public function getArticle($id)
  {
    $this->_error = "";
    $this->_result = $this->_databaseManager->select($id);

    if (!$this->_result) {
      $this->_error = $this->_databaseManager->_error_message . PHP_EOL . $this->_databaseManager->_error_num;
    }

    return $this->_result[0];
  }
}