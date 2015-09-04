<?php

require_once 'lib/m/Model.php';
require_once "lib/components/DBMS.php";


/**
 * Class M_Delete
 * Работает со своим  Контролёром и Видеопроектором
 * Вычисляет (используя низкоуровневые утилиты) результат CRUD-запроса БД в данном случае это запрос DELETE
 * метод deleteArticle($id)
 */
class M_Delete extends Model {


  /**
   * @param $id int ключ для выборки CRUD-запроса БД DELETE
   */
    public function deleteArticle($id) {
        //echo '<br/>Сохранение статьи в model->saveArticle($params, $id): <br/>';
        //echo var_export($article).'<br/>';

        $this->_error = "";
        $server = new DBMS();
        if( !($this->_result = $server->delete($id))) {
            $this->_error = $server->error_message . PHP_EOL . $server->error_num;
        }
    }
}