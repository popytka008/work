<?php

require_once "lib/components/DBMS.php";


class Model {

    protected $_result;
    protected $_error;

    public function createList() {

    }

    /**
     * Выборка из таблицы строки данных по ключу (если он есть),
     * если ключа нет - из таблицы выбираются все данные.
     * @param int | null $id - ключ в таблице
     */
    public function getTableRows($id = null) {
        $server = new DBMS();

        if ( !$this->_result = $server->select($id)) {
            $this->_error = "{$server->error_message}\n;";
            $this->_error .= "{$server->error_message}.";
        }
    }

    /**
     * @return array | null
     */
    public function getResult() {
        return $this->_result;
    }

    /**
     * @return string
     */
    public function getError() {
        return $this->_error;
    }


    public function isGet() {
//        $str = '/*----------------------- вход и выход в Model()->isGet() -------------------*/'.PHP_EOL;
//        File::append('test_file.txt', $str);


        return ($_SERVER['REQUEST_METHOD'] === 'GET') ?'true' :'false';
    }
    public function isPost() {
//        $str = '/*----------------------- вход и выход в Model()->isPost() -------------------*/'.PHP_EOL;
//        File::append('test_file.txt', $str);

        return ($_SERVER['REQUEST_METHOD'] === 'POST') ?'true' :'false';
}

    public function getMethod() {
//        $str = '/*----------------------- вход и выход в Model()->getMethod() -------------------*/'.PHP_EOL;
//        File::append('test_file.txt', $str);

        return $_SERVER['REQUEST_METHOD'];
    }
}