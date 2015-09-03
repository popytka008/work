<?php

require_once 'lib/m/MModel.php';
require_once "lib/components/DBMS.php";


class M_Delete extends Model {


    public function deleteArticle($id) {
        //echo '<br/>Сохранение статьи в model->saveArticle($params, $id): <br/>';
        //echo var_export($article).'<br/>';

        $this->_error = "";
        $server = new DBMS();
        if( !($this->_result = $server->delete($id))) {
            $this->_error = $server->error_message . PHP_EOL . $server->error_num;
        }
    }
}