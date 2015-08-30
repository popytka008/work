<?php
require_once "lib/data/data.php";


class Connection
{

  static protected $_connection;


  public function __construct()
  {
    if(!$this->isConnected()) {
      $this->open();
    }
  }


  protected function isConnected()
  {
    return self::$_connection !== null;
  }


  public function open(){
    if(!$this->isConnected()){
      self::$_connection = mysql_connect(Data::SERVER, Data::USERNAME, Data::PASSWORD);
      mysql_select_db(Data::DB);
    }
  }


  public function close(){
    if($this->isConnected()){
      mysql_close(self::$_connection);
      self::$_connection  = null;
    }
  }

  static public function getConnection()
  {
    if (!Connection::$_connection)  new Connection();

    return Connection::$_connection;
  }


}