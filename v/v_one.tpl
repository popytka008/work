<div class="container">
    <div class="article">
        <p class="article-header">
            <?=$article->getTitle()?>
        </p>

        <div class="article-body">
            <?=$article->getContent()?>
        </div>
    </div>
    <a href="index.php?c=edit&id=<?=$article->getID()?>">редактировать</a>
</div>
