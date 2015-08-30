<?php

class File {
  protected $_file_handler;
  protected $_file_name;
  protected $_mode;


  function __construct($_file_name, $_mode)
  {
    $this->_file_name = $_file_name;
    $this->_mode = $_mode;
  }


  public function exist(){
    return file_exists($this->_file_name);
  }
  public function open(){
    if($this->_file_handler) $this->close();

    $this->_file_handler = fopen($this->_file_name, $this->_mode);
  }
  public function close(){
    if($this->_file_handler) fclose($this->_file_handler);

    $this->_file_handler = null;
  }

  public function addString($str){
    if(!$this->_file_handler) $this->open();

    fputs($this->_file_handler, $str, strlen($str));

    $this->close();
  }

  public function fileSize(){
    if($this->exist()){
      return filesize($this->_file_name);
    }
    return null;
  }

  public function getAll(){
    if($this->exist()){

      if($this->_file_handler) $this->close();

      return file($this->_file_name);
    }

    return null;
  }

  static public function getFile($file_name){
    if(file_exists($file_name))
      return file($file_name);
    else
      return null;
  }

  static public function append($file_name, $str){
    $file = new File($file_name, 'a+');
    $file->addString($str);
    $file = null;
  }
}
