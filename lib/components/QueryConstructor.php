<?php

/*
 * ПРОТЕСТИРОВАНО
 * 31.08.2015
 */




/**
 * Class QueryConstructor
 * конструктор строк SQL-запросов, генерация строки запроса.
 */
class QueryConstructor{

    // SELECT INSERT UPDATE DELETE
    /**
     * шаблон операции select
     */
    const TEMPLATE_SELECT = "SELECT %s FROM `%s` ";
    // RESOLVED QUERY
    /**
     * шаблон операции select по имеющемуся ключу
     */
    const TEMPLATE_SELECT_ID = "SELECT %s FROM `%s` WHERE `%s` = %d";
    // MODIFYING COLUMNS
    /**
     * шаблон операции insert
     */
    const TEMPLATE_INSERT = "INSERT INTO `%s` (`%s`, `%s`) VALUES ('%s', '%s')";
    // APPLYING VALUES
    /**
     * шаблон операции update
     */
    const TEMPLATE_UPDATE = "UPDATE `%s` SET `%s` = '%s', `%s` = '%s'";
    // KEY FIELD VALUE
    /**
     * шаблон операции update по имеющемуся ключу
     */
    const TEMPLATE_UPDATE_ID = "UPDATE `%s` SET `%s` = '%s', `%s` = '%s' WHERE `%s` = %d";
    // KEY FIELD VALUE
    /**
     * шаблон операции delete
     */
    const TEMPLATE_DELETE = "DELETE  FROM `%s` ";
    /**
     * шаблон операции delete по имеющемуся ключу
     */
    const TEMPLATE_DELETE_ID = "DELETE  FROM `%s` WHERE `%s` = %d";
    /**
     * @var Data::SELECT | Data::INSERT | Data::UPDATE | Data::DELETE SQL-операция
     */
    protected $_command;
    /**
     * @var string сгенерированный SQL-запрос
     */
    protected $_query;
    /**
     * @var array перечень имен изменяемых колонок таблицы
     */
    protected $_columns;
    /**
     * @var null | array перечень изменяемых полей
     */
    protected $_values;
    /**
     * @var null | int ключевое поле
     */
    protected $_ID;
    /**
     * @var string имя ключевого коонки таблицы
     */
    protected $_ID_column;

    /**
     * Для конструктора: вид комманды, значения полей, поля, значение ключа
     * @param $_command - вид комманды: тип Data::INSERT | Data::INSERT | Data::UPDATE | Data::DELETE
     * @param null $_values - значения полей: массив занчений
     * @param null $_columns- поля: массив (или значение "*") для запроса SELECT
     * @param null $_ID - значение ключа: ---
     */
    public function __construct($_command, $_values = null, $_columns = null, $_ID = null)
    {
      //$str = '/*----------------------- вход в QueryConstructor -------------------*/'.PHP_EOL;
      //File::append('test_file.txt', $str);

      $this->_command = $_command;
      $this->_values = $_values;
      $this->_columns = $_columns;
      $this->_ID = $_ID;

      $this->_query = "";

      if($_command === Data::SELECT){
          if($_columns != '*'){
              $this->_columns = '`' . Data::FIRST_COLUMN . '`, `' . Data::SECOND_COLUMN . '`, `' . Data::THIRD_COLUMN . '`';
          }
      }
      if($_command === Data::UPDATE || $_command === Data::INSERT){
          $this->_columns = array(Data::SECOND_COLUMN, Data::THIRD_COLUMN);
      }

      //

      if($_ID)
          $this->_ID_column = Data::FIRST_COLUMN;

      //File::append('test_file.txt', var_export($this, true));
      //File::append('test_file.txt', PHP_EOL);
    }

    /**
     * Ввозвращает из конструктора запросов сформированный запрос по предоставленным данным
     * Для работы: вид комманды, значения полей, поля, значение ключа
     *
     * @param $_command - вид комманды: тип Data::INSERT | Data::INSERT | Data::UPDATE | Data::DELETE
     * @param null $_values - значения полей: массив занчений
     * @param null $_columns - поля: массив (или значение "*") для запроса SELECT
     * @param null $_ID - значение ключа: целое значение индекса (в данном случае)
     *
     * @return string
     */
    static public function getQueryStatic($_command, $_values = null, $_columns = null, $_ID = null) {

        $obj = new QueryConstructor($_command, $_values, $_columns, $_ID);
        $q = $obj->getQuery();

        return $q;
    }

    /**
     * Изъять сгенерированный sql-запрос
     * @return string
     */
    public function getQuery() {
//      $str = '/*----------------------- вход в QueryConstructor->getQuery() -------*/'.PHP_EOL;
//      File::append('test_file.txt', $str);

        if( !$this->_query) {
            $this->createQuery();
        }

//      File::append('test_file.txt', 'Сгенерировнный запрос:'.PHP_EOL);
//      File::append('test_file.txt', $this->_query.PHP_EOL);
//
//      $str = '/*----------------------- выход из QueryConstructor->createDeleteQuery() --*/'.PHP_EOL;
//      File::append('test_file.txt', $str);

        return $this->_query;
    }

    /**
     * Создание запроса (передача управления по методу запроса CRUD)
     */
    protected function createQuery(){

//      $str = '/*----------------------- вход в QueryConstructor->createQuery() ----*/'.PHP_EOL;
//      File::append('test_file.txt', $str);
//      File::append('test_file.txt', '$this->_command = '.$this->_command.PHP_EOL);

        switch($this->_command){
            case Data::SELECT: $this->createSelectQuery(); break;
            case Data::INSERT: $this->createInsertQuery(); break;
            case Data::UPDATE: $this->createUpdateQuery(); break;
            case Data::DELETE: $this->createDeleteQuery(); break;
        }
//      $str = '/*----------------------- выход из QueryConstructor->createQuery() --*/'.PHP_EOL;
//      File::append('test_file.txt', $str);
    }

    /**
     * создание запроса select
     */
    protected function createSelectQuery(){
//      $str = '/*----------------------- вход в QueryConstructor->createSelectQuery() ----*/'.PHP_EOL;
//      File::append('test_file.txt', $str);


        if($this->_ID){
            //const TEMPLATE_SELECT_ID = "SELECT %s FROM `%s` WHERE `%s` = %d";
            $this->_query = sprintf(
                self::TEMPLATE_SELECT_ID, $this->_columns, Data::TABLE, $this->_ID_column, $this->_ID
            );}
        else
            //const TEMPLATE_SELECT = "SELECT %s FROM `%s`";
            $this->_query = sprintf(self::TEMPLATE_SELECT, $this->_columns, Data::TABLE);

//      $str = '/*----------------------- выход из QueryConstructor->createSelectQuery() --*/'.PHP_EOL;
//      File::append('test_file.txt', $str);
    }

    /**
     * создание запроса insert
     */
    protected function createInsertQuery(){
//      $str = '/*----------------------- вход в QueryConstructor->createInsertQuery() ----*/'.PHP_EOL;
//      File::append('test_file.txt', $str);


      //const TEMPLATE_INSERT = "INSERT INTO `%s` (`%s`, `%s`) VALUES ('%s', '%s')";
        $this->_query = sprintf(self::TEMPLATE_INSERT, Data::TABLE,
                                $this->_columns[0], $this->_columns[1],
                                $this->_values[0], $this->_values[1]);
    }

    /**
     * создание запроса update
     */
    protected function createUpdateQuery(){
//      $str = '/*----------------------- вход в QueryConstructor->createUpdateQuery() ----*/'.PHP_EOL;
//      File::append('test_file.txt', $str);


      //const TEMPLATE_UPDATE_ID = "UPDATE `%s` SET `%s` = '%s', `%s` = '%s' WHERE `%s` = %d";
        if($this->_ID)
            $this->_query = sprintf(
                self::TEMPLATE_UPDATE_ID , Data::TABLE,
                $this->_columns[0], $this->_values[0],
                $this->_columns[1], $this->_values[1],
                $this->_ID_column, $this->_ID
            );
        else
            //const TEMPLATE_UPDATE = "UPDATE `%s` SET `%s` = '%s', `%s` = '%s'";
            $this->_query = sprintf(
                self::TEMPLATE_UPDATE, Data::TABLE,
                $this->_columns[0], $this->_values[0],
                $this->_columns[1], $this->_values[1]
            );
    }

    /**
     * создание запроса delete
     */
    protected function createDeleteQuery(){
//      $str = '/*----------------------- вход в QueryConstructor->createDeleteQuery() ----*/'.PHP_EOL;
//      File::append('test_file.txt', $str);

        //const TEMPLATE_DELETE_ID = "DELETE  FROM `%s` WHERE `%s` = %d";
        if($this->_ID)
            $this->_query = sprintf(
                self::TEMPLATE_DELETE_ID , Data::TABLE, $this->_ID_column, $this->_ID
            );
        //const TEMPLATE_DELETE = "DELETE  FROM `%s` ";
        else
            $this->_query = sprintf(self::TEMPLATE_DELETE , Data::TABLE);
    }
}


