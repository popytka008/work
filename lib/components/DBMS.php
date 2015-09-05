<?php

require_once "Connection.php";
require_once "QueryConstructor.php";


/**
 * Class DBMS
 * класс управления запросами к БД
 * контролирует соединение с БД
 * содержит аттрибуты:
 * хранения текущей ошибки -
 * $error_message,
 * хранения номера текущей ошибки -
 * $error_num,
 * хранения результата запроса -
 * $_result,
 * хранения ярлыка соединения -
 * $_connection
 *
 * *** методы ***
 * __construct()
 * select($id = null)
 * update($params, $id = null)
 * insert($params)
 * _getResult($query) *
 */
class DBMS
{

  /**
   * @var string хранения текущей ошибки
   */
  public $error_message;
  /**
   * @var int хранения номера текущей ошибки
   */
  public $error_num;
  /**
   * @var int | array | null хранения результата запроса к БД
   */
  protected $_result;
  /**
   * @var Connection - объект подключения к БД
   */
  protected $_connection;

  /**
   * содаётся объект соединения с БД (и подключение к НЕЙ) и передается внутреннему аттрибуту
   */
  public function __construct()
  {
    $this->_connection = MysqlConnection::getInstance();
    $this->_connection->Connect();
  }

  /**
   * Обертка запроса SQL
   *
   * @param null | int $id - возможно, выборка будет по ключу
   *
   * @return null | array    выдат результат запроса при неудаче == null
   */
  public function select($id = null)
  {
    $query = QueryConstructor::getQueryStatic(Data::SELECT, null, '*', $id);

//        echo '<br/>Создание запроса SELECT->QueryConstructor::getQueryStatic: <br/>';
//        echo var_export($query).'<br/>';

    if ($r = mysql_query($query)) {

      $n = mysql_num_rows($r);
      for ($i = 0; $i < $n; $i++) {
        $row = mysql_fetch_array($r);
        $this->_result[] = new Article($row);
      }
    } else {
      $this->_error_message = mysql_error();
      $this->_error_num = mysql_errno();
      $this->_result = null;
    }

    return $this->_result;
  }

  /**
   * @param $params array - значения полей ввиде array(field_value1, field_value1), параметры, необходимые для запроса
   * @param null | int $id ключ для выборки из БД
   *
   * @return null|resource
   */
  public function update($params, $id = null)
  {
    $query = QueryConstructor::getQueryStatic(Data::UPDATE, $params, null, $id);

//        echo '<br/>Создание запроса UPDATE->QueryConstructor::getQueryStatic: <br/>';
//        echo var_export($query).'<br/>';
    // целое число - количество измененных строк
    return $this->_getResult($query);
  }

  /**
   * Функция выпоняет запрос к БД и записывает возможные ушибку и её номер в свои поля, при этом ресурсу присваивается значение null
   *
   * @param $query string SQL-запрос к БД
   *
   * @return null|resource - null при неудачном запросе к БД
   */
  protected function _getResult($query)
  {
    if ($r = mysql_query($query)) {
      $this->_result = $r;
    } else {
      $this->_error_message = mysql_error();
      $this->_error_num = mysql_errno();
      $this->_result = null;
    }

    //$this->_connection->Close();

    return $this->_result;
  }

  /**
   * @param $params array - значения полей ввиде array(field_value1, field_value2), параметры, необходимые для запроса
   *
   * @return null|resource - null при неудачном запросе к БД
   */
  public function insert($params)
  {

    $query = QueryConstructor::getQueryStatic(Data::INSERT, $params, null, null);

//        echo '<br/>Создание запроса INSERT->QueryConstructor::getQueryStatic: <br/>';
//        echo var_export($query).'<br/>';
    //$this->_connection->Open();

    // целое число - количество измененных строк
    return $this->_getResult($query);
  }

  /**
   * @param null | int $id - возможно, удаление будет не по ключу ключу (id===null) удаление всей таблицы
   *
   * @return null|resource - null при неудачном запросе к БД
   */
  public function delete($id = null)
  {
    $query = QueryConstructor::getQueryStatic(Data::DELETE, null, null, $id);

//        echo '<br/>Создание запроса DELETE->QueryConstructor::getQueryStatic: <br/>';
//        echo var_export($query).'<br/>';

    //$this->_connection->Open();

    // целое число - количество измененных строк
    return $this->_getResult($query);
  }
}