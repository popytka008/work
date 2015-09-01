<?php

require_once "lib/components/DBMS.php";
require_once "lib/components/Article.php";


class Model {

    protected $_result;
    protected $_error;


    public function getArticles($id = null)
    {
        $articles = array();
        $this->_error = "";
        $server = new DBMS();
        $result = $server->select($id);

        if (!$result) {
            $this->_error = $server->error_message . PHP_EOL . $server->error_num;
        } else {
            foreach ($result as $arr) {
                $values = array();
                foreach ($arr as $k => $v) {
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


    public function getArticle($id){

        $article = new Article(array());
        $this->_error = "";
        $server = new DBMS();
        $result = $server->select($id);

        if (!$result) {
            $this->_error = $server->error_message . PHP_EOL . $server->error_num;
        } else {
            $values = array();
            foreach($result[0] as $k => $v){
                $values[] = $v;
            }
            $article = new Article($values);
        }

        //echo '<br/>Создание статьи в model->getArticle($id): <br/>';
        //echo var_export($article).'<br/>';

        $this->_result = $article;
        return $article;
    }


    public function saveArticle($array)
    {
        //echo '<br/>Сохранение статьи в model->saveArticle($params, $id): <br/>';
        //echo var_export($article).'<br/>';

        $this->_error = "";
        $server = new DBMS();
        if(!($this->_result = $server->update(array($array[1], $array[2]), $array[0]))){
            $this->_error = $server->error_message . PHP_EOL . $server->error_num;
        }
    }

    public function deleteArticle($id)  {
        //echo '<br/>Сохранение статьи в model->saveArticle($params, $id): <br/>';
        //echo var_export($article).'<br/>';

        $this->_error = "";
        $server = new DBMS();
        if(!($this->_result = $server->delete($id))){
            $this->_error = $server->error_message . PHP_EOL . $server->error_num;
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