<?php


class Data
{
  /***** connection data *****/
  /**
   * адрес сервера
   */
    const SERVER = "localhost:3306";
  /**
   * имя клиента
   */
    const USERNAME = "root";
  /**
   * пароль клиента
   */
    const PASSWORD = "";
  /**
   * база данных
   */
    const DB = "documents";


    /* name of table */
  /**
   * имя таблицы
   */
    const TABLE = "articles";
    /* fields of table */
  /**
   * имя первой колонки таблицы
   */
    const FIRST_COLUMN = "id_article";
  /**
   * имя второй колонки
   */
    const SECOND_COLUMN = "title_article";
  /**
   * имя третьей колонки
   */
    const THIRD_COLUMN = "content_article";

  /**
   * имя SQL-операции
   */
    const SELECT = "select";
  /**
   * имя SQL-операции
   */
    const INSERT = "insert";
  /**
   * имя SQL-операции
   */
    const UPDATE = "update";
  /**
   * имя SQL-операции
   */
    const DELETE = "delete";

    /**
     * Переделка из массива в полседовательность строк (разделенную запятой),
     * каждый из токенов оборачивается одинарными кавычками
     *
     * @param $arr array параметры в виде массива
     * @return string
     */
  static public function prepareParams($arr)
  {

    return '\'' . implode("', '", $arr) . '\'';
    }


}