<?php foreach($articles as $article): ?>
<div class="article">
  <p class="article-header">
    <a href='article.php?id=<?php echo $article["id_article"]; ?>'>
    <?php echo $article["title_article"]; ?>
    </a>
  </p>
  <div class="article-body"><?php echo $article["content_article"]; ?></div>
</div>
<?php print_r($article);echo "\n"; ?>
<?php endforeach; ?>
