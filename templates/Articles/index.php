<h1>Artículos</h1>

<p><?= $this->Html->link('Agregar Artículo', ['action' => 'add'], ['class' => 'button']) ?></p>

<table>
    <tr>
        <th>Título</th>
        <th>Creado</th>
        <th>Acciones</th> 
    </tr>

    <?php foreach ($articles as $article): ?>
    <tr>
        <td>
            <?= $this->Html->link($article->title, ['action' => 'view', $article->id]) ?>
        </td>
        <td>
            <?= $article->created->format(DATE_RFC850) ?>
        </td>
        <td>
            <?= $this->Html->link('Editar', ['action' => 'edit', $article->id]) ?>
            | 
            <?= $this->Form->postLink('Eliminar', ['action' => 'delete', $article->id], ['confirm' => '¿Estás seguro?']) ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>