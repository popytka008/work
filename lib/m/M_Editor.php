<?php

/**
 * Created by PhpStorm.
 * User: alex
 * Date: 04.09.15
 * Time: 8:38
 */
class M_Editor extends Model
{
  /**
   * @param null | int $id ключ для выборки CRUD-запроса БД
   * @return array массив статей (пустой (с записью ошибки) или полный)
   */
  public function getArticles()
  {
    $this->_error = "";
    $this->_result = $this->_databaseManager->select();

    if (!$this->_result) {
      $this->_error = $this->_databaseManager->_error_message . PHP_EOL . $this->_databaseManager->_error_num;
    }

    return $this->_result;
  }
}