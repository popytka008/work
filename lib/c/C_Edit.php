<?php


/**
 * Class C_Edit
 *
 * класс реализует контролёра целью которого является:
 * - передача Мехаику данных для обработки входных и подготовки выходных данных,
 * (здесь реализуется подшаблон редактирования статьи, ключ в $_GET['id'])
 * - передача Видеопроектору выходных данных для реализации своего подшаблона.
 * - передача управления классу-предку для слияния всех шаблонов и вывода результата.
 *(здесь слияние реализует страницу HTML с формой редактирования статьи)
 */
class C_Edit extends C_Base {

    /**
     * @var string при Article===null держит ошибку при неудачном запросе
     */
    protected $_error;
    /**
     * @var Article - объект класса, описывает редактируемую статью
     */
    protected $_article;

//    /**
//     * @var M_Edit
//     */
//    protected $_model;
//
//    /**
//     * C_Edit constructor.
//     */
//    public function __construct()
//    {
//        $this->_model = new M_Edit();
//    }

    /**
     * Анализ входных данных, передача работы Механику, для подготовки выходных данных.
     * сохранение данных статьи в $_article
     */
    protected function OnInput()
    {
        parent::OnInput();

        // метод get - просмотр статьи
        $this->_title .= '::Редактирование статьи';

        // post - обновить данные в источнике данных
        if (Model::IsPost()) {
            $this->_model->saveArticle(array((int)$_POST['id_article'], $_POST['title_article'], $_POST['content_article']));

            // при удаче на главную страницу
            if (!($this->_error = $this->_model->getError()))
                header("Location: index.php");
            else
                // метод post- неудачное редактирование - повторить форму
                $this->_article = new Article(array($_POST['id_article'], $_POST['title_article'], $_POST['content_article']));
        }

        // Заход по ссылке с другой страницы
        if (Model::isGet()) {
            $this->_article = $this->_model->getArticle((int)$_GET['id']);
            $this->_error = $this->_model->getError();
        }
    }

    /**
     * Передача данных для реализации собственного подшаблона (редактирование статьи)
     * Видеопроектору
     *
     * Вызов метода предка parent::OnOutput() для слияния всех подшаблонов и вывода результата.
     */
    protected function OnOutput() {
        $archive = array('error' => nl2br($this->_error), 'article' => $this->_article);

        $this->_content = $this->_viewer->render("v/v_edit.tpl", $archive);
        parent::OnOutput();
    }
}