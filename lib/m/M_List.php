<?php




/**
 * Class M_List
 * Работает со своим  Контролёром и Видеопроектором
 * Вычисляет (используя низкоуровневые утилиты) результат CRUD-запроса БД в данном случае это запрос SELECT
 * метод getArticles($id = null)
 */
class M_List extends Model {

    /**
     * @param null | int $id ключ для выборки CRUD-запроса БД
     * @return array массив статей (пустой (с записью ошибки) или полный)
     */
    public function getArticles($id = null)
    {
        $this->_error = "";
        $this->_result = $this->_databaseManager->select($id);

        if (!$this->_result) {
            $this->_error = $this->_databaseManager->_error_message . PHP_EOL . $this->_databaseManager->_error_num;
        }

        return $this->_result;
    }
}
