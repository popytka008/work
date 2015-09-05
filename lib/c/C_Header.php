<?php

/**
 * Класс описывает шапку веб-страницы
 */
class C_Header extends Controller
{
  /**
   * Загрузка стандартной работой
   * $this->OnInput();  - работа с входными данными
   * $this->OnOutput(); - работа с выходными данными
   * @ret string результат работы контролёра над подвалом
   */
  public function Request()
  {
    $this->OnInput();
    return $this->OnOutput();
  }


  /**
   * Перечень процедур для работы с входными данными
   */
  protected function OnInput()
  {

  }

  /**
   * Перечень процедур для работы с выходными данными
   * @ret string результат работы Видеопроектора над подвалом
   */
  protected function OnOutput()
  {
    $archive = array();

    $v = new Viewer();
    return $v->render("v/v_header.tpl", $archive);
  }

}