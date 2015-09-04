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
    public function getArticles($id = null) {
        $articles = array();
        $this->_error = "";
        $server = new DBMS();
        $result = $server->select($id);

        if( !$result) {
            $this->_error = $server->error_message . PHP_EOL . $server->error_num;
        } else {
            foreach($result as $arr) {
                $values = array();
                foreach($arr as $k => $v) {
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
