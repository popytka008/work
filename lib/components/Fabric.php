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
        return new C_New(new M_New());  // ������� ������ ����� ����� ������

      case 'edit':
        return new C_Edit(new M_Edit()); // ������� ����� ��������������

      case 'editor':
        return new C_Editor(new M_Editor()); // ������� ������ ���������� ������

      case 'one':
        return new C_One(new M_One()); // ������� ��������� ������

      default: // ������� ����
        return new C_List(new M_List()); // ������� ������ ������
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
        return new C_Delete(new M_Delete());// ���������� �������� ������

      case 'insert':
      case 'new':
        return new C_New(new M_New());   // ���������� ������� ������

      case 'update':
        return new C_Edit(new M_Edit());  // ���������� ���������� ������

      default:
        return null;
    }
  }
}