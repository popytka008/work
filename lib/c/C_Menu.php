<?php

/**
 * Created by PhpStorm.
 * User: alex
 * Date: 04.09.15
 * Time: 10:54
 */
class C_Menu extends C_Base
{
  public function getMenu()
  {
    $archive = array();

    $v = new Viewer();
    return $v->render("v/v_menu.tpl", $archive);
  }

  /**
   * Передача всех данных Видеопроектору, для отображения.
   * Отображение.
   */
  protected function OnOutput()
  {
    $archive = array();

    $v = new Viewer();
    $this->_menu = $v->render("v/v_menu.tpl", $archive);
  }
}