<h1>Artículos</h1>
<table>
    <tr>
        <th>Título</th>
        <th>Creado</th>
    </tr>

    <?php foreach ($articles as $article): ?>
    <tr>
        <td>
            <?= $this->Html->link($article->title, ['action' => 'view', $article->slug]) ?>
        </td>
        <td>
            <?= $article->created->format(DATE_RFC850) ?>
        </td>
        <td>
            <?= $this->Html->link('Editar', ['action' => 'edit', $article->slug]) ?>
        </td>
        <td>
            <?= $this->Form->postLink('Eliminar', ['action' => 'delete', $article->slug], ['confirm' => '¿Estás seguro?']) ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>