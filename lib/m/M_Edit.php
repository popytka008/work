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
  public function getArticle($id)
  {
    $this->_error = "";

    $result = $this->_databaseManager->select($id);

    if (!$result) {
      $this->_error = $this->_databaseManager->_error_message . PHP_EOL . $this->_databaseManager->_error_num;
    }

    return $this->_result = $result[0];
  }

  /**
   * вычисление CRUD-запроса БД UPDATE, при неудаче - записать ошибку
   * @param $array array запакованные параметры для CRUD-запроса БД UPDATE
   */
  public function saveArticle(array $array)
  {

        $this->_error = "";
    if (!($this->_result = $this->_databaseManager->update(array($array[1], $array[2]), $array[0]))) {
      $this->_error = $this->_databaseManager->_error_message . PHP_EOL . $this->_databaseManager->_error_num;
        }
    }
}