
<div class="error-block"><?=$error?></div>
<?php foreach($articles as $article): ?>
  <div class="article">
    <p class="article-title">
      <a href='index.php?id=<?=$article->getId()?>'>
        <?=$article->getTitle()?>
      </a>
    </p>
    <div class="article-content"><?=$article->getContentTruncated()?></div>
  </div>

  <?php endforeach; ?>
