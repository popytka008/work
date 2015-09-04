<?php
require_once 'lib/m/M_Edit.php';
require_once 'lib/c/C_Base.php';


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

    /**
     * Анализ входных данных, передача работы Механику, для подготовки выходных данных.
     * сохранение данных статьи в $_article
     */
    protected function OnInput()
    {
        parent::OnInput();

        // метод get - просмотр статьи
        $this->_title .= '::Редактирование статьи';
        $model = new M_Edit();
        // сначала определить метод прихода - get / post
        // если post - обновить данные в источнике данных
        if ($this->IsPost()) {
//      echo '<br/>или: Ухожу в сохранение статьи: C_Edit--$this->IsPost()<br/>';
//      echo '<br/>или: Ухожу в удаление статьи: C_Edit--$this->IsPost()<br/>';

            $model->saveArticle(array((int)$_POST['id_article'], $_POST['title_article'], $_POST['content_article']));

            // при удаче на главную страницу
            if (!($this->_error = $model->getError()))
                header("Location: index.php");
            else
                // метод post- неудачное сохранение - повторить форму
                $this->_article = new Article(array($_POST['id_article'], $_POST['title_article'], $_POST['content_article']));
        }

        if ($model->isGet()) {
            $this->_article = $model->getArticle((int)$_GET['id']);
            $this->_error = $model->getError();
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

        $v = new Viewer();
        $this->_content = $v->render("v/v_edit.tpl", $archive);
        parent::OnOutput();
    }
}