<div class="container">
    <div class="message"><?=$error?></div>
    <form method="post" class="form-horizontal">
        <div class="control-group">
            <label for="title_article" class="control-label">Название:</label>

            <div class="controls">
                <input type="text" id="title_article" name="title_article" value="<?=$article->getTitle()?>"/>
            </div>
        </div>

        <div class="control-group">
            <label for="content_article" class="control-label">Содержание:</label>

            <div class="control-group">
                <textarea id="content_article" name="content_article"><?=$article->getContent()?></textarea>
            </div>
        </div>
        <div class="control-group">
            <div class="controls form-action">
                <input type="submit" value="Добавить" class="btn btn-success"/>
            </div>
        </div>
    </form>
</div>
