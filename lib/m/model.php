<?php

require_once "lib/components/DBMS.php";

class Model
{

  protected $_result;
  public $error;


  public function createList()
  {

  }

  public function getTableRows($id = null)
  {
    $server = new DBMS();

    if (!$this->_result = $server->select($id)) {
      $_ = "Ошибка при выополнении запроса:\n{$server->error_message}\n;";
      $_ .= "Номер ошибки:\n{$server->error_message}.";
      $this->error = "<p>$_</p>";
    }
  }

  /**
   * @return mixed
   */
  public function getResult()
  {
    return $this->_result;
  }


  public function view_include($template_pathname, $content_array)
  {

    foreach ($content_array as $key => $item) {
      $$key = $item;
    }

    ob_start();
    include $template_pathname;
    return ob_get_clean();
  }

}