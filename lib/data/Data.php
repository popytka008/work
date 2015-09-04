<?php


class Data
{
  /***** connection data *****/
  /**
   * ����� �������
   */
    const SERVER = "localhost:3306";
  /**
   * ��� �������
   */
    const USERNAME = "root";
  /**
   * ������ �������
   */
    const PASSWORD = "";
  /**
   * ���� ������
   */
    const DB = "documents";


    /* name of table */
  /**
   * ��� �������
   */
    const TABLE = "articles";
    /* fields of table */
  /**
   * ��� ������ ������� �������
   */
    const FIRST_COLUMN = "id_article";
  /**
   * ��� ������ �������
   */
    const SECOND_COLUMN = "title_article";
  /**
   * ��� ������� �������
   */
    const THIRD_COLUMN = "content_article";

  /**
   * ��� SQL-��������
   */
    const SELECT = "select";
  /**
   * ��� SQL-��������
   */
    const INSERT = "insert";
  /**
   * ��� SQL-��������
   */
    const UPDATE = "update";
  /**
   * ��� SQL-��������
   */
    const DELETE = "delete";

    /**
     * ��������� �� ������� � ������������������ ����� (����������� �������),
     * ������ �� ������� ������������� ���������� ���������
     *
     * @param $arr array ��������� � ���� �������
     * @return string
     */
  static public function prepareParams($arr)
  {

    return '\'' . implode("', '", $arr) . '\'';
    }


}