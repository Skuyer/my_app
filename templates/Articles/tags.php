<h1>
    Artículos etiquetados con 
    <?= h(implode(', ', $tags)) ?>
</h1>

<section>
<?php foreach ($articles as $article): ?>
    <article>
        <h4><?= $this->Html->link($article->title, ['action' => 'view', $article->slug]) ?></h4>
        <span><?= h($article->created) ?></span>
    </article>
<?php endforeach; ?>
</section>