<div class="container">
    <div>
        <?php foreach($articles as $article): ?>
        <div class="article">
            <p class="article-header">
                <a href="index.php?c=edit&id=<?=$article->getId()?>">
                    <?=$article->getTitle()?>
                </a>
            </p>
        </div>
        <?php endforeach; ?>

    </div>
    <hr/>
    <p><a href="index.php?c=new">Создать новую статью</a></p>
</div>