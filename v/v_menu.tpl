<!--

/*\$key = true|false*/

-->

<div class="header">
    <div class="menu">
        <?php if(Model::isGet() && !isset($_GET['c'])): ?>
        <span>Главная</span>
        <span> | </span>
        <a href="index.php?c=editor">Консоль редактора</a>
        <?php elseif (Model::isGet() && $_GET['c'] === 'editor'): ?>
        <a href="index.php">Главная</a>
        <span> | </span>
        <span>Консоль редактора</span>
        <?php else: ?>
        <a href="index.php">Главная</a>
        <span> | </span>
        <a href="index.php?c=editor">Консоль редактора</a>
        <?php endif; ?>
    </div>
    <div class="line">
        <hr/>
    </div>
</div>