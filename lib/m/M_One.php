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

    $article = new Article(array());
    $this->_error = "";
    $server = new DBMS();
    $result = $server->select($id);

    if (!$result) {
      $this->_error = $server->error_message . PHP_EOL . $server->error_num;
    } else {
      $values = array();
      foreach ($result[0] as $v) {
        $values[] = $v;
      }
      $article = new Article($values);
    }

    //echo '<br/>Создание статьи в model->getArticle($id): <br/>';
    //echo var_export($article).'<br/>';

    $this->_result = $article;

    return $article;
  }
}