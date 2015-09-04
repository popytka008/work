<?php


/**
 * Class M_Edit
 * Работает со своим  Контролёром и Видеопроектором
 * Вычисляет (используя низкоуровневые утилиты) результат CRUD-запроса БД в данном случае это запрос UPDATE SELECT(id)
 * методы: public function getArticle($id),function saveArticle($array)
 */
class M_Edit extends Model {

  /**
   * @param $id int ключ выборки CRUD-запроса БД
   * @return Article объект, описывающий статью
   */
    public function getArticle($id) {

        $article = new Article(array());
        $this->_error = "";
        $server = new DBMS();
        $result = $server->select($id);

        if( !$result) {
            $this->_error = $server->error_message . PHP_EOL . $server->error_num;
        } else {
            $values = array();
            foreach($result[0] as $k => $v) {
                $values[] = $v;
            }
            $article = new Article($values);
        }

        //echo '<br/>Создание статьи в model->getArticle($id): <br/>';
        //echo var_export($article).'<br/>';

        $this->_result = $article;

        return $article;
    }


  /**
   * вычисление CRUD-запроса БД UPDATE, при неудаче - записать ошибку
   * @param $array array запакованные параметры для CRUD-запроса БД UPDATE
   */
    public function saveArticle($array) {
        //echo '<br/>Сохранение статьи в model->saveArticle($params, $id): <br/>';
        //echo var_export($article).'<br/>';

        $this->_error = "";
        $server = new DBMS();
        if( !($this->_result = $server->update(array($array[1], $array[2]), $array[0]))) {
            $this->_error = $server->error_message . PHP_EOL . $server->error_num;
        }
    }
}