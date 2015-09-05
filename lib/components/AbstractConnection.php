<?php

/**
 * Created by PhpStorm.
 * User: alex
 * Date: 05.09.15
 * Time: 10:11
 */
abstract class AbstractConnection
{
  static protected $_instance;

  protected function __construct()
  {
  }

  abstract public function Connect();

  abstract public function Disconnect();

  abstract public function isConnected();

}


