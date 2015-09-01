<?php

require_once "Connection.php";
require_once "QueryConstructor.php";


class DBMS {

    public $error_message;
    public $error_num;
    protected $_result;
    protected $_connection;

    public function __construct() {
        $this->_connection = new Connection();
    }

    /**
     * @param null | int $id
     * @return null | array
     */
    public function select($id = null) {
        $query = QueryConstructor::getQueryStatic(Data::SELECT, null, '*', $id);

//        echo '<br/>Создание запроса SELECT->QueryConstructor::getQueryStatic: <br/>';
//        echo var_export($query).'<br/>';
        //$this->_connection->Open();

        if ($r = mysql_query($query)) {
            while ($arr = mysql_fetch_assoc($r))
                $this->_result[] = $arr;
        } else {
            $this->_error_message = mysql_error();
            $this->_error_num = mysql_errno();
            $this->_result = null;
        }

        //$this->_connection->Close();

        return $this->_result;
    }

    public function update($params, $id = null) {
        $query = QueryConstructor::getQueryStatic(Data::UPDATE, $params, null, $id);

//        echo '<br/>Создание запроса UPDATE->QueryConstructor::getQueryStatic: <br/>';
//        echo var_export($query).'<br/>';
        // целое число - количество измененных строк
        return $this->_getResult($query);
    }

    public function insert($params) {

        $query = QueryConstructor::getQueryStatic(Data::INSERT, $params, null, null);

//        echo '<br/>Создание запроса INSERT->QueryConstructor::getQueryStatic: <br/>';
//        echo var_export($query).'<br/>';
        //$this->_connection->Open();

        // целое число - количество измененных строк
        return $this->_getResult($query);
    }

    public function delete($id = null) {
        $query = QueryConstructor::getQueryStatic(Data::DELETE, null, null, $id);

//        echo '<br/>Создание запроса DELETE->QueryConstructor::getQueryStatic: <br/>';
//        echo var_export($query).'<br/>';

        //$this->_connection->Open();

        // целое число - количество измененных строк
        return $this->_getResult($query);
    }

    /**
     * @param $query string
     * @return null|resource
     */
    protected function _getResult($query) {
        if ($r = mysql_query($query)) {
            $this->_result = $r;
        } else {
            $this->_error_message = mysql_error();
            $this->_error_num = mysql_errno();
            $this->_result = null;
        }

        //$this->_connection->Close();

        return $this->_result;
    }
}