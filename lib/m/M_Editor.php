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
    $articles = array();
    $this->_error = "";
    $server = new DBMS();
    $result = $server->select();

    if (!$result) {
      $this->_error = $server->error_message . PHP_EOL . $server->error_num;
    } else {
      foreach ($result as $arr) {
        $values = array();
        foreach ($arr as $v) {
          $values[] = $v;
        }
        $articles[] = new Article($values);
      }
    }
    //echo '<br/>Создание статьи в model->getArticles(): <br/>';
    //echo var_export($articles) . '<br/>';

    $this->_result = $articles;

    return $articles;
  }
}