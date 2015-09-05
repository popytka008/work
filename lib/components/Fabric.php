<?php

/**
 * Created by PhpStorm.
 * User: alex
 * Date: 05.09.15
 * Time: 1:07
 */
class Fabric
{
  /**
   * @param $mark string
   * @return C_Edit|C_Editor|C_List|C_New|C_One
   */
  public function getObject($mark)
  {
    switch ($mark) {
      case 'new':
        return new C_New(new M_New());  // вывести пустую форму новой статьи

      case 'edit':
        return new C_Edit(new M_Edit()); // вывести форму редактирования

      case 'editor':
        return new C_Editor(new M_Editor()); // вывести список заголовков статей

      case 'one':
        return new C_One(new M_One()); // вывести выбранную статью

      default: // простой вход
        return new C_List(new M_List()); // вывести список статей
    }
  }

  /**
   * @param $mark string
   * @return C_Delete|C_Edit|C_New|null
   */
  public function postObject($mark)
  {
    switch ($mark) {
      case 'delete':
        return new C_Delete(new M_Delete());// обработать удаление статьи

      case 'insert':
      case 'new':
        return new C_New(new M_New());   // обработать вставку статьи

      case 'update':
        return new C_Edit(new M_Edit());  // обработать обновление статьи

      default:
        return null;
    }
  }
}