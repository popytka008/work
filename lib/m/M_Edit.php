<?php

require_once 'lib/m/Model.php';
require_once "lib/components/DBMS.php";
require_once "lib/components/Article.php";


class M_Edit extends Model {

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