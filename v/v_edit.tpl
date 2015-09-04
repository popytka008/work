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
      <label for="content_article">Содержание:</label>

      <div class="controls">
        <textarea id="content_article" name="content_article"><?=$article->getContent()?></textarea>
      </div>
    </div>

    <div class="control-group">
      <div class="controls form-action">
        <input type="submit" value="Исправить" class="btn btn-success"/>
        <input type="submit" value="Удалить" class="btn " disabled="disabled"
               onclick="document.getElementById('operation').value = 'delete';"/>
      </div>
    </div>

    <input type="hidden" id="operation" name="operation" value="update"/>
    <input type="hidden" id="id_article" name="id_article" value="<?=$article->getId()?>"/>

  </form>
</div>


