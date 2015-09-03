<?php


class Model {

    protected $_result;
    protected $_error;



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


        return ($_SERVER['REQUEST_METHOD'] === 'GET');
    }
    public function isPost() {
//        $str = '/*----------------------- вход и выход в Model()->isPost() -------------------*/'.PHP_EOL;
//        File::append('test_file.txt', $str);

        return ($_SERVER['REQUEST_METHOD'] === 'POST');
    }

    public function getMethod() {
//        $str = '/*----------------------- вход и выход в Model()->getMethod() -------------------*/'.PHP_EOL;
//        File::append('test_file.txt', $str);

        return $_SERVER['REQUEST_METHOD'];
    }
}