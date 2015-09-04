<?php


/**
 * Created by PhpStorm.
 * User: Андрей
 * Date: 03.09.2015
 * Time: 19:45
 */
class M_New extends Model
{

  public function addArticle($array)
  {
    $this->_error = "";
    $server = new DBMS();
    if (!($this->_result = $server->insert($array))) {
      $this->_error = $server->error_message . PHP_EOL . $server->error_num;
    }
  }
}