<?php

/**
 * Created by PhpStorm.
 * User: alex
 * Date: 05.09.15
 * Time: 12:17
 */
class MysqlConnection extends AbstractConnection
{
  protected $_server;
  protected $_username;
  protected $_password;
  protected $_db;
  protected $_resource;

  static public function getInstance()
  {
    if (!self::$_instance)
      self::$_instance = new MysqlConnection();

    return self::$_instance;
  }

  public function Connect()
  {
    if (!$this->_resource) {
      $this->_resource = mysql_connect(Data::SERVER, Data::USERNAME, Data::PASSWORD);
      mysql_select_db(Data::DB, $this->_resource);
    }
  }

  public function Disconnect()
  {
    if ($this->_resource) mysql_close($this->_resource);
  }

  /**
   * @return string
   */
  public function test_connection()
  {
    return ($this->isConnected() === true) ? 'Соединение существует!' : 'Соединение не существует..';
  }

  public function isConnected()
  {
    return $this->_resource;
  }
}
