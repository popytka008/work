<?php


/**
 * Class C_List
 *
 * класс реализует контролёра целью которого является:
 * - передача Мехаику данных для обработки входных и подготовки выходных данных,
 * (здесь реализуется подшаблон списка статей)
 * - передача Видеопроектору выходных данных для реализации своего подшаблона.
 * - передача управления классу-предку для слияния всех шаблонов и вывода результата.
 *(здесь слияние реализует страницу HTML со списком статей)
 */
class C_List extends C_Base {

    /**
     * @var array[Article] содержит все выбранные из БД записи статей
     */
    protected $_articles;
    /**
     * @var string при array[Article]===null держит ошибку при неудачном запросе
     */
    protected $_error;


    /**
     * Анализ входных данных, передача работы Механику, для подготовки выходных данных.@deprecated
     * сохранение данных array[Article] в $_articles
     */
    protected function OnInput()
    {
        parent::OnInput();
        $model = new M_List();

        if (isset($_GET['id'])) {
            // работаем с одной статьёй
            $this->_title .= '::Просмотр статьи';
            $model->getArticles((int)$_GET['id']);
            $this->_error = $model->getError();
        } else {
            // работаем со списком статей
            $this->_title .= '::Просмотр списка статей';
            $this->_articles = $model->getArticles();
            $this->_error = $model->getError();
        }
    }

    /**
     * Передача данных для реализации собственного подшаблона (списка статей)
     * Видеопроектору
     *
     * Вызов метода предка parent::OnOutput() для слияния всех подшаблонов и вывода результата.
     */
    protected function OnOutput() {
        $archive = array('error' => nl2br($this->_error), 'articles' => $this->_articles);

        $v = new Viewer();

        $this->_content = $v->render("v/v_list.tpl", $archive);
        parent::OnOutput();
    }
}