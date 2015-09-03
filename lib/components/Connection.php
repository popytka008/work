<?php
require_once "lib/data/data.php";


/**
 * Class Connection
 * todo надо сделат истинный синглтон
 * класс создания и хранения соединения к БД
 * соединение (ресурс) содержится в статической переменной $_connection
 * Соединение выпоняется в конструкторе, в методе open()
 */
class Connection {

    /**
     * @var resource ярлык соединения к БД
     */
    static protected $_connection;

    /**
     * конструктор
     * создание соединения если таковое отсутствует
     * передача ярлыка соединения $_connection
     */
    public function __construct() {
        if ( !$this->isConnected()) {
            $this->open();
        }
    }

    /**
     * @return bool проверка существования соединения к БД
     */
    protected function isConnected() {
        return self::$_connection !== null;
    }

    /**
     * создание соединения если таковое отсутствует
     * передача ярлыка соединения $_connection
     */
    public function open() {
        if ( !$this->isConnected()) {
            self::$_connection = mysql_connect(Data::SERVER, Data::USERNAME, Data::PASSWORD);
            mysql_select_db(Data::DB);
        }
    }

    /**
     * @return resource ярлык соединения к БД
     */
    static public function getConnection() {
        if ( !Connection::$_connection)
            new Connection();

        return Connection::$_connection;
    }

    /**
     * закрытие соединения
     * обнуление $_connection
     */
    public function close() {
        if($this->isConnected()) {
            mysql_close(self::$_connection);
            self::$_connection = null;
        }
    }

    /**
     * @return string
     */
    public function test_connection(){
        return ($this->isConnected()===true)? 'Существует!':'Не существует..';
    }
}