<?php

class Article{
    protected $_title;
    /**
     * @var string
     */
    protected $_content;

    protected $_title_naming;
    protected $_content_naming;

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->_title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->_title = $title;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->_content;
    }

    /**
     * @param string $content
     */
    public function setContent($content)
    {
        $this->_content = $content;
    }

    /**
     * @return string
     */
    public function getTitleNaming()
    {
        return $this->_title_naming;
    }

    /**
     * @param string $title_naming
     */
    public function setTitleNaming($title_naming)
    {
        $this->_title_naming = $title_naming;
    }

    /**
     * @return string
     */
    public function getContentNaming()
    {
        return $this->_content_naming;
    }

    /**
     * @param string $content_naming
     */
    public function setContentNaming($content_naming)
    {
        $this->_content_naming = $content_naming;
    }


    /**
     * PHP 5 allows developers to declare constructor methods for classes.
     * Classes which have a constructor method call this method on each newly-created object,
     * so it is suitable for any initialization that the object may need before it is used.
     *
     * Note: Parent constructors are not called implicitly if the child class defines a constructor.
     * In order to run a parent constructor, a call to parent::__construct() within the child constructor is required.
     *
     * param [ string $args [, $... ]]
     * @return void
     * @link http://php.net/manual/en/language.oop5.decon.php
     */
    function __construct($title, $content, $title_naming = Data::SECOND_COLUMN, $content_naming = Data::THIRD_COLUMN)
    {
        $this->_title = $title;
        $this->_content = $content;
        $this->_title_naming = $title_naming;
        $this->_content_naming = $content_naming;
    }


    function getArticle(){
        return [$this->_title_naming => $this->_title, $this->_content_naming => $this->_content];
    }
}