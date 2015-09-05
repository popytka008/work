<?php

/**
 * Created by PhpStorm.
 * User: alex
 * Date: 05.09.15
 * Time: 13:01
 */
abstract class AbstractDatabaseManager
{
  static protected $_instance;
  public $_error_message;
  public $_error_num;
  protected $_connection;
  protected $_result;

  protected function __construct(AbstractConnection $connection)
  {
    $this->_connection = $connection;
    $this->_connection->connect();
  }

  abstract public function select($id = null);

  abstract public function insert($argv);

  abstract public function update($argv, $id = null);

  abstract public function delete($id = null);
}


