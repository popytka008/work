
<h1>Редактируемая статьи</h1>
<div class="error-block"><?=$error?></div>
<form method="post">
  <label for="title_article">Название:</label>
  <input type="text" id="title_article" name="title_article" value="<?=$article->getTitle()?>" />
  <br/>
  <br/>
  <label for="content_article">Содержание:</label>
  <textarea id="content_article" name="content_article"><?=$article->getContent()?></textarea>

  <input type="hidden" id="operation" name="operation" value="update" />
  <input type="hidden" id="id_article" name="id_article" value="<?=$article->getId()?>" />

  <br/>
  <input type="submit" value="Исправить" />
  <input type="submit" value="Удалить" onclick="document.getElementById('operation').value = 'delete';"/>
</form>

