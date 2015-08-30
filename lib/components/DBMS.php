<?php

require_once "Connection.php";
require_once "QueryConstructor.php";

class DBMS
{
    public $error_message;
    public $error_num;

    protected $_result;
    protected $_connection;


    public function __construct()
    {
        $this->_connection = new Connection();
    }


    public function select($id = null){
      if($id)
          $query = QueryConstructor::getQueryStatic(Data::SELECT, null,'*',$id);
      else
          $query = QueryConstructor::getQueryStatic(Data::SELECT, null,'*');

      $this->_connection->Open();

        if($r = mysql_query($query)){
          while($arr = mysql_fetch_assoc($r))
            $this->_result[] = $arr;
        } else {
          $this->_error_message = mysql_error();
          $this->_error_num= mysql_errno();
          $this->_result = null;
        }
        $this->_connection->Close();

        return $this->_result;
    }

    public function update($params, $id){
        if($id)
            $query = QueryConstructor::getQueryStatic(Data::UPDATE, $params, null, $id);
        else
            $query = QueryConstructor::getQueryStatic(Data::UPDATE, $params);

        //$this->_connection->Open();

        // целое число - количество измененных строк
        if($r = mysql_query($query)){
            $this->_result = $r;
        } else {
            $this->_error_message = mysql_error();
            $this->_error_num= mysql_errno();
            $this->_result = null;
        }
        //$this->_connection->Close();

        return $this->_result;
    }

    public function insert($params, $id){

        $query = QueryConstructor::getQueryStatic(Data::INSERT, $params, null, $id);

        //$this->_connection->Open();

        // целое число - количество измененных строк
        if($r = mysql_query($query)){
            $this->_result = $r;
        } else {
            $this->_error_message = mysql_error();
            $this->_error_num= mysql_errno();
            $this->_result = null;
        }
        //$this->_connection->Close();

        return $this->_result;
    }

    public function delete($id = null){
        if($id)
            $query = QueryConstructor::getQueryStatic(Data::DELETE, null,null,$id);
        else
            $query = QueryConstructor::getQueryStatic(Data::DELETE);

        //$this->_connection->Open();

        // целое число - количество измененных строк
        if($r = mysql_query($query)){
            $this->_result = $r;
        } else {
            $this->_error_message = mysql_error();
            $this->_error_num= mysql_errno();
            $this->_result = null;
        }
        //$this->_connection->Close();

        return $this->_result;
    }
}