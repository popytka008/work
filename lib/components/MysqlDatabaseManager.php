<?php

/**
 * Created by PhpStorm.
 * User: alex
 * Date: 05.09.15
 * Time: 13:19
 */
class MysqlDatabaseManager extends AbstractDatabaseManager
{


  static public function getInstance()
  {
    if (!self::$_instance) {
      self::$_instance = new MysqlDatabaseManager(MysqlConnection::getInstance());
      self::$_instance->_connection->Connect();
    }

    return self::$_instance;
  }

  public function select($id = null)
  {
    //$query = "SELECT * FROM `articles`";
    $query = QueryConstructor::getQueryStatic(Data::SELECT, null, '*', $id);

    if ($r = mysql_query($query)) {

      $n = mysql_num_rows($r);

      for ($i = 0; $i < $n; $i++) {
        $row = mysql_fetch_array($r);
        $this->_result[] = new Article($row);
      }
    } else {
      $this->_error_message = mysql_error();
      $this->_error_num = mysql_errno();
      $this->_result = null;
    }

    return $this->_result;
  }

  public function insert($argv)
  {
    $query = QueryConstructor::getQueryStatic(Data::INSERT, $argv, null, null);

    return $this->_getResult($query);
  }

  protected function _getResult($query)
  {
    if ($r = mysql_query($query)) {
      $this->_result = $r;
    } else {
      $this->_error_message = mysql_error();
      $this->_error_num = mysql_errno();
      $this->_result = null;
    }

    return $this->_result;
  }

  public function update($argv, $id = null)
  {
    $query = QueryConstructor::getQueryStatic(Data::UPDATE, $argv, null, $id);

    return $this->_getResult($query);
  }

  public function delete($id = null)
  {
    $query = QueryConstructor::getQueryStatic(Data::DELETE, null, null, $id);

    return $this->_getResult($query);
  }
}