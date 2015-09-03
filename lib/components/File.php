<?php


/**
 * Class File
 * обертка над операциями (некоторыми) над файлами (в основном текстовыми)
 * операции чтения из файла, добавления строки в файл, проверки существования...
 */
class File {

    /**
     * @var resource ярлык к открытого файла
     */
    protected $_file_handler;
    /**
     * @var string имя файла
     */
    protected $_file_name;
    /**
     * @var string способ использования файла (на пример 'a+')
     */
    protected $_mode;
    /**
     * @var int  номер ошибки (не используется ввиду отстутствия знаний)
     */
    protected $_error;


    /**
     * Создание объекта файл, прописывает имя файла, способ использования
     *
     * @param $_file_name string
     * @param $_mode string
     */
    function __construct($_file_name, $_mode) {
        $this->_file_name = $_file_name;
        $this->_mode = $_mode;
    }

    /**
     * Изъять соержимое файла
     *
     * @param $file_name string имя файла
     *
     * @return array|null если файл существует вернется содержимое фалйа
     */
    static public function getFile($file_name) {
        if(file_exists($file_name))
            return file($file_name);
        else
            return null;
    }

    /**
     * Добавит строку в файл
     *
     * @param $file_name string имя файла
     * @param $str string добавляемая строка
     */
    static public function append($file_name, $str) {
        $file = new File($file_name, 'a+');
        $file->addString($str);
        $file = null;
    }

    /**
     * Метод добавляет строку в файл
     *
     * @param $str string добавляемая строка
     */
    public function addString($str) {
        if( !$this->_file_handler) $this->open();

        fputs($this->_file_handler, $str, strlen($str));

        $this->close();
    }

    /**
     * Открытие файла. Файл предварительно закрыается, если ярлык не равен null.
     */
    public function open() {
        if($this->_file_handler) $this->close();

        $this->_file_handler = fopen($this->_file_name, $this->_mode);
    }

    /**
     * Закрытие файла. Ярлык обнуляется (null)
     */
    public function close() {
        if($this->_file_handler) fclose($this->_file_handler);

        $this->_file_handler = null;
    }

    /**
     * Измерение величины файла (узнать формат возвращаемых данных)
     * @return int|null если файл сущесствует возвращает число
     */
    public function fileSize() {
        if($this->exist()) {
            return filesize($this->_file_name);
        }

        return null;
    }

    /**
     * Проверка существование файла
     * @return bool
     */
    public function exist() {
        return file_exists($this->_file_name);
    }

    /**
     * Изъять содержимое файла
     * @return array|null если файл существует вернется содержимое фалйа
     */
    public function getAll() {
        if($this->exist()) {

            if($this->_file_handler) $this->close();

            return file($this->_file_name);
        }

        return null;
    }
}
