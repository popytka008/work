<?php


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
        $this->_error = "";

      if (!($this->_result = $this->_databaseManager->delete($id))) {
        $this->_error = $this->_databaseManager->_error_message . PHP_EOL . $this->_databaseManager->_error_num;
        }
    }
}