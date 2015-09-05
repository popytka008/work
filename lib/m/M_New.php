<?php


/**
 * Created by PhpStorm.
 * User: Андрей
 * Date: 03.09.2015
 * Time: 19:45
 */
class M_New extends Model
{

  public function addArticle(array $array)
  {
    $this->_error = "";

    if (!($this->_result = $this->_databaseManager->insert($array))) {
      $this->_error = $this->_databaseManager->_error_message . PHP_EOL . $this->_databaseManager->_error_num;
    }
  }
}