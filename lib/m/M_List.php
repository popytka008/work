<?php

require_once 'lib/m/MModel.php';
require_once "lib/components/DBMS.php";
require_once "lib/components/Article.php";


/**
 * Created by PhpStorm.
 * User: Андрей
 * Date: 03.09.2015
 * Time: 18:14
 */
class M_List extends Model {

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
