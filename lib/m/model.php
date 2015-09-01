<?php

require_once "lib/components/DBMS.php";


class Model {

    protected $_result;
    protected $_error;
    static protected $_connection;


    static public function __construct(){
        self::$_connection = new Connection();
    }

    static public function connect(){
        self::$_connection->open();
    }
    static public function disconnect(){
        self::$_connection->close();
    }



    public function getArticle($id){
        $article = new Article(array());
        $this->_error = "";
        $server = new DBMS();
        $result = $server->select($id);

        if (!$result) {
            $this->_error .= $server->error_message . PHP_EOL . $server->error_num;
        } else {
            $values = array();
            foreach($result as $k => $v){
                $values[] = $v;
            }
            $article = new Article($values);
        }

        return $article;
    }



    public function getArticles($id = null){
        $articles = array();
        $this->_error = "";
        $server = new DBMS();
        $result = $server->select($id);

        if (!$result) {
            $this->_error .= $server->error_message . PHP_EOL . $server->error_num;
        } else {
            foreach($result as $arr){
                $values = array();
                foreach($arr as $k => $v){
                    $values[] = $v;
                }
                $articles[] = new Article($values);
            }
        }

        return $articles;
    }


    public function saveArticle($array)
    {
        $server = new DBMS();
        $server->update(array($array[1], $array[2]), $array[0]);
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