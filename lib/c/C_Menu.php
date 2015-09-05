<?php

/**
 * Created by PhpStorm.
 * User: alex
 * Date: 04.09.15
 * Time: 10:54
 */
class C_Menu extends Controller
{
  /**
   * Загрузка стандартной работой для создания элемента в виде HTML
   * $this->OnInput();  - работа (обработка, передача на обработку) с входными данными
   * $this->OnOutput(); - создание выходных данных
   */
  public function Request()
  {
    $this->OnInput();
    return $this->OnOutput();
  }

  /**
   * Заглушка (здесь: для всех элементов), назначает значения для реализации:
   * титула($_title), шапки($_header), меню($_menu), контента($_content), подвала($_footer).
   * Так же заглушаются и значения для подшаблона статьи (титул и содержимое статьи)
   *
   * (в нашем случае - создать соединение)
   *
   */
  protected function OnInput()
  {

  }


  /**
   * Передача всех данных Видеопроектору, для отображения.
   * Отображение.
   */
  protected function OnOutput()
  {
    $archive = array();

    $v = new Viewer();
    return $v->render("v/v_menu.tpl", $archive);
  }
}