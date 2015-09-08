<?php


/**
 * Class Model
 * Описывает базового Механика, в составе схемы Контролёр-Механик-Видеопроектор
 */
abstract class Model
{

  /**
   * @var null | int | array для записи результата (например - SQL-запроса)
   */
    protected $_result;
  /**
   * @var string для записи ошибки при неудачной операции (например - при SQL-запросе)
   */
    protected $_error;

  /**
   * @var MysqlDatabaseManager управляет SQL-запросами к БД
   */
  protected $_databaseManager;


  /**
   * Model constructor.
   */
  public function __construct()
  {
    $this->_databaseManager = MysqlDatabaseManager::getInstance();
  }

  /* методы заглушки, суль их разворачивается в потомках, вводятся для совместимости */

  /**
   * Проверить метод текущего HTTP-запроса (если GET)
   * @return bool
   */
  static public function isGet()
  {
//        $str = '/*----------------------- вход и выход в Model()->isGet() -------------------*/'.PHP_EOL;
//        File::append('test_file.txt', $str);


    return ($_SERVER['REQUEST_METHOD'] === 'GET');
  }

  /**
   * * Проверить метод текущего HTTP-запроса (если POST)
   * @return bool
   */
  static public function isPost()
  {
//        $str = '/*----------------------- вход и выход в Model()->isPost() -------------------*/'.PHP_EOL;
//        File::append('test_file.txt', $str);

    return ($_SERVER['REQUEST_METHOD'] === 'POST');
  }

  public function addArticle(array $array)
  {
  }

  public function deleteArticle($id)
  {
  }

  public function getArticle($id)
  { /*return new Article();*/
    return null;
  }

  public function saveArticle(array $array)
  {
  }

  public function getArticles()
  {
    return null;
  }

    /**
     * изъять результат
     * @return null | int | array
     */
    public function getResult() {
        return $this->_result;
    }

    /**
     * изъять ошибку (если есть)
     * @return string
     */
    public function getError() {
        return $this->_error;
    }

  /**
   * Изъять тип текущего HTTP-запроса
   * @return string
   */
    public function getMethod() {
//        $str = '/*----------------------- вход и выход в Model()->getMethod() -------------------*/'.PHP_EOL;
//        File::append('test_file.txt', $str);

        return $_SERVER['REQUEST_METHOD'];
    }
}